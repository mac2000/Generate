<?php
/**
 * Generate
 *
 * @category   Library
 * @package    Generate
 * @subpackage Generator
 */
/**
 * @see Generator_Sentence
 */
require_once 'generator_sentence.php';
/**
 * @see Generator_Number
 */
require_once 'generator_number.php';
/**
 * @see Generator_Zip
 */
require_once 'generator_zip.php';
/**
 * @see Generator_FirstName
 */
require_once 'generator_firstname.php';
/**
 * @see Generator_LastName
 */
require_once 'generator_lastname.php';
/**
 * @see Generator_Country
 */
require_once 'generator_country.php';
/**
 * @see Generator_CountryCode_Two
 */
require_once 'generator_countrycode_two.php';
/**
 * @see Generator_CountryCode_Three
 */
require_once 'generator_countrycode_three.php';
/**
 * @see Generator_State
 */
require_once 'generator_state.php';
/**
 * @see Generator_StateCode
 */
require_once 'generator_stateCode.php';
/**
 * Class for generating address.
 *
 * @category   Library
 * @package    Generator
 * @subpackage Address
 */
class Generator_Address extends Generator_Sentence
{
    /**
     * Bool generator
     *
     * @var Generator_Bool
     */
    protected $_boolGenerator;
    /**
     * Number generator
     *
     * @var Generator_Number
     */
    protected $_numberGenerator;
    /**
     * First name generator
     *
     * @var Generator_FirstName
     */
    protected $_firstNameGenerator;
    /**
     * Last name generator
     *
     * @var Generator_LastName
     */
    protected $_lastNameGenerator;
    /**
     * City generator
     *
     * @var Generator_City
     */
    protected $_cityGenerator;
    /**
     * Country generator
     *
     * @var Generator_Country
     */
    protected $_countryGenerator;
    /**
     * Country code generator
     *
     * @var Generator_CountryCode_Two
     */
    protected $_countryCodeTwoGenerator;
    /**
     * Country code generator
     *
     * @var Generator_CountryCode_Three
     */
    protected $_countryCodeThreeGenerator;
    /**
     * State generator
     *
     * @var Generator_State
     */
    protected $_stateGenerator;
    /**
     * State code generator
     *
     * @var Generator_StateCode
     */
    protected $_stateCodeGenerator;
    /**
     * Zip code generator
     *
     * @var Generator_Zip
     */
    protected $_zipGenerator;

    public function __construct()
    {
        parent::__construct();
        $this->_boolGenerator = new Generator_Bool();
        $this->_numberGenerator = new Generator_Number();
        $this->_firstNameGenerator = new Generator_FirstName();
        $this->_lastNameGenerator = new Generator_LastName();
        $this->_cityGenerator = new Generator_City();
        $this->_countryGenerator = new Generator_Country();
        $this->_countryCodeTwoGenerator = new Generator_CountryCode_Two();
        $this->_countryCodeThreeGenerator = new Generator_CountryCode_Three();
        $this->_stateGenerator = new Generator_State();
        $this->_stateCodeGenerator = new Generator_StateCode();
        $this->_zipGenerator = new Generator_Zip();
    }

    /**
     * Generate address
     *
     * @return string
     */
    public function next()
    {
        $this->srand();

        $address = $this->generateStreetAddress();
        $city = $this->_boolGenerator->next() ? $this->_cityGenerator->next() : '';
        $state = '';
        if (!empty($city)) {
            $state = $this->_boolGenerator->next() ? $this->_stateGenerator->next() : $this->_stateCodeGenerator->next();
        }
        $zip = $this->_boolGenerator->next() ? '' : $this->_zipGenerator->next();
        $country = '';
        if (!empty($city)) {
            $country = array(
                '',
                $this->_countryGenerator->next(),
                $this->_countryCodeTwoGenerator->next(),
                $this->_countryCodeThreeGenerator->next(),
            );
            shuffle($country);
            $country = $this->_boolGenerator->next() ? $country[0] : '';
        }

        $address = array(
            $address,
            $city,
            $country,
            $state,
            $zip,
            $country,
        );
        $address = array_unique($address);
        shuffle($address);

        $address = $this->_addCommas($address);

        $address = trim(implode(' ', $address), ' ,');
        $address = str_replace(' ,', ',', $address);

        return $address;
    }

    public function generateStreetAddress()
    {
        $this->srand();

        $streetSuffixes = array('st.', 'str.', 'street');

        $streetSuffix = $this->_boolGenerator->next() ? $streetSuffixes[array_rand($streetSuffixes)] : '';
        $streetName = $this->_boolGenerator->next() ? $this->_firstNameGenerator->next() : $this->_lastNameGenerator->next();
        $streetNumber = $this->_numberGenerator->next(1, 100);

        return trim("$streetNumber $streetName $streetSuffix");
    }
}

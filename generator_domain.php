<?php
/**
 * Generate
 *
 * @category   Library
 * @package    Generate
 * @subpackage Generator
 */
/**
 * @see Generator_Abstract
 */
require_once 'generator_abstract.php';
/**
 * @see Generator_CompanyName
 */
require_once 'generator_companyname.php';
/**
 * @see Generator_CountryCode_Two
 */
require_once 'generator_countrycode_two.php';
/**
 * @see Transliterate
 */
require_once 'Transliterate/Transliterate.php';
/**
 * Class for generating domains.
 *
 * @category   Library
 * @package    Generator
 * @subpackage Domain
 */
class Generator_Domain extends Generator_Abstract
{
    /**
     * Top level domains
     *
     * @var array
     */
    protected $_topLevelDomains = array(
        'com',
        'biz',
        'info',
        'net',
        'com',
        'org',
    );

    /**
     * Get top lovel domains
     *
     * @return array
     */
    public function getTopLevelDomains() {
        return $this->_topLevelDomains;
    }

    /**
     * Set top level domains
     *
     * @param array $domains
     */
    public function setTopLevelDomains($domains = array()) {
        $this->_topLevelDomains = $domains;
    }



    /**
     * Company name generator
     *
     * @var Generator_CompanyName
     */
    protected $_companyNameGenerator;

    /**
     * Country code generator
     *
     * @var Generator_CountryCode_Two
     */
    protected $_countryCodeGenerator;

    /**
     * Transliterator
     *
     * @var Transliterate
     */
    protected $_transliterate;

    public function __construct()
    {
        parent::__construct();
        $this->_companyNameGenerator = new Generator_CompanyName();
        $this->_countryCodeGenerator = new Generator_CountryCode_Two();
        $this->_transliterate = new Transliterate();
    }

    /**
     * Generate domain
     *
     * @return string
     */
    public function next()
    {
        $this->srand();
        $domain = $this->_topLevelDomains[array_rand($this->_topLevelDomains)];

        $this->srand();
        if(rand(1, 10) > 7) {
            $this->srand();
            $domain = $domain . '.' . mb_strtolower($this->_countryCodeGenerator->next());
        }

        $this->srand();
        $domain = $this->_transliterate->slug($this->_companyNameGenerator->next()) . '.' . $domain;

        return $domain;
    }
}

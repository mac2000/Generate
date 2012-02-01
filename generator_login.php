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
 * @see Generator_Number
 */
require_once 'generator_number.php';
/**
 * @see Generator_FirstName
 */
require_once 'generator_firstname.php';
/**
 * @see Generator_LastName
 */
require_once 'generator_lastname.php';
/**
 * @see Transliterate
 */
require_once 'Transliterate/Transliterate.php';
/**
 * Class for generating login.
 *
 * @category   Library
 * @package    Generator
 * @subpackage Login
 */
class Generator_Login extends Generator_Abstract
{
    /**
     * First name generator
     *
     * @var Generator_Number
     */
    protected $_numberGenerator;
    /**
     * Last name generator
     *
     * @var Generator_FirstName
     */
    protected $_firstNameGenerator;
    /**
     * Number generator
     *
     * @var Generator_LastName
     */
    protected $_lastNameGenerator;
    /**
     * Transliterator
     *
     * @var Transliterate
     */
    protected $_transliterate;

    public function __construct()
    {
        parent::__construct();
        $this->_numberGenerator = new Generator_Number();
        $this->_firstNameGenerator = new Generator_FirstName();
        $this->_lastNameGenerator = new Generator_LastName();
        $this->_transliterate = new Transliterate();
    }

    /**
     * Generate ZIP code
     *
     * @return string
     */
    public function next()
    {
        $this->srand();
        $firstName = $this->_transliterate->slug($this->_firstNameGenerator->next());
        $firstNameFirstLetter = (string)$firstName[0];

        $this->srand();
        $lastName = $this->_transliterate->slug($this->_lastNameGenerator->next());
        $lastNameFirstLetter = (string)$lastName[0];

        $this->srand();
        $currentYear = (string)date("Y");
        $birthDayYear = (string)((int)date("Y") - $this->_numberGenerator->next(16, 30));

        $templates = array(
            "$firstName",
            "$firstName",
            "$firstName$lastName",
            "$lastName$firstName",
            "$firstNameFirstLetter$lastName",
            "$lastName$firstNameFirstLetter",
            "$firstName$lastNameFirstLetter",
            "$lastNameFirstLetter$firstName",
        );

        $login = array();
        foreach ($templates as $template) {
            $login[] = $template;
            $login[] = "$currentYear$template";
            $login[] = "$birthDayYear$template";
            $login[] = "$template$currentYear";
            $login[] = "$template$birthDayYear";
        }

        $this->srand();
        return (string)$login[array_rand($login)];
    }
}

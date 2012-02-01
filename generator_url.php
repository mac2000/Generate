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
 * @see Generator_Domain
 */
require_once 'generator_domain.php';
/**
 * @see Generator_Sentence
 */
require_once 'generator_sentence.php';
/**
 * @see Transliterate
 */
require_once 'Transliterate/Transliterate.php';
/**
 * @see Generator_Number
 */
require_once 'generator_number.php';
/**
 * Class for generating url.
 *
 * @category   Library
 * @package    Generator
 * @subpackage Url
 */
class Generator_Url extends Generator_Abstract
{
    /**
     * Domain generator
     *
     * @var Generator_Domain
     */
    protected $_domainGenerator;
    /**
         * Sentence generator
         *
         * @var Generator_Sentence
         */
        protected $_sentenceGenerator;
    /**
         * Transliterator
         *
         * @var Transliterate
         */
        protected $_transliterate;
    /**
         * Number generator
         *
         * @var Generator_Number
         */
        protected $_numberGenerator;

    public function __construct()
    {
        parent::__construct();
        $this->_domainGenerator = new Generator_Domain();
        $this->_sentenceGenerator = new Generator_Sentence();
        $this->_numberGenerator = new Generator_Number();
        $this->_transliterate = new Transliterate();
    }

    /**
     * Generate Url
     *
     * @return string
     */
    public function next()
    {
        $suffixes = array('.html', '', '/');
        $this->srand();
        $www = (rand(1, 100) % 2 == 0) ? 'www.' : '';
        $domain = $this->_domainGenerator->next();
        $slug = $this->_transliterate->slug($this->_sentenceGenerator->next($this->_numberGenerator->next(1, 5), false));
        $suffix = $suffixes[array_rand($suffixes)];
        return (string) 'http://' . $www . $domain . '/' . $slug . $suffix;
    }
}

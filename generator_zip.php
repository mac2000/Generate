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
 * Class for generating Zip code.
 *
 * @category   Library
 * @package    Generator
 * @subpackage Zip
 */
class Generator_Zip extends Generator_Abstract
{
    /**
     * Number generator
     *
     * @var Generator_Number
     */
    protected $_numberGenerator;

    public function __construct()
    {
        parent::__construct();
        $this->_numberGenerator = new Generator_Number();
    }

    /**
     * Generate ZIP code
     *
     * @return string
     */
    public function next()
    {
        $this->srand();
        $zip = array(
            $this->_numberGenerator->next(1,9),
            $this->_numberGenerator->next(0,9),
            $this->_numberGenerator->next(0,9),
            $this->_numberGenerator->next(0,9),
            $this->_numberGenerator->next(0,9),
        );
        return (int)implode('', $zip);
    }
}

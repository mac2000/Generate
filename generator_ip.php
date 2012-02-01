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
 * Class for generating ip address.
 *
 * @category   Library
 * @package    Generator
 * @subpackage Ip
 */
class Generator_Ip extends Generator_Abstract
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
     * Generate Ip
     *
     * @return string
     */
    public function next()
    {
        $this->srand();
        $ip = array(
            $this->_numberGenerator->next(1,254),
            $this->_numberGenerator->next(1,254),
            $this->_numberGenerator->next(1,254),
            $this->_numberGenerator->next(1,254),
        );
        return implode('.', $ip);
    }
}

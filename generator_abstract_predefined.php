<?php
/**
 * Generate
 *
 * @category   Library
 * @package    Generate
 * @subpackage Abstract
 */
/**
 * @see Generator_Abstract
 */
require_once 'generator_abstract.php';
/**
 * Class for generating something from predefined set of values,
 * main purpose is to define next method that must be
 * implemented in all other childs.
 *
 * @category   Library
 * @package    Generator
 * @subpackage Abstract
 */
abstract class Generator_Abstract_Predefined extends Generator_Abstract
{
    /**
     * Predefined values
     *
     * @var array
     */
    protected $_predefinedValues = array();

    /**
     * Get predefined values
     *
     * @return array
     */
    public function getPredefinedValues()
    {
        return $this->_predefinedValues;
    }

    /**
     * Set predefined values
     *
     * @param array $values
     */
    public function setPredefinedValues($values = array())
    {
        $this->_predefinedValues = $values;
    }

    /**
     * Constructor
     *
     * @param array $predefinedValues
     */
    public function __construct($predefinedValues = array())
    {
        parent::__construct();
        if (!empty($predefinedValues)) {
            $this->setPredefinedValues($predefinedValues);
        }
    }

    /**
     * Get next random value from predefined ones
     * @return mixed
     */
    public function getNextRandomValue()
    {
        $this->srand();
        return $this->_predefinedValues[array_rand($this->_predefinedValues)];
    }

    /**
     * Generate next value
     *
     * @return mixed
     */
    public function next()
    {
        return $this->getNextRandomValue();
    }
}

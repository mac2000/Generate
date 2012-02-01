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
require_once 'generator_abstract_predefined.php';
/**
 * @see Generator_Number
 */
require_once 'generator_number.php';
/**
 * Class for generating phone.
 *
 * @category   Library
 * @package    Generator
 * @subpackage Phone
 */
class Generator_Phone extends Generator_Abstract_Predefined
{
    /**
     * Phone templates
     *
     * @var array
     */
    protected $_predefinedValues = array(
        '###-####',
        '###-##-##',
        '(###) ###-####',
        '(###) ###-##-##',
        '+#(###) ###-####',
        '+#(###) ###-##-##',
    );

    /**
     * Number generator
     *
     * @var Generator_Number
     */
    protected $_numberGenerator;

    public function __construct($predefinedValues = array())
    {
        parent::__construct($predefinedValues);
        $this->_numberGenerator = new Generator_Number();
    }

    public function next()
    {
        $this->srand();
        $template = parent::next();

        while(strpos($template, '#') !== false) {
            $template = preg_replace('/#/', $this->_numberGenerator->next(0, 9), $template, 1);
        }

        return $template;
    }
}
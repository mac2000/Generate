<?php
/**
 * Generate
 *
 * @category   Library
 * @package    Generate
 * @subpackage Abstract
 */

/**
 * Class for generating something, main purpose is to define next
 * method that must be implemented in all other childs.
 *
 * @category   Library
 * @package    Generator
 * @subpackage Abstract
 */
abstract class Generator_Abstract
{
    /**
     * Abstract generator construct calls to srand method
     */
    public function __construct() {
        $this->srand();
    }

    /**
     * Make seed for srand
     *
     * @return float
     */
    public function make_seed()
    {
        list($usec, $sec) = explode(' ', microtime());
        return (float)$sec + ((float)$usec * 100000);
    }

    /**
     * srand
     *
     * @return void
     */
    public function srand()
    {
        srand($this->make_seed());
    }

    /**
     * Generate random value
     *
     * @return string
     */
    abstract public function next();
}

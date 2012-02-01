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
 * Class for generating number.
 *
 * @category   Library
 * @package    Generator
 * @subpackage Number
 */
class Generator_Number extends Generator_Abstract
{
    /**
     * Generate number
     *
     * @param int $min
     * @param null $max
     * @return int
     */
    public function next($min = 0, $max = null) {
        if(!$max) $max = getrandmax();
        $this->srand();
        return rand($min, $max);
    }
}

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
 * @subpackage Gauss
 */
class Generator_Gauss extends Generator_Abstract
{
    /**
     * Generate gauss
     *
     * @param int $avg
     * @param int $stdDev
     * @return float
     */
    public function next($avg = 1, $stdDev = 0)
    {
        $x = (float)rand() / (float)getrandmax();
        $y = (float)rand() / (float)getrandmax();

        $u = sqrt(-2 * log($x)) * cos(2 * pi() * $y);

        return $u * $stdDev + $avg;
    }
}

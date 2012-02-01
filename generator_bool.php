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
require_once 'generator_number.php';

/**
 * Class for generating bool.
 *
 * @category   Library
 * @package    Generator
 * @subpackage Bool
 */
class Generator_Bool extends Generator_Number
{
    public function next() {
        return parent::next(1, 100) % 2 == 0;
    }
}

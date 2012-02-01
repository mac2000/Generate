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
 * Class for generating password.
 *
 * @category   Library
 * @package    Generator
 * @subpackage Password
 */
class Generator_Password extends Generator_Abstract
{
    /**
     * Letters
     *
     * @var array
     */
    protected $_letters = array(
        "q",
        "w",
        "e",
        "r",
        "t",
        "y",
        "u",
        "i",
        "o",
        "p",
        "a",
        "s",
        "d",
        "f",
        "g",
        "h",
        "j",
        "k",
        "l",
        "z",
        "x",
        "c",
        "v",
        "b",
        "n",
        "m",
        "Q",
        "W",
        "E",
        "R",
        "T",
        "Y",
        "U",
        "I",
        "O",
        "P",
        "A",
        "S",
        "D",
        "F",
        "G",
        "H",
        "J",
        "K",
        "L",
        "Z",
        "X",
        "C",
        "V",
        "B",
        "N",
        "M",
        "1",
        "2",
        "3",
        "4",
        "5",
        "6",
        "7",
        "8",
        "9",
        "0",
    );

    /**
     * Generate password
     *
     * @return string
     */
    public function next($length = 0)
    {
        if ($length <= 0) {
            $this->srand();
            $length = rand(4, 10);
        }

        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $this->srand();
            $password .= $this->_letters[array_rand($this->_letters)];
        }

        return (string)$password;
    }
}

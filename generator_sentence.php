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
 * @see Generator_Word
 */
require_once 'generator_word.php';
/**
 * @see Generator_Gauss
 */
require_once 'generator_gauss.php';
/**
 * Class for generating sentence.
 *
 * @category   Library
 * @package    Generator
 * @subpackage Sentence
 */
class Generator_Sentence extends Generator_Abstract
{
    /**
     * Word generator
     *
     * @var Generator_Word
     */
    protected $_wordGenerator;
    /**
     * Gauss generator
     *
     * @var Generator_Gauss
     */
    protected $_gaussGenerator;

    public function __construct()
    {
        parent::__construct();
        $this->_wordGenerator = new Generator_Word();
        $this->_gaussGenerator = new Generator_Gauss();
    }

    /**
     * Generate sentence
     *
     * @return string
     */
    public function next($words = 0, $loremipsum = null)
    {
        $this->srand();
        if ($words <= 0) {
            $words = (int)round($this->_gaussGenerator->next((float)24.460, (float)5.080));
        }
        if ($loremipsum === null) {
            $loremipsum = (rand(1, 10) % 2 == 0);
        }

        $words = $this->_getWords($words, $loremipsum);
        $words = $this->_addCommas($words);

        $words[0] = ucfirst($words[0]);
        //$words[count($words) - 1] = $words[count($words) - 1] . '.';


        return implode(' ', $words) . '.';
    }

    /**
     * Get random words
     *
     * @param int $count
     * @param bool $loremipsum
     * @return array
     */
    protected function _getWords($count, $loremipsum)
    {
        $words = array();
        $i = 0;
        if ($loremipsum) {
            $i = 2;
            $words[0] = 'lorem';
            $words[1] = 'ipsum';
        }

        for ($i; $i < $count; $i++) {
            $word = $this->_wordGenerator->next();

            if ($i > 0 && $words[$i - 1] == $word) {
                $i--;
            } else {
                $words[$i] = $word;
            }
        }

        return (array)$words;
    }

    /**
     * Add commas
     *
     * @param array $words
     * @return array
     */
    protected function _addCommas(array $words)
    {
        $count = count($words);

        if ($count > 4) {
            $commas = (int)round($this->_gaussGenerator->next((float)log($count, 6), (float)log($count, 6) / 6.000));

            for ($i = 1; $i <= $commas; $i++) {
                $index = (int)round($i * $count / ($commas + 1));

                if ($index < ($count - 1) && $index > 0) {
                    $words[$index] = $words[$index] . ',';
                }
            }
        }
        return (array)$words;
    }
}

<?php
/**
 * Generate
 *
 * @category   Library
 * @package    Generate
 * @subpackage Generator
 */
/**
 * @see Generator_Url
 */
require_once 'generator_url.php';
/**
 * @see Generator_Sentence
 */
require_once 'generator_sentence.php';
/**
 * @see Generator_Number
 */
require_once 'generator_number.php';
/**
 * Class for generating html paragraph.
 *
 * @category   Library
 * @package    Generator
 * @subpackage Paragraph
 */
class Generator_Html_Paragraph extends Generator_Sentence
{
    /**
     * Url generator
     *
     * @var Generator_Url
     */
    protected $_urlGenerator;
    /**
         * Number generator
         *
         * @var Generator_Number
         */
        protected $_numberGenerator;

    public function __construct()
    {
        parent::__construct();
        $this->_urlGenerator = new Generator_Url();
        $this->_numberGenerator = new Generator_Number();
        $this->_transliterate = new Transliterate();
    }

    /**
     * Generate Html Paragraph
     *
     * @param int $words
     * @param null $loremipsum
     * @param null $tags
     * @return string
     */
    public function next($words = 0, $loremipsum = null, $tags = null)
    {
        $this->srand();
        $innerHtml = $this->_generateInnerHtml($words, $loremipsum, $tags);
        return (string)'<p>' . $innerHtml . '</p>';
    }

    /**
     * Generate innerHtml
     *
     * @param int $count
     * @param bool $loremipsum
     * @param bool $tags
     * @return string
     */
    protected function _generateInnerHtml($count = 0, $loremipsum = null, $tags = null)
    {
        if ($count <= 0) {
            $count = (int)round($this->_gaussGenerator->next((float)24.460, (float)5.080));
        }
        if ($loremipsum === null) {
            $loremipsum = ($this->_numberGenerator->next(1, 100) % 2 == 0);
        }
        if ($tags === null) {
            $tags = ($this->_numberGenerator->next(1, 100) % 2 == 0);
        }

        $words = $this->_getWords($count, $loremipsum);
        $words[0] = ucfirst($words[0]);

        if ($tags === true) {
            $words = $this->_addTags($words);
        }
        $words = $this->_addCommas($words);

        return (string)implode(' ', $words) . '.';
    }

    /**
     * Add tags
     *
     * @param array $words
     * @return array
     */
    protected function _addTags(array $words)
    {
        $count = count($words);

        if ($count > 4) {
            $commas = (int)round($this->_gaussGenerator->next((float)log($count, 6), (float)log($count, 6) / 6.000));

            for ($i = 1; $i <= $commas; $i++) {
                $index = (int)round($i * $count / ($commas + 1));

                if ($index < ($count - 1) && $index > 0) {
                    $words[$index] = $this->_addRandomTag($words[$index]);
                }
            }
        }
        return (array)$words;
    }

    /**
     * Add random tag for word
     *
     * @param string $word
     * @return string
     */
    protected function _addRandomTag($word)
    {
        $tags = array('a', 'b', 'i', 'u', 'strong', 'em');

        $html = array();
        foreach ($tags as $tag) {
            $attr = '';
            if ($tag == 'a') {
                $attr = ' href="' . $this->_urlGenerator->next() . '" ';
            }
            $html[] = "<$tag$attr>$word</$tag>";
            foreach ($tags as $tag2) {
                if ($tag == $tag2) continue;

                $attr2 = '';
                if ($tag2 == 'a') {
                    $attr2 = ' href="' . $this->_urlGenerator->next() . '" ';
                }

                $html[] = "<$tag$attr>$word</$tag>";
                $html[] = "<$tag$attr><$tag2$attr2>$word</$tag2></$tag>";
            }
        }

        $this->srand();
        return (string)$html[array_rand($html)];
    }
}

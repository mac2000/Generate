<?php
/**
 * Generate
 *
 * @category   Library
 * @package    Generate
 * @subpackage Generator
 */
/**
 * @see Generator_Html_Paragraph
 */
require_once 'generator_html_paragraph.php';
/**
 * @see Generator_Number
 */
require_once 'generator_number.php';
/**
 * Class for generating list.
 *
 * @category   Library
 * @package    Generator
 * @subpackage List
 */
class Generator_Html_List extends Generator_Html_Paragraph
{
    const UNORDERED_LIST = 'ul';
    const ORDERED_LIST = 'ol';

    /**
     * Number generator
     *
     * @var Generator_Number
     */
    protected $_numberGenerator;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->_numberGenerator = new Generator_Number();
    }

    /**
     * Generate list
     *
     * @param string $type
     * @param int $items
     * @param bool $tags
     * @return string
     */
    public function next($type = null, $items = 0, $tags = null)
    {
        $this->srand();

        if ($type === null) {
            $type = ($this->_numberGenerator->next(1, 100) % 2 == 0) ? self::UNORDERED_LIST : self::ORDERED_LIST;
        }

        if ($items <= 0) {
            $items = $this->_numberGenerator->next(3, 10);
        }

        $output = "<$type>";
        for ($i = 0; $i < $items; $i++) {
            $innerCount = $this->_numberGenerator->next(3, 10);
            $innerHtml = $this->_generateInnerHtml($innerCount, null, $tags);
            $output .= "<li>$innerHtml</li>";
        }
        $output .= "</$type>";

        return (string)$output;
    }
}

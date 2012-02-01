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
 * @see Generator_Html_List
 */
require_once 'generator_html_list.php';
/**
 * @see Generator_Html_Table
 */
require_once 'generator_html_table.php';
/**
 * @see Generator_Html_Img
 */
require_once 'generator_html_img.php';
/**
 * @see Generator_Number
 */
require_once 'generator_number.php';
/**
 * Class for generating html.
 *
 * @category   Library
 * @package    Generator
 * @subpackage Html
 */
class Generator_Html extends Generator_Html_Paragraph
{
    /**
     * Img generator
     *
     * @var Generator_Img
     */
    protected $_imgGenerator;
    /**
     * List generator
     *
     * @var Generator_List
     */
    protected $_listGenerator;
    /**
     * Table generator
     *
     * @var Generator_Table
     */
    protected $_tableGenerator;
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
        $this->_imgGenerator = new Generator_Html_Img();
        $this->_listGenerator = new Generator_Html_List();
        $this->_tableGenerator = new Generator_Html_Table();
    }

    /**
     * Generate Html
     *
     * @return string
     */
    public function next()
    {
        $tags = array(
            //'h1',
            'h2',
            'h3',
            'h4',
            'blockquote',
            'ol',
            'ul',
            'img',
            'table',
        );

        $html = array();

        foreach ($tags as $tag) {
            if ($tag == 'ul' || $tag == 'ol') {
                $html[] = $this->_listGenerator->next($tag);
            } else if ($tag == 'img') {
                $align = $this->_numberGenerator->next(1, 100) % 2 == 0 ? Generator_Html_Img::IMG_ALIGN_LEFT : Generator_Html_Img::IMG_ALIGN_RIGHT;
                $img = $this->_imgGenerator->next($align);
                $p = '<p>' . $this->_generateInnerHtml() . '</p>';
                $html[] = $img . $p;
            } else if ($tag == 'table') {
                if ($this->_numberGenerator->next(1, 100) % 2 == 0) {
                    $html[] = $this->_tableGenerator->next();
                }
            } else if ($tag == 'blockquote') {
                if ($this->_numberGenerator->next(1, 100) % 2 == 0) {
                    $innerHtml = $this->_generateInnerHtml(0, null, false);
                    $html[] = "<$tag><p>$innerHtml</p></$tag>";
                }
            } else {
                $innerHtml = $this->_generateInnerHtml(0, null, false);
                $html[] = "<$tag>$innerHtml</$tag>";
            }
        }

        $this->srand();
        shuffle($html);

        $count = round(count($html) / 2);
        $output = '';
        for ($i = 0; $i < $count; $i++) {
            $output .= $html[$i];
            $output .= '<p>' . $this->_generateInnerHtml() . '</p>';

            if ($i > $this->_numberGenerator->next(1, $count)) {
                $this->srand();
                shuffle($html);
            }
        }

        return (string)$output;
    }
}

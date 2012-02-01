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
 * Class for generating table.
 *
 * @category   Library
 * @package    Generator
 * @subpackage Table
 */
class Generator_Html_Table extends Generator_Html_Paragraph
{
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
     * Generate table
     *
     * @param int $rows
     * @param int $cols
     * @param bool $verticalHeaders
     * @param bool $horisontalHeader
     * @param int $cellPadding
     * @param int $cellSpacing
     * @param int $border
     * @param bool $summary
     * @param bool $caption
     * @return string
     */
    public function next($rows = 0, $cols = 0, $verticalHeaders = null, $horisontalHeader = null, $cellPadding = null, $cellSpacing = null, $border = null, $summary = null, $caption = null)
    {
        $this->srand();

        if ($verticalHeaders === null) {
            $verticalHeaders = ($this->_numberGenerator->next(1, 100) % 2 == 0);
        }

        if ($horisontalHeader === null) {
            $horisontalHeader = ($this->_numberGenerator->next(1, 100) % 2 == 0);
        }

        if ($rows <= 0) {
            $rows = $this->_numberGenerator->next(3, 8);
        }

        if ($cols <= 0) {
            $cols = $this->_numberGenerator->next(3, 8);
        }

        $attr = '';
        if ($cellPadding !== null) {
            $attr .= ' cellpadding="' . $cellPadding . '" ';
        }
        if ($cellSpacing !== null) {
            $attr .= ' cellspacing="' . $cellSpacing . '" ';
        }
        if ($border !== null) {
            $attr .= ' border="' . $border . '" ';
        }
        if ($summary !== null) {
            $innerHTML = $this->_wordGenerator->next();
            $attr .= ' summary="' . $innerHTML . '" ';
        }


        $output = "<table$attr>";
        if ($caption !== null) {
            $innerHTML = $this->_wordGenerator->next();
            $output .= "<caption>$innerHTML</caption>";
        }
        for ($row = 0; $row < $rows; $row++) {
            $output .= "<tr>";
            for ($col = 0; $col < $cols; $col++) {
                $tag = 'td';
                $innerHTML = $this->_numberGenerator->next(1, 100);

                if (($verticalHeaders && $col == 0) || ($horisontalHeader && $row == 0)) {
                    $tag = 'th';
                    $innerHTML = $this->_wordGenerator->next();
                }

                $output .= "<$tag>$innerHTML</$tag>";
            }
            $output .= "</tr>";
        }
        $output .= "</table>";


        return (string)$output;
    }
}

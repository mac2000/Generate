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
require_once 'generator_abstract_predefined.php';

/**
 * Class for generating html image.
 *
 * @category   Library
 * @package    Generator
 * @subpackage Img
 */
class Generator_Html_Img extends Generator_Abstract_Predefined
{
    const IMG_ALIGN_LEFT = 'left';
    const IMG_ALIGN_RIGHT = 'right';

    /**
     * Constructor
     *
     * @param array $predefinedImages
     */
    public function __construct($predefinedImages = array())
    {
        parent::__construct();
        if (!empty($predefinedImages)) {
            $this->setPredefinedValues($predefinedImages);
        } else {
            $this->setPredefinedValues($this->getCachedFlickrPhotos());
        }
    }

    /**
     * Get cache file name
     *
     * @return string
     */
    private function getCacheFilePath()
    {
        $dir = sys_get_temp_dir();
        $dir = trim($dir, '\\/');
        $fileName = date('Ymd') . '_generator_html_img_cache.txt';
        return (string)$dir . DIRECTORY_SEPARATOR . $fileName;
    }

    public function getCachedFlickrPhotos()
    {
        $cacheFilePath = $this->getCacheFilePath();
        if (!file_exists($cacheFilePath)) {
            $this->getFlickrPhotos();
        }
        return explode(PHP_EOL, file_get_contents($cacheFilePath));
    }

    public function getFlickrPhotos()
    {
        $doc = new DOMDocument();
        $doc->load('http://api.flickr.com/services/feeds/photos_public.gne');
        $images = array();
        foreach ($doc->getElementsByTagName('content') as $content) {
            preg_match('/<img[^>]+>/i', $content->nodeValue, $matches);

            if (count($matches) > 0 && !empty($matches[0])) {
                array_push($images, $matches[0]);
            }
        }

        file_put_contents($this->getCacheFilePath(), implode(PHP_EOL, $images));
    }

    /**
     * Generate Html Image
     *
     * @param null $align
     * @param null $vspace
     * @param null $hspace
     * @return string
     */
    public function next($align = null, $vspace = null, $hspace = null)
    {
        $img = (string)parent::next();

        if ($align !== null) {
            $img = str_replace('<img', '<img align="' . $align . '" ', $img);
        }

        if ($vspace !== null) {
            $img = str_replace('<img', '<img vspace="' . $vspace . '" ', $img);
        }

        if ($hspace !== null) {
            $img = str_replace('<img', '<img hspace="' . $hspace . '" ', $img);
        }

        return (string)$img;
    }
}
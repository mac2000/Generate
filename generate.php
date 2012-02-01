<?php
/**
 * Generate
 *
 * @category   Library
 * @package    Generate
 */
set_include_path(get_include_path().PATH_SEPARATOR.'./');
spl_autoload_register();

/**
 * Class for generating something.
 *
 * @category   Library
 * @package    Generate
 */
class Generate
{
    const ADDRESS = 'Generator_Address';
    const BOOL = 'Generator_Bool';
    const CITY = 'Generator_City';
    const COMPANY_NAME = 'Generator_CompanyName';
    const COUNTRY = 'Generator_Country';
    const COUNTRY_CODE_THREE = 'Generator_CountryCode_Three';
    const COUNTRY_CODE_TWO = 'Generator_CountryCode_Two';
    const DOMAIN = 'Generator_Domain';
    const EMAIL = 'Generator_Email';
    const FIRST_NAME = 'Generator_FirstName';
    const GAUSS = 'Generator_Gauss';
    const HTML = 'Generator_Html';
    const HTML_IMG = 'Generator_Html_Img';
    const HTML_LIST = 'Generator_Html_List';
    const HTML_PARAGRAPH = 'Generator_Html_Paragraph';
    const HTML_TABLE = 'Generator_Html_Table';
    const IP = 'Generator_Ip';
    const LAST_NAME = 'Generator_LastName';
    const LOGIN = 'Generator_Login';
    const NUMBER = 'Generator_Number';
    const PASSWORD = 'Generator_Password';
    const PHONE = 'Generator_Phone';
    const SENTENCE = 'Generator_Sentence';
    const STATE = 'Generator_State';
    const STATE_CODE = 'Generator_StateCode';
    const URL = 'Generator_Url';
    const WORD = 'Generator_Word';
    const ZIP = 'Generator_Zip';


    /**
     * Generator instances
     *
     * @var array
     */
    private static $_generators = array();

    /**
     * Generate something
     *
     * @param const $type
     * @return string
     */
    public static function get($type = self::SENTENCE)
    {
        if (!array_key_exists($type, self::$_generators)) {
            //require_once $type;
            self::$_generators[$type] = new $type();
        }
		self::$_generators[$type]->srand();
        return (string) self::$_generators[$type]->next();
    }
}

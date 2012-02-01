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
 * @see Generator_Domain
 */
require_once 'generator_domain.php';
/**
 * @see Generator_Login
 */
require_once 'generator_login.php';
/**
 * Class for generating email.
 *
 * @category   Library
 * @package    Generator
 * @subpackage Email
 */
class Generator_Email extends Generator_Abstract
{
    /**
     * Domain generator
     *
     * @var Generator_Domain
     */
    protected $_domainGenerator;
    /**
     * Login generator
     *
     * @var Generator_Login
     */
    protected $_loginGenerator;

    public function __construct()
    {
        parent::__construct();
        $this->_domainGenerator = new Generator_Domain();
        $this->_loginGenerator = new Generator_Login();
    }

    /**
     * Generate Email
     *
     * @return string
     */
    public function next()
    {
        $this->srand();
        return $this->_loginGenerator->next() . '@' . $this->_domainGenerator->next();
    }
}

<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Filter
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc.
 * (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * @see Zend_Filter_Interface
 */
require_once 'Zend/Filter/Interface.php';

/**
 * @category Zend
 * @package  App_Filter
 * @author   Bruno Thiago Leite Agutoli <brunotla1@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @version  Release: 0.1
 * @license  http://framework.zend.com/license/new-bsd     New BSD License
 */
class App_Filter_CharConvert implements Zend_Filter_Interface
{
    /**
     * Corresponds to the third
     *
     * @var string
     */
    protected $_encoding;

    /**
     * Corresponds to the third 
     *
     * @var string
     */
    protected $_locale;

    /**
     * Enter description here ...
     * 
     * @var string
     */
    protected $_replaceWhiteSpace;

    /**
     * Sets filter options
     *
     * @param  integer|array $quoteStyle
     * @param  string  $charSet
     * @return void
     */
    public function __construct($options = array())
    {
        if ($options instanceof Zend_Config) {
            $options = $options->toArray();
        } else if (!is_array($options)) {
            $options = func_get_args();
            $temp = array();
            if (isset($options[0])) {
            	$temp['charset'] = $options[0];
            }
            
            if (isset($options[1])) {
            	$temp['locale'] = $options[1];
            }

            if (isset($options[2])) {
                $temp['replaceWhiteSpace'] = $options[2];
            }
            $options = $temp;
        }
        
        if (!isset($options['encoding'])) {
            $options['encoding'] = 'UTF-8';
        }
 
        if (isset($options['charset'])) {
            $options['encoding'] = $options['charset'];
        }

        if (!isset($options['locale'])) {
            $options['locale'] = 'en_US';
        }

        if (!isset($options['replaceWhiteSpace'])) {
            $options['replaceWhiteSpace'] = false;
        }

        $this->setLocale($options['locale']);
        $this->setEncoding($options['encoding']);
        $this->setReplaceWhiteSpace($options['replaceWhiteSpace']);
    }

    /**
     * Set replaceWhiteSpace
     * @param  string $value
     * 
     * @return App_Filter_CharConvert
     */
    public function setReplaceWhiteSpace($value)
    {
        $this->_replaceWhiteSpace = $value;
        return $this;
    }

    /**
     * Get replaceWhiteSpace
     *
     * @return string
     */
    public function getReplaceWhiteSpace()
    {
        return $this->_replaceWhiteSpace;
    }

    /**
     * Get locale
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->_locale;
    }

    /**
     * Set locale
     *
     * @param  string $value
     * 
     * @return App_Filter_CharConvert
     */
    public function setLocale($value)
    {
        $this->_locale = (string) $value;
        return $this;
    }

    /**
     * Get encoding
     *
     * @return string
     */
    public function getEncoding()
    {
        return $this->_encoding;
    }

    /**
     * Set encoding
     *
     * @param  string $value
     * 
     * @return App_Filter_CharConvert
     */
    public function setEncoding($value)
    {
        $this->_encoding = (string) $value;
        return $this;
    }

    /**
     * Returns the result of filtering $value
     *
     * @param  mixed $value
     * 
     * @throws App_Filter_Exception If filtering $value is impossible
     * @return mixed
     */
    public function filter($value)
    {
        if (!function_exists('iconv')) {
            require_once 'App/Filter/Exception.php';
            throw new Zend_Filter_Exception('Function iconv is required (PHP 4 >= 4.0.5, PHP 5)!');
        }
        //Get options
        $loc = $this->getLocale();
        $enc = $this->getEncoding();
        $rws = $this->getReplaceWhiteSpace();
        //Set locale
        setlocale(LC_ALL, $loc .".". $enc);
        //suppress errors @iconv
        $filtered = @iconv($enc, 'ASCII//TRANSLIT', $value);
        if (false !== $rws) {
            $filtered = preg_replace('/\s\s+/', ' ', trim($filtered));
            $filtered = str_replace(' ', $rws, $filtered);
        }
        return $filtered;
    }
}
?>

<?php
/**
 * Zend Framework
 *
 * LICENSE
 * 
 * PHP version 5
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category  Zend
 * @package   Zend_Filter
 * @copyright Copyright (c) 2005-2011 Zend Technologies USA Inc.
 * @license   http://framework.zend.com/license/new-bsd     New BSD License
 * @
 */

/**
 * @see Zend_Filter_Interface
 */
require_once 'Zend/Filter/Interface.php';

/**
 * @category Zend
 * @package  Zag_Filter
 * @author   Bruno Thiago Leite Agutoli <brunotla1@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @version  Release: 0.1
 * @license  http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zag_Filter_CharConvert implements Zend_Filter_Interface
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
     * Replace white space for some chacacter
     * 
     * @var string
     */
    protected $_replaceWhiteSpace;

    /**
     * Allow only Alpha characters and numbers
     * 
     * @var boolean
     */
    protected $_onlyAlnum;

    /**
     * Sets the characters that are relevant and keeps the text 
     *
     * @var string|array
     */
    protected $_relevantChars;

   /**
     * Sets the characters that are relevant and should be 
     * replaced by the value set in "replaceWhiteSpace"
     *
     * @var string|array
     */
    protected $_irrelevantChars;

    /**
     * Constant that holds an empty space
     *
     * string WHITE_SPACE
     */
    const WHITE_SPACE = ' ';

    /**
     * Sets filter options
     *
     * @param  string|array $charset
     * @param  string|array $locale
     * @param  string|array $replaceWhiteSpace
     * @param  boolean|array $onlyAlnum
     * @param  string|array $relevantChars
     * @param  string|array $irrelevantChars
     *
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
            
            if (isset($options[3])) {
                $temp['onlyAlnum'] = $options[3];
            }

            if (isset($options[4])) {
                $temp['relevantChars'] = $options[4];
            }

            if (isset($options[5])) {
                $temp['irrelevantChars'] = $options[5];
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
            $options['replaceWhiteSpace'] = ' ';
        }

        if (!isset($options['onlyAlnum'])) {
            $options['onlyAlnum'] = false;
        }

        if (!isset($options['relevantChars'])) {
            $options['relevantChars'] = '\+';
        }

        if (!isset($options['irrelevantChars'])) {
            $options['irrelevantChars'] = '\/'; 
        }
        $this->setLocale($options['locale']);
        $this->setEncoding($options['encoding']);
        $this->setReplaceWhiteSpace($options['replaceWhiteSpace']);
        $this->setOnlyAlnum($options['onlyAlnum']);
        $this->setRelevantChars($options['relevantChars']);
        $this->setIrrelevantChars($options['irrelevantChars']);
    }

    /**
     * Set replaceWhiteSpace
     * @param  string $value
     * 
     * @return Zag_Filter_CharConvert
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
     * Set onlyAlnum
     * @param  string $value
     *
     * @return Zag_Filter_CharConvert
     */
    public function setOnlyAlnum($value)
    {
        $this->_onlyAlnum = $value;
        return $this;
    }

    /**
     * Get onlyAlnum
     *
     * @return string
     */
    public function getOnlyAlnum()
    {
        return $this->_onlyAlnum;
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
     * @return Zag_Filter_CharConvert
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
     * @return Zag_Filter_CharConvert
     */
    public function setEncoding($value)
    {
        $this->_encoding = (string) $value;
        return $this;
    }

    /**
     * Get relevant characters
     *
     * @return string|array
     */
    public function getRelevantChars()
    {
        return $this->_relevantChars;
    }

    /**
     * Set characters
     *
     * @param  string|array $chars
     * 
     * @return Zag_Filter_CharConvert
     */
    public function setRelevantChars($chars)
    {
        $this->_relevantChars = $chars;
        return $this;
    }

    /**
     * Get irrelevant characters
     *
     * @return string|array
     */
    public function getIrrelevantChars()
    {
        return $this->_irrelevantChars;
    }

    /**
     * Set irrelevantes characters arrow irrelevant that the characters 
     * need to be replaced by the parameter chosen "replaceWhiteSpace"
     *
     * @param  string|array $chars
     * 
     * @return Zag_Filter_CharConvert
     */
    public function setIrrelevantChars($chars)
    {
        $this->_irrelevantChars = $chars;
        return $this;
    }

    /**
     * Returns the result of filtering $value
     *
     * @param  mixed $value
     * 
     * @throws Zag_Filter_Exception If filtering $value is impossible
     * @return mixed
     */
    public function filter($value)
    {
        if (!function_exists('iconv')) {
            require_once 'Zag/Filter/Exception.php';
            throw new Zag_Filter_Exception('Function iconv is required (PHP 4 >= 4.0.5, PHP 5)!');
        }
        //Get options
        $loc = $this->getLocale();
        $enc = $this->getEncoding();
        $rws = $this->getReplaceWhiteSpace();
        $oan = $this->getOnlyAlNum();
        $rlc = $this->getRelevantChars();
        $ilc = $this->getIrrelevantChars();

        //Set locale
        setlocale(LC_ALL, $loc .".". $enc);
        //suppress errors @iconv
        $filtered = @iconv($enc, 'ASCII//TRANSLIT', $value);

        if (true === $oan) {
            $relevantChars   = (is_array($rlc))? implode('', $rlc) : $rlc;
            $irrelevantChars = (is_array($ilc))? implode('', $ilc) : $ilc;
            $filtered  = preg_replace("/[^a-zA-Z0-9{$irrelevantChars}{$relevantChars}\\{$rws} ]*/", '', trim($filtered));
            $filtered  = preg_replace("/[{$irrelevantChars}{$rws}]+/", self::WHITE_SPACE, $filtered);
        }

        if (self::WHITE_SPACE !== $rws) {
            $filtered = preg_replace('/\s\s+/', self::WHITE_SPACE, $filtered);
            $filtered = str_replace(self::WHITE_SPACE, $rws, $filtered);
        }
        return $filtered;
    }
}
?>

<?php

/** require repositories. pear **/
require_once 'PHPUnit/Framework.php';

/** path Zag on git hub**/
require_once '../Zend/Loader/Autoloader.php';
require_once '../Zag/Filter/CharConvert.php';

class Utf8ToAsciiTest extends PHPUnit_Framework_TestCase
{
    /**
     * Convert á to a
     */
    public function testAWithAccentAcute_To_AWithoutAccentAcute()
    {
        $filter = new Zag_Filter_CharConvert();
        $this->assertEquals('a',$filter->filter('á'));		
    }

    /**
     * Convert é to e
     */
    public function testEWithAccentAcute_To_EWithoutAccentAcute()
    {
        $filter = new Zag_Filter_CharConvert();
        $this->assertEquals('e',$filter->filter('é'));
    }
    
    /**
     * Convert í to i
     */
    public function testIWithAccentAcute_To_IWithoutAccentAcute()
    {
        $filter = new Zag_Filter_CharConvert();
        $this->assertEquals('i',$filter->filter('í'));
    }
    
    /**
     * Convert ó to o
     */
    public function testOWithAccentAcute_To_OWithoutAccentAcute()
    {
        $filter = new Zag_Filter_CharConvert();
        $this->assertEquals('o',$filter->filter('ó'));
    }
    
    /**
     * Convert ú to u
     */
    public function testUWithAccentAcute_To_UWithoutAccentAcute()
    {
        $filter = new Zag_Filter_CharConvert();
        $this->assertEquals('u',$filter->filter('ú'));
    }
    
    /**
     * Convert ão to ao
     */
    public function testAOWithAccentTilde_To_AOWithoutAccentTilde()
    {
        $filter = new Zag_Filter_CharConvert();
        $this->assertEquals('ao',$filter->filter('ão'));
    }
}

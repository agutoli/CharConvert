<?php

/** require repositories. pear **/
require_once 'PHPUnit/Framework.php';

/** path Zag on git hub**/
require '../Zend/Loader/Autoloader.php';
require '../Zag/Filter/CharConvert.php';

class Utf8ToAsciiTest extends PHPUnit_Framework_TestCase
{
    /**
     * Convert á to a
     */
    public function testAWithAccent_To_AWithoutAccent()
    {
        $filter = new Zag_Filter_CharConvert();
        $this->assertEquals('a', $filter->filter('á'));		
    }

    /**
     * Convert é to e
     */
    public function testEWithAccent_To_EWithoutAccent()
    {
        $filter = new Zag_Filter_CharConvert();
        $this->assertEquals('e', $filter->filter('é'));
    }
    
    /**
     * Convert í to i
     */
    public function testIWithAccent_To_IWithoutAccent()
    {
        $filter = new Zag_Filter_CharConvert();
        $this->assertEquals('i', $filter->filter('í'));
    }
    
    /**
     * Convert ó to o
     */
    public function testOWithAccent_To_OWithoutAccent()
    {
		$filter = new Zag_Filter_CharConvert();
        $this->assertEquals('o', $filter->filter('ó'));
    }
}

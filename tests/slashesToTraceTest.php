<?php

/** require repositories. pear **/
require_once 'PHPUnit/Framework.php';

/** path Zag on git hub**/
require_once '../Zend/Loader/Autoloader.php';
require_once '../Zag/Filter/CharConvert.php';

class SlasheToTraceTest extends PHPUnit_Framework_TestCase
{
    /**
     * Convert á to a
     */
    public function testSlashToTrace()
    {
        $filter = new Zag_Filter_CharConvert(array(
            'onlyAlnum' => true,
            'replaceWhiteSpace' => '-'
        ));
        $this->assertEquals('Sao-Paulo-2011-2012',$filter->filter('São Paulo 2011/2012'));
    }

     /**
     * Convert á to a
     */
    public function testTwoTrace_to_OneTrace()
    {
        $filter = new Zag_Filter_CharConvert(array(
            'onlyAlnum' => true,
            'replaceWhiteSpace' => '-'
        ));
        $this->assertEquals('Sao-Paulo-2011-2012',$filter->filter('São--Paulo 2011/2012'));
    }
}

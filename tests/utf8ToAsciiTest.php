<?php

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

    public function testSetLocale_And_ReplaceWhiteSpace()
    {
        $filter = new Zag_Filter_CharConvert(array(
            'locale' => 'pt-BR',
            'replaceWhiteSpace' => '-'
        ));

        $this->assertEquals('Capitulo---Teste-de-capitulo---2',$filter->filter('Capítulo - Teste de capítulo - 2'));
    
    }


    public function testSetLocale_And_ReplaceWhiteSpace_And_OnlyAlnum()
    {
        $filter = new Zag_Filter_CharConvert(array(
            'locale' => 'pt-BR',
            'replaceWhiteSpace' => '-',
            'onlyAlnum' => true// note: this parameter is essential if you want to 
                               //avoid unwanted parameters on conversion or repeating characters such as space
        ));
        
        $this->assertEquals('Capitulo-Teste-de-capitulo-2',$filter->filter('Capítulo - Teste de capítulo - 2'));
    }


    public function testSetLocale_And_OnlyAlnum()
    {
        $filter = new Zag_Filter_CharConvert(array(
            'locale' => 'pt-BR',
            'onlyAlnum' => true// note: this parameter is essential if you want to 
                               //avoid unwanted parameters on conversion or repeating characters such as space
        ));

        $this->assertEquals('Voce nao esta vendo todos os suprimentos nesta carga',$filter->filter('Você não está vendo todos os suprimentos nesta carga'));
    }

}

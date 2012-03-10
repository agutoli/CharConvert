<?php
/** dependencies **/
require 'Zend/Loader/Autoloader.php';
require 'Zag/Filter/CharConvert.php';

Zend_Loader_Autoloader::getInstance()->setFallbackAutoloader(true);

//removes accents
$filter = new Zag_Filter_CharConvert();
echo $filter->filter('éééé áááá ')."\n";

//makes a special treatment to generate a url with no special characters
$friendlyUrl = new Zag_Filter_CharConvert(array(
    'replaceWhiteSpace' => '-',
    'onlyAlnum' => true 
));

//output: Este-e-um-texto-com-caracteres-especiais-2011-2012
echo $friendlyUrl->filter('Este é um texto com -- carácteres especiais... 2011/2012')."\n";


//other example of friendly url
$friendlyUrl2 = new Zag_Filter_CharConvert(array(
    'replaceWhiteSpace' => '-',
    'onlyAlnum' => true,
    'relevantChars' => array('+')
));

//output: The-value-of-1+1-is-2
echo $friendlyUrl2->filter('The & value of 1+1 is = 2')."\n";


//combination of filters with Zend_Filter
$filter = new Zend_Filter;
$filter->addFilter(new Zag_Filter_CharConvert(array(
    'replaceWhiteSpace' => '-', 
    'onlyAlnum' => true,
    	
)));
$filter->addFilter(new Zend_Filter_StringToLower());
//output: this-is-a-test-2011-2012
echo $filter->filter('This is a test & 2011/2012')."\n";

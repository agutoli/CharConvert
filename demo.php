<?php
/** dependencies **/
require 'Zend/Loader/Autoloader.php';
require 'Zag/Filter/CharConvert.php';

Zend_Loader_Autoloader::getInstance()->setFallbackAutoloader(true);

$filter = new Zag_Filter_CharConvert();
echo $filter->filter('éééé áááá ');


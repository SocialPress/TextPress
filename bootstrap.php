<?php
/**
* Require necessary files
*/
require 'Slim/Slim.php';
require 'lib/Textpress.php';
require 'lib/View.php';



/**
* Create an instance of Slim with custom view
* and set the configurations from config file
*/
$app = new Slim(array('view' => 'View','mode' => 'production'));

/**
* Require core file
* @return Array route values
*
*/
$routes = require 'config/core.php';

/**
* Require config file
* @return Array config values
*
*/
$segment = explode('/',$app->request()->getPathInfo());
// check for 'sub-blog'
if (!file_exists('config/'.$segment[1].'/config.php' ))
	$config = require 'config/config.php';
else
	$config = @require 'config/'.$segment[1].'/config.php';

/**
* Set app configurtion
*/
$app->config($config+$routes);

/**
* Create an object of Textpress and pass the object of Slim to it.
*/
$textpress = new Textpress($app);

/**
* Finally run Textpress
*/

$textpress->run();

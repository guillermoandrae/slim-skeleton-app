<?php
/**
 * @codingStandardsIgnoreFile
 */

// level out the I/O playing field
chdir(dirname(dirname(dirname(__FILE__))));

// pull in dependencies
require 'vendor/autoload.php';

// pull in environment configuration
require 'src/application/config/local.php';

// instantiate the app
$app = new \Slim\Slim(
    array(
        'debug' => false,
        'mode' => APPLICATION_ENV,
        'templates.path' => 'src/application/views',
    )
);

// configure the app
require 'src/application/config/application.php';

// run the app
$app->run();

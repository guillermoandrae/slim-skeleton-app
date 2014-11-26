<?php
/**
 * This file is part of the Releng Portal package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @codingStandardsIgnoreFile
 */

// date
date_default_timezone_set('America/New_York');

// level out the I/O playing field
chdir(dirname(dirname(dirname(__FILE__))));

// pull in dependencies
require 'vendor/autoload.php';

// pull in environment configuration
require 'src/application/config/env.php';

// instantiate the app
$app = new \Slim\Slim(
    array(
        'view' => new Releng\View\View(),
        'debug' => false,
        'mode' => APPLICATION_ENV,
        'templates.path' => 'src/application/views',
    )
);

// configure the app
require 'src/application/config/application.php';


// run the app
$app->run();

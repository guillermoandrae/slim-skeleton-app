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
chdir(dirname(dirname(__FILE__)));

// configure PHP by environment
error_reporting(-1);
ini_set('display_errors', true);
ini_set('display_startup_errors', true);

// pull in dependencies
require 'vendor/autoload.php';

// pull in environment settings
require 'src/application/config/env.php';


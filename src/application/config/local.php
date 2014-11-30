<?php

// define some environment constants
define('APPLICATION_ENV', getenv('APPLICATION_ENV') ?: 'production');
define('APPLICATION_PATH', getcwd());
define('APPLICATION_CACHE_PATH', APPLICATION_PATH . '/src/application/cache');

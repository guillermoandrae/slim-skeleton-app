<?php

namespace Slimish;

use Slim\Slim;
use There4\Slim\Test\WebTestCase;

class TestCase extends WebTestCase
{
    /**
     * @return \Slim\Slim
     */
    public function getSlimInstance()
    {
        $app = new Slim(array(
            'debug' => true,
            'mode' => 'testing',
            'templates.path' => APPLICATION_PATH . '/src/application/views'
        ));
        require APPLICATION_PATH . '/src/application/config/application.php';

        return $app;
    }
}

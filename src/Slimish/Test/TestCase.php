<?php
/**
 * This file is part of the RelEng package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace RelEng\Test;

use \Slim;

class TestCase extends \PHPUnit_Framework_TestCase
{

    /** @var array */
    private $testingMethods = ['get', 'post', 'patch', 'put', 'delete', 'head'];

    /** @var \Slim\Slim */
    private $app;

    /**
     * Run for each unit test to setup our Slim app environment.
     */
    public function setup()
    {
        $this->setApp();
    }

    /**
     * Allows us to make requests through Slim while testing.
     *
     * @param string $method
     * @param string $path
     * @param array $formVars
     * @param array $optionalHeaders
     * @return string
     */
    private function request($method, $path, $formVars = [], $optionalHeaders = [])
    {
        // start output buffering
        ob_start();

        // prepare a mock environment
        Slim\Environment::mock(array_merge(array(
                    'REQUEST_METHOD' => strtoupper($method),
                    'PATH_INFO'      => $path,
                    'SERVER_NAME'    => 'local.dev',
                    'slim.input'     => http_build_query($formVars)
                ), $optionalHeaders));

        // establish some useful references to the slim app properties
        $this->request  = $this->getApp()->request();
        $this->response = $this->getApp()->response();

        // execute our app
        $this->getApp()->run();

        // return the application output (also available in `response->body()`)
        return ob_get_clean();
    }

    /**
     * For implementing our testing method calls (get, post, etc.)
     *
     * @param string $method
     * @param array $arguments
     * @return string
     * @throws \BadMethodCallException
     */
    public function __call($method, $arguments)
    {
        if (in_array($method, $this->testingMethods)) {
            list($path, $formVars, $headers) = array_pad($arguments, 3, array());
            return $this->request($method, $path, $formVars, $headers);
        }
        throw new \BadMethodCallException(strtoupper($method) . ' is not supported');
    }

    /**
     * This method sets up a copy of the Slim app that will be used for testing purposes and registers it with this
     * class. If no app is passed to it, a version is set up using some default settings.
     *
     * @param \Slim\Slim|null $app
     */
    final public function setApp(Slim\Slim $app = null)
    {
        if (!$app) {
            $app = new Slim\Slim([
                'version' => '0.0.0',
                'mode' => 'testing',
            ]);
        }
        require_once dirname(dirname(__DIR__)) . '/config/config.php';
        $this->app = $app;
    }

    /**
     * @return \Slim\Slim
     */
    final public function getApp()
    {
        return $this->app;
    }
}

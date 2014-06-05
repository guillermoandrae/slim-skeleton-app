<?php
/**
 * This file is part of the RelEng package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RelEng\Application;

use \Slim;

class Bootstrap extends Slim\Middleware
{
    use ServiceLocatorAwareTrait;

    /** @var array */
    private $config;

    /**
     * @param $config
     */
    public function __construct($config)
    {
        $this->setConfig($config);
    }

    /**
     * @inheritDoc
     */
    public function call()
    {
        $this->setServiceLocator($this->getApplication()->serviceLocator);
        $this->configureApplication();
        $this->configureServiceLocator();
        $this->getNextMiddleware()->call();
    }

    /**
     * Adds custom configuration settings defined in the bootstrap configuration file.
     */
    public function configureApplication()
    {
        $config = $this->getConfig();
        foreach ($config['config'] as $key => $value) {
            $this->getApplication()->config($key, $value);
        }
    }

    /**
     * Registers services and their instantiation closures with the service locator.
     */
    public function configureServiceLocator()
    {
        $config = $this->getConfig();
        foreach ($config['services'] as $key => $value) {
            $this->getServiceLocator()->set($key, $value);
        }
    }

    /**
     * @param mixed $config
     */
    final public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * @return mixed
     */
    final public function getConfig()
    {
        return $this->config;
    }
}

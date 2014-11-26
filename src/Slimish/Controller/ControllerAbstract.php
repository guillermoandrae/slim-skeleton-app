<?php
/**
 * This file is part of the Slimish package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slimish\Controller;

use \Slim\Slim;
use \Slimish\Application\ApplicationAwareTrait;
use \Slimish\Application\ServiceLocatorAwareTrait;

abstract class ControllerAbstract implements ControllerInterface
{
    use ApplicationAwareTrait, ServiceLocatorAwareTrait;

    /** @var string */
    private $layout;

    /** @var string */
    private $partial;

    /**
     * Takes an instance of {@link \Slim\Slim} and registers it with the object and with the view.
     *
     * @param \Slim\Slim $app
     */
    final public function __construct(Slim $app)
    {
        $this->setApplication($app);
        $this->getApplication()->view()->setApplication($app);
        $this->setServiceLocator($app->serviceLocator);
    }

    /**
     * Executed after instantiation, this method will attempt to route the request to the appropriate controller
     * method. The arguments passed in the route definition are parsed when {@link ControllerAbstract::parse()} is
     * invoked in this method. A call to {@link ControllerAbstract::init()} precedes any method routing. In the case of
     * an exception, the {@link ControllerAbstract::error()} method is invoked.
     */
    final public function __invoke()
    {
        $this->parse(func_get_args());
        $this->init();
        try {
            $this->route();
        } catch (\Exception $ex) {
            $this->error($ex);
        }
        $this->render();
    }

    /**
     * Renders the view.
     */
    final public function render()
    {
        $layout = $this->getLayout();
        $partial = $this->getPartial();
        $this->getApplication()->render('layouts/' . $layout . '.phtml', ['partial' => $partial]);
    }

    /**
     * @param string $layout
     */
    final public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    /**
     * @return string
     */
    final public function getLayout()
    {
        return $this->layout;
    }

    /**
     * @param string $partial
     */
    final public function setPartial($partial)
    {
        $this->partial = $partial;
    }

    /**
     * @return string
     */
    final public function getPartial()
    {
        return $this->partial;
    }

    /**
     * @return string
     */
    final public function getControllerName()
    {
        return strtolower(str_replace('Application\Controller\\', '', get_class($this)));
    }

    /**
     * @see \Slim\Http\Request::params()
     * @return array|mixed|null
     */
    final public function getParams()
    {
        return $this->getApplication()->request()->params();
    }

    /**
     * @see \Slim\Http\Request::params()
     * @param $name
     * @return mixed
     */
    final public function getParam($name)
    {
        return $this->getApplication()->request()->params($name);
    }

    /**
     * @see \Slim\View::setData()
     * @param string|array $key
     * @param mixed $value
     */
    final public function setData($key, $value = null)
    {
        $data = is_string($key) ? [$key => $value] : $key;
        $this->getApplication()->view()->setData($data);
    }

    /**
     * @param $name
     * @return \Slimish\Entity\MapperInterface
     */
    final public function getMapper($name)
    {
        $serviceLocator = $this->getServiceLocator();
        $factory = $serviceLocator->get('\Slimish\Entity\MapperFactory');
        return $factory->get($name);
    }
}

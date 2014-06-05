<?php
/**
 * This file is part of the RelEng package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RelEng\Controller;

abstract class ActionControllerAbstract extends ControllerAbstract
{
    /** @var string */
    private $action;

    /** @var mixed */
    private $id;

    /**
     * Parses the action and ID passed on from the route and registers them with the object.
     *
     * @param array $args
     */
    final public function parse(array $args)
    {
        $action = isset($args[0]) ? $args[0] : 'index';
        $id = isset($args[1]) ? $args[1] : 'index';
        $this->setAction($action);
        $this->setId($id);
    }

    /**
     * Sets the default layout and default partial to be used.
     */
    public function init()
    {
        $this->setLayout('layout');
        $this->setPartial($this->getControllerName() . '/' . $this->getAction());
    }

    /**
     * Routes requests to the appropriate action method.
     *
     * @throws \BadMethodCallException
     */
    final public function route()
    {
        $action = $this->getAction();
        $actionMethod = $action . 'Action';
        if (!method_exists($this, $actionMethod)) {
            $message = sprintf('The %s action does not exist in the %s controller.', $action, get_class($this));
            throw new \BadMethodCallException($message, 404);
        }
        $this->$actionMethod();
    }

    /**
     * Invoked when an error occurs.
     */
    final public function error(\Exception $ex)
    {
        $this->setPartial('error/index');
    }

    /**
     * Default action method.
     */
    public function indexAction()
    {

    }

    /**
     * @param string $action
     */
    final public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @return string
     */
    final public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $id
     */
    final public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    final public function getId()
    {
        return $this->id;
    }
}

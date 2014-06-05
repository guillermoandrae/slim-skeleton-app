<?php
/**
 * This file is part of the RelEng package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RelEng\Controller;

class RestControllerAbstract extends ControllerAbstract
{
    /** @var mixed */
    private $id;

    /**
     * Registers the requested ID with the controller.
     *
     * @param array $args
     */
    public function parse(array $args)
    {
        $this->setId($args[0]);
    }

    /**
     * Sets headers for the response as well as the default layout.
     */
    public function init()
    {
        $this->getApplication()->response->headers->set('Content-Type', 'application/json');
        $this->setLayout('bare');
    }

    /**
     * Maps the HTTP method to the appropriate object method.
     *
     * @throws \BadMethodCallException
     */
    public function route()
    {
        $httpMethod = $this->getApplication()->request->getMethod();
        $serviceMethod = strtolower($httpMethod);
        if (!method_exists($this, $serviceMethod)) {
            $service = str_replace('Application\Controller\\', '', get_class($this));
            $message = sprintf('The \'%s\' HTTP method is not supported in the %s service.', $httpMethod, $service);
            throw new \BadMethodCallException($message, 405);
        }
        $this->$serviceMethod();
    }

    /**
     * Outputs an error message with the appropriate header.
     *
     * @param \Exception $ex
     */
    public function error(\Exception $ex)
    {
        $code = $ex->getCode() ?: 500;
        $this->getApplication()->response->setStatus($code);
        $this->getApplication()->response->setBody(json_encode(['error' => $ex->getMessage()]));
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}

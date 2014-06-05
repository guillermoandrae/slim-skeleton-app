<?php
/**
 * This file is part of the RelEng package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RelEng\Application;

use \Slim\Slim;

class ServiceLocator implements \ArrayAccess
{
    use ApplicationAwareTrait;

    /** @var array */
    private $services;

    /**
     * @param \Slim\Slim $app
     */
    public function __construct(Slim $app)
    {
        $this->setApplication($app);
    }

    /**
     * @param mixed $key
     * @param mixed $value
     */
    public function offsetSet($key, $value)
    {
        $this->set($key, $value);
    }

    /**
     * @param mixed $key
     */
    public function offsetUnset($key)
    {
        $this->remove($key);
    }

    /**
     * @param mixed $key
     * @return mixed
     */
    public function offsetGet($key)
    {
        return $this->get($key);
    }

    /**
     * @param $key
     * @return bool
     */
    public function offsetExists($key)
    {
        return $this->has($key);
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public function set($key, $value)
    {
        $this->services[$key] = $value;
    }

    /**
     * @param $key
     */
    public function remove($key)
    {
        unset($this->services[$key]);
    }

    /**
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        if ($this->has($key)) {
            $func = $this->services[$key];
            return $func($this->getApplication());
        }
    }

    /**
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return isset($this->services[$key]);
    }
}

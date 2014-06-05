<?php
/**
 * This file is part of the Slimish package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slimish\Entity;

use \Slimish\Application;

class MapperFactory
{
    use Application\ServiceLocatorAwareTrait;

    /**
     * @param \Slimish\Application\ServiceLocator $serviceLocator
     */
    public function __construct(Application\ServiceLocator $serviceLocator)
    {
        $this->setServiceLocator($serviceLocator);
    }

    /**
     * @param $name
     * @return \Slimish\Entity\MapperInterface
     */
    public function get($name)
    {
        $mapperClassName = sprintf('\Application\Model\%s\Mapper', ucwords($name));
        $adapter = $this->getAdapterByMapperName($name);
        $mapper = new $mapperClassName($adapter);
        $mapper->setServiceLocator($this->getServiceLocator());
        return $mapper;
    }

    /**
     * @param $name
     * @return \Slimish\Entity\MapperInterface
     */
    private function getAdapterByMapperName($name)
    {
        $serviceLocator = $this->getServiceLocator();
        $config = $serviceLocator->getApplication()->config('entity.mapperAdapters');
        $adapterName = $config['default'];
        if (isset($config[$name])) {
            $adapterName = $config[$name];
        }
        $adapter = $serviceLocator->get($adapterName);
        return $adapter;
    }
}

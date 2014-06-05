<?php
/**
 * This file is part of the RelEng package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RelEng\Entity;

use \RelEng\Application;

class MapperFactory
{
    use Application\ServiceLocatorAwareTrait;

    /**
     * @param \RelEng\Application\ServiceLocator $serviceLocator
     */
    public function __construct(Application\ServiceLocator $serviceLocator)
    {
        $this->setServiceLocator($serviceLocator);
    }

    /**
     * @param $name
     * @return \RelEng\Entity\MapperInterface
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
     * @return \RelEng\Entity\MapperInterface
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

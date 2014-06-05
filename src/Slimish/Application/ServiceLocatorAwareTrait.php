<?php
/**
 * This file is part of the Slimish package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slimish\Application;

trait ServiceLocatorAwareTrait
{
    /** @var \Slimish\Application\ServiceLocator */
    private $serviceLocator;

    /**
     * @param \Slimish\Application\ServiceLocator $serviceLocator
     */
    public function setServiceLocator(ServiceLocator $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * @return \Slimish\Application\ServiceLocator
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }
}

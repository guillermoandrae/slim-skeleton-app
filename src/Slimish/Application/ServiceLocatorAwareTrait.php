<?php
/**
 * This file is part of the RelEng package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RelEng\Application;

trait ServiceLocatorAwareTrait
{
    /** @var \RelEng\Application\ServiceLocator */
    private $serviceLocator;

    /**
     * @param \RelEng\Application\ServiceLocator $serviceLocator
     */
    public function setServiceLocator(ServiceLocator $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * @return \RelEng\Application\ServiceLocator
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }
}

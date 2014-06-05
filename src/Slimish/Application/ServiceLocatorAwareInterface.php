<?php
/**
 * This file is part of the Slimish package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slimish\Application;

interface ServiceLocatorAwareInterface
{
    public function setServiceLocator(ServiceLocator $serviceLocator);
    public function getServiceLocator();
}

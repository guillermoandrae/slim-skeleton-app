<?php
/**
 * This file is part of the Slimish package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slimish\Entity;

use \Slimish\Application\ServiceLocatorAwareInterface;

interface MapperInterface extends ServiceLocatorAwareInterface
{
    public function findOne();
    public function findAll();
    public function setAdapter(AdapterInterface $adapter);
    public function getAdapter();
}

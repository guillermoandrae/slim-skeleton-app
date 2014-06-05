<?php
/**
 * This file is part of the RelEng package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RelEng\Entity;

use \RelEng\Application\ServiceLocatorAwareInterface;

interface MapperInterface extends ServiceLocatorAwareInterface
{
    public function findOne();
    public function findAll();
    public function setAdapter(AdapterInterface $adapter);
    public function getAdapter();
}

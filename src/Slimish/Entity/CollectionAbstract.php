<?php
/**
 * This file is part of the Slimish package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slimish\Entity;

class CollectionAbstract extends \ArrayObject
{
    public function offsetSet($offset, $value)
    {
        if ($value instanceof EntityInterface) {
            $this->offsetSet($offset, $value);
        } else {
            throw new \Exception();
        }
    }
}

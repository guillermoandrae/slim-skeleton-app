<?php
/**
 * This file is part of the Releng Portal package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Releng\Entity;

interface EntityMapperFactoryInterface
{
    /**
     * @param string $name
     * @param mixed $options
     *
     * @return \Releng\Entity\EntityMapperInterface
     */
    public static function factory($name, $options = null);
}

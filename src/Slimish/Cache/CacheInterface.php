<?php
/**
 * This file is part of the RelEng package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RelEng\Cache;

interface CacheInterface
{
    public function get();
    public function set($value);
    public function exists();
    public function clear();
}

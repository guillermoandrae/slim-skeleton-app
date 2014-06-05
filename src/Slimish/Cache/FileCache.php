<?php
/**
 * This file is part of the RelEng package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RelEng\Cache;

class FileCache implements CacheInterface
{
    /** @var string */
    private $id;

    /** @var int */
    private $lifetime;

    /**
     * @param $id
     * @param int $lifetime
     */
    public function __construct($id, $lifetime = 3600000)
    {
        $this->id = $id;
        $this->lifetime = $lifetime;
    }

    /**
     * @param $value
     */
    public function set($value)
    {
        $value = serialize($value);
        file_put_contents($this->getPath(), $value);
    }

    /**
     * @return mixed
     */
    public function get()
    {
        if ($this->exists()) {
            return unserialize(file_get_contents($this->getPath()));
        }
    }

    /**
     * @return bool
     */
    public function exists()
    {
        $path = $this->getPath();
        if (!is_file($path)) {
            return false;
        }
        $age = mktime() - filemtime($path);
        return ($age < $this->getLifetime());
    }

    public function clear()
    {
        unlink($this->getPath());
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return RELENG_CACHE_PATH . '/' . $this->getId() . '.cache';
    }

    /**
     * @param int $lifetime
     */
    public function setLifetime($lifetime)
    {
        $this->lifetime = $lifetime;
    }

    /**
     * @return int
     */
    public function getLifetime()
    {
        return $this->lifetime;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}

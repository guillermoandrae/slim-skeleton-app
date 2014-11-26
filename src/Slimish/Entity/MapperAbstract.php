<?php
/**
 * This file is part of the Slimish package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slimish\Entity;

use \Slimish\Application;

abstract class MapperAbstract implements MapperInterface
{
    use Application\ServiceLocatorAwareTrait;

    /** @var \Slimish\Entity\AdapterInterface */
    private $adapter;

    /**
     * @param \Slimish\Entity\AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter)
    {
        $this->setAdapter($adapter);
    }

    /**
     * @return \Slimish\Entity\EntityInterface|null
     */
    public function findOne()
    {
        $collection = $this->findAll();
        if (isset($collection[0])) {
            return $collection[0];
        }
    }

    /**
     * @return \Slimish\Entity\CollectionInterface
     */
    abstract public function findAll();

    /**
     * @param \Slimish\Entity\AdapterInterface $adapter
     */
    final public function setAdapter(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @return \Slimish\Entity\AdapterInterface
     */
    final public function getAdapter()
    {
        return $this->adapter;
    }
}

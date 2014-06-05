<?php
/**
 * This file is part of the RelEng package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RelEng\Entity;

use \RelEng\Application;

abstract class MapperAbstract implements MapperInterface
{
    use Application\ServiceLocatorAwareTrait;

    /** @var \RelEng\Entity\AdapterInterface */
    private $adapter;

    /**
     * @param \RelEng\Entity\AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter)
    {
        $this->setAdapter($adapter);
    }

    /**
     * @return \RelEng\Entity\EntityInterface|null
     */
    public function findOne()
    {
        $collection = $this->findAll();
        if (isset($collection[0])) {
            return $collection[0];
        }
    }

    /**
     * @return \RelEng\Entity\CollectionInterface
     */
    abstract public function findAll();

    /**
     * @param \RelEng\Entity\AdapterInterface $adapter
     */
    final public function setAdapter(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @return \RelEng\Entity\AdapterInterface
     */
    final public function getAdapter()
    {
        return $this->adapter;
    }
}

<?php
/**
 * This file is part of the RelEng package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RelEng\Application;

use \Slim\Slim;

trait ApplicationAwareTrait
{
    /** @var \Slim\Slim */
    private $app;

    /**
     * Registers an instance of {@link \Slim\Slim} with this class.
     *
     * @param \Slim\Slim $app
     */
    final public function setApplication(Slim $app)
    {
        $this->app = $app;
    }

    /**
     * Returns the instance of {@link \Slim\Slim registered with this class.
     *
     * @return \Slim\Slim
     */
    final public function getApplication()
    {
        return $this->app;
    }
}

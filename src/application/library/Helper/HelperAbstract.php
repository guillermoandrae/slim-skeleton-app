<?php
/**
 * This file is part of the Releng Portal package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Releng\Helper;

use Slim\Slim;

abstract class HelperAbstract implements HelperInterface
{
    /** @var \Slim\Slim */
    protected $app;

    /**
     * @param \Slim\Slim $app
     */
    public function __construct(Slim $app)
    {
        $this->app = $app;
    }

    /**
     * @inheritdoc
     */
    public function getApp()
    {
        return $this->app;
    }
}

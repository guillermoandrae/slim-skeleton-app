<?php
/**
 * This file is part of the Releng Portal package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Releng\Helper;

interface HelperInterface
{
    /**
     * @return \Slim\Slim
     */
    public function getApp();
}

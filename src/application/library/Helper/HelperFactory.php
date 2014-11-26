<?php
/**
 * This file is part of the Releng Portal package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Releng\Helper;

use Slim\Slim;

class HelperFactory
{
    /**
     * @param string $name
     * @param Slim $app
     *
     * @return \Releng\Helper\HelperInterface|null
     */
    public static function factory($name, Slim $app)
    {
        $namespace = '\Releng\Helper';
        $className = sprintf('%s\%sHelper', $namespace, ucfirst($name));
        return new $className($app);
    }
}

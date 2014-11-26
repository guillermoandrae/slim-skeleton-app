<?php
/**
 * This file is part of the Releng Portal package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RelengTest\Helper;

use Releng\Helper\HelperFactory;
use RelengTest\TestCase;

class HelperFactoryTest extends TestCase
{
    /**
     * @dataProvider getHelperName
     * @param $name
     */
    public function testFactory($name)
    {
        $helper = HelperFactory::factory($name, $this->getSlimInstance());
        $this->assertInstanceOf('\Releng\Helper\HelperInterface', $helper);
    }

    public function getHelperName()
    {
        return array(
            array('route'),
            array('api'),
        );
    }
} 
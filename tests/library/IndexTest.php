<?php
/**
 * This file is part of the Releng Portal package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RelengTest;

class IndexTest extends TestCase
{
    public function testHome()
    {
        $this->getClient()->get('/');
        $this->assertEquals(200, $this->getClient()->response->status());
        $this->assertContains('Welcome', $this->getClient()->response->body());
    }
}

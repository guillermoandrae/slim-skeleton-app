<?php
/**
 * This file is part of the Releng Portal package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RelengTest;

use Releng\GitHub\ComAdapter;
use Releng\GitHub\EnterpriseAdapter;
use Releng\View\View as RelengView;
use Slim\Slim;
use There4\Slim\Test\WebTestCase;

class TestCase extends WebTestCase
{
    protected $comAdapter;
    protected $enterpriseAdapter;

    public function getSlimInstance()
    {
        $app = new Slim(array(
            'view' => new RelengView(),
            'debug' => true,
            'mode' => 'testing',
            'templates.path' => APPLICATION_PATH . '/src/application/views'
        ));

        // Include our core application file
        require APPLICATION_PATH . '/src/application/config/application.php';

        return $app;
    }

    public function getClient()
    {
        return $this->client;
    }

    protected function getComAdapter()
    {
        if (!$this->comAdapter) {
            $this->comAdapter = new ComAdapter(
                $this->getMockGitHubClient(),
                $this->getMockCache('githubcom')
            );
        }

        return $this->comAdapter;
    }

    protected function getEnterpriseAdapter()
    {
        if (!$this->enterpriseAdapter) {
            $this->enterpriseAdapter = new EnterpriseAdapter(
                $this->getMockGitHubClient(),
                $this->getMockCache('githubenterprise')
            );
        }

        return $this->enterpriseAdapter;
    }

    protected function getMockGitHubClient()
    {
        $httpClient = new GitHub\MockHttpClient(array('base_url' => 'http://github.local'));
        $client = new GitHub\MockClient($httpClient);

        return $client;
    }

    protected function getMockCache($dir)
    {
        //$cache = new FilesystemCache('/' . $dir);
        $cache = $this->getMock('\Releng\Cache\FilesystemCache', array('fetch', 'save'), array('/' . $dir));
        $cache->expects($this->any())
            ->method('fetch')
            ->will($this->returnValue(false));
        $cache->expects($this->any())
            ->method('save')
            ->will($this->returnValue(null));

        return $cache;
    }
}

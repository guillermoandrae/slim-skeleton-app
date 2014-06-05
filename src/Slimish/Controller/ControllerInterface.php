<?php
/**
 * This file is part of the RelEng package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RelEng\Controller;

use \Slim\Slim;
use \RelEng\Application\ServiceLocatorAwareInterface;

interface ControllerInterface extends ServiceLocatorAwareInterface
{
    public function __construct(Slim $app);
    public function __invoke();
    public function parse(array $args);
    public function init();
    public function route();
    public function error(\Exception $ex);
    public function render();
    public function getControllerName();
    public function getParam($name);
    public function getParams();
    public function setData($key, $value = null);
    public function getMapper($name);
}

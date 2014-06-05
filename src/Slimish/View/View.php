<?php
/**
 * This file is part of the Slimish package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slimish\View;

use \Slim;
use \Slimish\Application\ApplicationAwareTrait;

class View extends Slim\View
{
    use ApplicationAwareTrait;

    /**
     * @param string $data
     * @return string
     */
    public function translate($data)
    {
        return $data;
    }

    /**
     * @param string $partial
     * @return bool
     */
    public function partialExists($partial)
    {
        $path = $this->getApplication()->config('templates.path') . 'partials/' . $partial . '.phtml';
        return file_exists($path);
    }

    /**
     * @param string $partial
     */
    public function renderPartial($partial)
    {
        $this->getApplication()->render('partials/' . $partial . '.phtml');
    }

    /**
     * @param string $controllerName
     * @return bool
     */
    public function isActiveController($controllerName)
    {
        return ($controllerName == $this->getController()->getControllerName());
    }

    /**
     * @param string $actionName
     * @return bool
     */
    public function isActiveAction($actionName)
    {
        return ($actionName == $this->getController()->getAction());
    }

    /**
     * @return \Slimish\Controller\ControllerInterface
     */
    public function getController()
    {
        return $this->getApplication()->router()->getCurrentRoute()->getCallable();
    }
}

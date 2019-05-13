<?php

namespace Mapi\App;

/**
 * Class Dispatcher
 *
 * PHP version 7.2
 *
 * @category Core
 * @package  Mapi
 * @author   David Raleche <davidr@raleche.com>
 * @license  http://mapi.raleche.com/docs/swagger.json raleche
 * @link     https://ralecheinc.atlassian.net/wiki/spaces/TEC/pages/673513891/Framework+Architecture+Demo
 */
class Dispatcher
{
    /**
     * @var
     */
    private $request;

    /**
     * Dispatcher
     */
    public function dispatch()
    {
        $this->request = new Request();
        Router::parse($this->request->url, $this->request);
        $controller = $this->loadController();

        if (method_exists($controller, $this->request->action) === false) {
            echo "<h2>Endpoint (Method) does not exist</h2>";
            exit;
        }
        call_user_func_array([$controller, $this->request->action], $this->request->params);
    }

    /**
     * @return mixed
     */
    public function loadController()
    {
        $name = $this->request->controller."Controller";
        $file = ROOT.'src/'.$this->request->controller.'/controllers/'.$name.'.php';

        if (!file_exists($file)) {
            echo "<h2>Endpoint does not exist</h2>";
            exit;
        }

        require_once($file);


        $b = "Mapi\src\\".$this->request->controller."\\".ucfirst($name);
        return new $b($this->request);
    }
}

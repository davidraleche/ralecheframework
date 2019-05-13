<?php

namespace Mapi\App\Controllers;

/**
 * Abstract Controller Class
 *
 * PHP version 7.2
 *
 * @category Core
 * @package  Mapi
 * @author   David Raleche <davidr@raleche.com>
 * @license  http://mapi.raleche.com/docs/swagger.json raleche
 * @link     https://ralecheinc.atlassian.net/wiki/spaces/TEC/pages/673513891/Framework+Architecture+Demo
 */

class Controller
{
    public $vars = [];
    public $layout = "default";

    /**
     * Controller constructor.
     * @param array $vars
     */
    public function __construct(\Mapi\App\Request $request)
    {
        $this->request = $request;
    }


    /**
     * @param $d
     */
    public function set($d)
    {
        $this->vars = array_merge($this->vars, $d);
    }

    /**
     * @param $filename
     */
    public function render($filename)
    {
        extract($this->vars);
        ob_start();

        require(ROOT . "src/".$this->request->controller."/views/". $this->request->controller."/".$filename . '.php');

        $content_for_layout = ob_get_clean();
        if (!$this->layout) {
            $content_for_layout;
        } else {
            require(ROOT . "src/".$this->request->controller."/views/layouts/" . $this->layout . '.php');
        }
    }

    /**
     * @param $data
     * @return string
     */
    private function secureInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        return $data = htmlspecialchars($data);
    }

    /**
     * @param $form
     */
    public function secureForm($form)
    {
        foreach ($form as $key => $value) {
            $form[$key] = $this->secureInput($value);
        }
    }
}

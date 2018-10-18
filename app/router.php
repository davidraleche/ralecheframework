<?php

namespace Mapi\App;

/**
 * Class Router
 *
 * PHP version 7
 *
 * @category Core
 * @package  Mapi
 * @author   David Raleche <davidr@raleche.com>
 * @license  http://mapi.raleche.com/docs/swagger.json raleche
 * @link     https://ralecheinc.atlassian.net/wiki/spaces/TEC/pages/673513891/Framework+Architecture+Demo
 */
class Router
{
    /**
     * Parser function
     *
     * @param  mixed  $request The Parameter associated to the request.
     * @param  string $url     The url.
     *
     * @return void
     */
    public static function parse($url, $request)
    {
        $url = trim($url);

        if ($url == "/mapi/") {
            $request->controller = "tasks";
            $request->action = "index";
            $request->params = [];
        } else {
            $explode_url = explode('/', $url);
            $explode_url = array_slice($explode_url, 2);
            $request->controller = $explode_url[0];
            $request->action = $explode_url[1];
            $request->params = array_slice($explode_url, 2);
        }
    }
}

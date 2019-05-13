<?php

namespace Mapi\App;

/**
 * Class Request
 *
 * PHP version 7.2
 *
 * @category Core
 * @package  Mapi
 * @author   David Raleche <davidr@raleche.com>
 * @license  http://mapi.raleche.com/docs/swagger.json raleche
 * @link     https://ralecheinc.atlassian.net/wiki/spaces/TEC/pages/673513891/Framework+Architecture+Demo
 */
class Request
{
    /**
     *
     * @var url
     */
    public $url;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->url = $_SERVER["REQUEST_URI"];
    }
}

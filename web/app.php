<?php

/**
 * App starter
 *
 * PHP version 7.25
 *
 * @category Core
 * @package  Api
 * @author   David Raleche <davidr@raleche.com>
 * @license  http://mapi.raleche.com/docs/swagger.json raleche
 * @link     https://ralecheinc.atlassian.net/wiki/spaces/TEC/pages/673513891/Framework+Architecture+Demo
 *
 * @OA\Info(
 *     description="This is a sample API server.
       You can find out more about MAPI documentation at
      [General Doc page](https://ralecheinc.atlassian.net/wiki/spaces/TEC/pages/673513891/Framework+Architecture+Demo)
      and
      find [Developer Doc page](https://ralecheinc.atlassian.net/wiki/spaces/TEC/pages/682950678/Framework+Constitution)
      and [GitHub  page](https://git.raleche.com/raleche/prelude).",
 *     version="1.0.0",
 *     title="MAPI Magento dedicated API",
 *     termsOfService="http://swagger.io/terms/",
 * @OA\Contact(
 *         email="davidr@raleche.com"
 *     ),
 * )
 *
 *  * @OA\Server(
 *     description="David Sandbox",
 *     url="http://prelude.davidr.sbx.raleche.com/",
 * )
 *  *  * @OA\Server(
 *     description="Dev Environment",
 *     url="https://dev-mapi.raleche.com/",
 * )
 *
 * @OA\Tag(
 *     name="API demo",
 *     description="Everything about API demo",
 * @OA\ExternalDocumentation(
 *         description="Find out more",
 *         url="http://swagger.io"
 *     )
 * )
 * )
 * @OA\ExternalDocumentation(
 *     description="MAPI API",
 *     url="https://ralecheinc.atlassian.net/wiki/spaces/TEC/pages/673513891/Framework+Architecture+Demo"
 * )
 */

require_once '../config/constant.php';

require_once ROOT.'config/core.php';
require_once ROOT.'app/router.php';
require_once ROOT.'app/request.php';
require_once ROOT.'app/dispatcher.php';

$dispatch = new \Mapi\App\Dispatcher();
$dispatch->dispatch();

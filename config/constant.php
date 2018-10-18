<?php

define('WEBROOT', str_replace("app.php", "", $_SERVER["SCRIPT_NAME"]));
define('ROOT', str_replace("web/app.php", "", $_SERVER["SCRIPT_FILENAME"]));

<?php

namespace Log\Web;

use Yana\Authentication\QuickAuthentication;
use Yana\Logs\QuickLogs;

require_once __DIR__.'/../../vendor/autoload.php'; // Autoload files using Composer autoload

/**
 * Extend Logs
 *
 * @author David Raleche
 * @since  2019-13-05
 * Class QuickAuthentication - Dependency Injection
 * Class QuickLogs - parse errorLogs
 */



$authenticationInstance = new QuickAuthentication($usersAllowed);
$quickLogs = new QuickLogs($authenticationInstance);
$quickLogs->process();

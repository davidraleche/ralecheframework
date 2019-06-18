[![Build Status](https://img.shields.io/travis/zircote/swagger-php/master.svg?style=flat-square)](https://travis-ci.org/zircote/swagger-php)
[![License](https://img.shields.io/badge/license-Apache2.0-blue.svg?style=flat-square)](LICENSE-2.0.txt)

# Quick Logs

Parse quickly yout php errors and php warnings via a web browser.
if you are tired of 'tail -f' or 'cat error_log' QuickLogs is your solution 

## Features
- QuickLogs
![](http://david.raleche.com/wp-content/uploads/2019/06/quicklogs-1024x407.png)

- QuickAuthentication
![](http://david.raleche.com/wp-content/uploads/2019/06/quickauthentication-1024x448.png)


## Composer
```bash
composer require yana/dr
```

## How To use it in your web page
```bash
<?php

require_once __DIR__.'vendor/autoload.php';

$authenticationInstance = new \Yana\Authentication\QuickAuthentication();
$quickLogs = new \Yana\Logs\QuickLogs($authenticationInstance);
$quickLogs->process();
```

## Set Up PHP Error Log path in vendor/yana/dr/Yana/Logs/conf.php
```bash
<?php
    /**
     * Setup Error Log file
     *
     * @author    David Raleche
     * @link      david.raleche.com
     *
     * @since     2019-05-10
     **/

return [
    'error_log_path' => '/var/log/php-fpm/www-error.log',
    'error_log_path_backup' => __DIR__.'\demo\www-error.log'
];

```

## Default Credentials
```bash
username : admin
password : davidr
```


## Command Lines for PSR-2 Standard

```bash
./bin/phpcs -p --extensions=php --standard=PSR2 --error-severity=1 --warning-severity=0 ./src ./tests
```

## Contributing

Feel free to submit [Github Issues](https://github.com/davidraleche/ralecheframework) or pull requests.

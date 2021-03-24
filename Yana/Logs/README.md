[![Build Status](https://img.shields.io/travis/zircote/swagger-php/master.svg?style=flat-square)](https://travis-ci.org/zircote/swagger-php)
[![License](https://img.shields.io/badge/license-Apache2.0-blue.svg?style=flat-square)](LICENSE-2.0.txt)

# QuickLogs - Log Parser !  PHP Error Log Parser

Parse quickly (in 5 minutes) your php errors and php warnings via a web browser.
if you are tired of 'tail -f' or 'cat error_log' QuickLogs is your solution !

Windows server and Unix Server compatible - yay !

## Features
- QuickAuthentication

![](https://david.raleche.com/wp-content/uploads/2021/03/Screen-Shot-2021-03-23-at-11.44.19-AM-1024x580.png)

- QuickLogs Parser - Php Error Log

![](https://david.raleche.com/wp-content/uploads/2021/03/Screen-Shot-2021-03-23-at-9.48.38-AM-1200x1024.png)



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

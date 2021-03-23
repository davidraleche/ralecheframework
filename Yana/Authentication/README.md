[![Build Status](https://img.shields.io/travis/zircote/swagger-php/master.svg?style=flat-square)](https://travis-ci.org/zircote/swagger-php)
[![License](https://img.shields.io/badge/license-Apache2.0-blue.svg?style=flat-square)](LICENSE-2.0.txt)

# QuickAuth

Parse quickly (in 5 minutes) your php errors and php warnings via a web browser.
if you are tired of 'tail -f' or 'cat error_log' QuickLogs is your solution 

Windows server and Unix Server compatible - yay !

## Features

- QuickAuthentication

![](https://david.raleche.com/wp-content/uploads/2021/03/Screen-Shot-2021-03-23-at-11.44.19-AM-1024x580.png))


## Composer
```bash
composer require yana/dr
```

## How To use it in your web page
```bash
<?php

require_once __DIR__.'vendor/autoload.php';

$authenticationInstance = new \Yana\Authentication\QuickAuthentication();
$quickLogs->process();
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

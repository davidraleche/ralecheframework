[![Build Status](https://img.shields.io/travis/zircote/swagger-php/master.svg?style=flat-square)](https://travis-ci.org/zircote/swagger-php)
[![License](https://img.shields.io/badge/license-Apache2.0-blue.svg?style=flat-square)](LICENSE-2.0.txt)

# Quick Logs

Parse quickly yout php errors and php warnings via a web browser.
if you are tired of 'tail -f' or 'cat error_log' QuickLogs is your solution 

## Features
- QuickLogs
- QuickAuthentication



## Composer
```bash
composer require yana/dr
```

## How To use it
```bash
<?php

require_once __DIR__.'/../../vendor/autoload.php';

$authenticationInstance = new \Yana\Authentication\QuickAuthentication();
$quickLogs = new \Yana\Logs\QuickLogs($authenticationInstance);
$quickLogs->process();
```

## Command Lines for PSR-2 Standard

```bash
./bin/phpcs -p --extensions=php --standard=PSR2 --error-severity=1 --warning-severity=0 ./src ./tests
```

## Contributing

Feel free to submit [Github Issues](https://github.com/davidraleche/ralecheframework) or pull requests.

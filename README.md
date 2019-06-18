[![Build Status](https://img.shields.io/travis/zircote/swagger-php/master.svg?style=flat-square)](https://travis-ci.org/zircote/swagger-php)
[![License](https://img.shields.io/badge/license-Apache2.0-blue.svg?style=flat-square)](LICENSE-2.0.txt)

# Yana Framework - Raleche Community 

Quick PHP helper tool to undertake refactor code
https://github.com/davidraleche/ralecheframework

## Features
- QuickAPiRoute
- QuickLogs
- QuickAuthentication
- Easy swagger API documentation (Zircote)


## Contributing

Feel free to submit [Github Issues](https://github.com/davidraleche/ralecheframework) or pull requests.

## How To use
```bash
<?php

require_once __DIR__.'/../../vendor/autoload.php';

$authenticationInstance = new \Yana\Authentication\QuickAuthentication();
$quickLogs = new \Yana\Logs\QuickLogs($authenticationInstance);
$quickLogs->process();
```

## Command Lines

```bash
./bin/phpcs -p --extensions=php --standard=PSR2 --error-severity=1 --warning-severity=0 ./src ./tests
```

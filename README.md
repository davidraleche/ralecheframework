[![Build Status](https://img.shields.io/travis/zircote/swagger-php/master.svg?style=flat-square)](https://travis-ci.org/zircote/swagger-php)
[![License](https://img.shields.io/badge/license-Apache2.0-blue.svg?style=flat-square)](LICENSE-2.0.txt)

# MAPI documentation

Intent is to document th future API sustaining the raleche+ growth 

## Features
- Lightweight Api Route
- Easy swagger API documentation (Zircote)

## Usage

Add comment to your php files.
```php
/**
 * Abstract Controller Class
 *
 * PHP version 7.2
 *
 * @category Core
 * @package  Api
 * @author   David Raleche <davidr@raleche+.com>
 * @license  http://raleche.com/docs/swagger.json raleche
 * @link     https://ralecheinc.atlassian.net/wiki/spaces/TEC/pages/673513891/Framework+Architecture+Demo
 */
```


## More on MAPI API

- https://git.raleche.com/raleche/prelude
- [Swagger Example Documentation](https://github.com/zircote/swagger-php/tree/master/Examples)

## Contributing

Feel free to submit [Github Issues](https://git.raleche.com/raleche/prelude)
or pull requests.


Running only linting:

```bash
./bin/phpcs -p --extensions=php --standard=PSR2 --error-severity=1 --warning-severity=0 ./src ./tests
```

# Germania KG · PathServiceProvider

**[Pimple Service Provider](https://pimple.symfony.com/#extending-a-container) for working with directory path strings**


[![Build Status](https://travis-ci.org/GermaniaKG/PathServiceProvider.svg?branch=master)](https://travis-ci.org/GermaniaKG/PathServiceProvider)
[![Code Coverage](https://scrutinizer-ci.com/g/GermaniaKG/PathServiceProvider/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/PathServiceProvider/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/GermaniaKG/PathServiceProvider/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/PathServiceProvider/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/GermaniaKG/PathServiceProvider/badges/build.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/PathServiceProvider/build-status/master)


## Installation

```bash
$ composer require germania-kg/PathServiceProvider
```

## Setup

```php
<?php
use Germania\PathServiceProvider\PathServiceProvider;

// A. Use with Slim or Pimple
$app = new \Slim\App;
$dic = $app->getContainer();
$dic = new Pimple\Container;

// B. Register Service Provider.
$sp = new PathServiceProvider( [
	'var',
	'templates'	
]);

$dic->register( $sp  );
```

Using a custom prefixer callable. There's also a package for this, try [germania-kg/pathprefixer](https://github.com/GermaniaKG/PathPrefixer).

```php
// C. Pass optional callable
$sp = new PathServiceProvider( $paths, function( $path ) {
	return '/path/to/project/' . $path;
});
$dic->register( $sp  );
```

## Services

### Paths

Returns the paths array passed to constructor.

```php
$paths = $dic['Paths'];
// array(
// 	'var',
// 	'templates'	
// )
```


### Paths.Prefixer

Returns the prefixer callable

```php
$prefixer = $dic['Paths.Prefixer'];
```

### Paths.absolute

Returns the paths array with each element prefixed before:

```php
$absolute_paths = $dic['Paths.absolute'];
```


## Unit tests

Either copy `phpunit.xml.dist` to `phpunit.xml` and adapt to your needs, or leave as is. 
Run [PhpUnit](https://phpunit.de/) like this:

```bash
$ vendor/bin/phpunit
```


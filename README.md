# CodinGame PHP tests

A project to test your [CodinGame](https://www.codingame.com/) PHP code. It is not intended to have solutions.
It only contains PHPUnit tests to let you code in your favorite IDE, outside of the CodinGame web site.

[![License](https://img.shields.io/github/license/cyrilverloop/codingame-php-tests)](https://github.com/cyrilverloop/codingame-php-tests/blob/trunk/LICENSE)
[![PHP version](https://img.shields.io/badge/php-%3D8.4-%23777BB4?logo=php&style=flat)](https://www.php.net/)

**This project now uses PHP 8.5.
Unfortunaly, CodinGame is still on PHP 7.3
which is not [supported](https://www.php.net/supported-versions.php) anymore.
If you want to run your code on PHP 7.3,
you can use a version up to 3.x of this software which do not receive further update.**


## Installation

This project uses Git to download/update the project and Docker to run the code.
You can use this software without Git and Docker, but no support will be provided to that end.

Download the project :
```shellsession
user@host ~$ cd [PATH_WHERE_TO_PUT_THE_PROJECT] # E.g. ~/projects/
user@host projects$ git clone https://github.com/cyrilverloop/codingame-php-tests.git
user@host projects$ cd codingame-php-tests
```

Copy some configuration files for Docker and PHPUnit :
```shellsession
user@host projects$ cp ./ci/phpunit.dist.xml ./ci/phpunit.xml
user@host projects$ cp ./.env.dist ./.env
user@host projects$ cp ./.ashrc.dist ./.ashrc
user@host projects$ cp ./compose.override.yaml.dist ./compose.override.yaml
```
Edit the `./.env` to add your user to the container.
The `./ci/phpunit.xml`, `./.ashrc`, `./.env` and `./compose.override.yaml` files are ignored by git, you can modify them to your needs.
The `./.ashrc` and `./compose.override.yaml` add some aliases to your container.

Install the dependencies :
```shellsession
user@host codingame-php-tests$ docker compose run --rm app composer install -o
user@host codingame-php-tests$ docker compose run --rm app phive install --trust-gpg-keys 4AA394086372C20A,99BF4D9A33D65E1E,5E6DDE998AB73B8E,C5095986493B4AA0
```

Generate the code and test files :
```shellsession
user@host codingame-php-tests$ docker compose run --rm app bin/generate-tests
```

**Existing code, test, input and output files will not be overwritten.
To generate a file again, you must delete it first.**


## Add your code

Every classes in `./src/**/*CGCode.php` files have an `execute()` method with the default CodinGame code.
A test executes the `CGCode::execute()` method. You can add your code in and arround it.


## Test your solution

Launch a container and connect to it :
```shellsession
user@host codingame-php-tests$ docker compose run --rm app ash
```

Execute all the tests :
```shellsession
phpunit
```

Execute tests of a group :
```shellsession
phpunit --group [GROUP_NAME]
```

To view the list of test groups :
```shellsession
phpunit --list-groups
```

You can also execute tests from outside of the container :
```shellsession
user@host codingame-php-tests$ docker compose run --rm app ./tools/phpunit -c ./ci/phpunit.xml
```

Tip : to activate HTML coverage report and testdox logging, you can uncomment their configuration in `phpunit.xml`.


## Add your test (optional)

Every tests in `./tests/**/CGTest.php` files include the tests from CodinGame.
You can add your own tests and add them to a group with the `Group` attribute.


## Back to CodinGame

When you copy your code back to CodinGame, you must change every `$stdin` in `fscanf()`, `stream_get_line()`, ...
by `STDIN` :
```php
// In this project :
fscanf($stdin, "%d", $N);
```

```php
// On CodinGame :
fscanf(STDIN, "%d", $N);
```


## Time limit

The maximum time allowed may differ from CodinGame.

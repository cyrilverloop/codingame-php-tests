# CodinGame PHP tests

A project to test your [CodinGame](https://www.codingame.com/) PHP code. It is not intended to have solutions.
It only contains PHPUnit tests to let you code in your favorite IDE, outside of the CodinGame web site.

[![License](https://img.shields.io/github/license/cyrilverloop/codingame-php-tests)](https://github.com/cyrilverloop/codingame-php-tests/blob/trunk/LICENSE)
[![PHP version](https://img.shields.io/badge/php-%3D7.3-%23777BB4?logo=php&style=flat)](https://www.php.net/)


## Installation

Downloading the project :
```shellsession
user@host ~$ cd [PATH_WHERE_TO_PUT_THE_PROJECT] # E.g. ~/projects/
user@host projects$ git clone https://github.com/cyrilverloop/codingame-php-tests.git
user@host projects$ cd codingame-php-tests
```

Installing the dependencies :
```shellsession
user@host codingame-php-tests$ docker compose run --rm app composer install -o
user@host codingame-php-tests$ docker compose run --rm app phive install --trust-gpg-keys 4AA394086372C20A,12CE0F1D262429A5,31C7E470E2138192
```


## Add your code

Every classes in `./src/**/*.dist` files have an `execute()` method with the default CodinGame code.
To try a puzzle, copy the corresponding file and change the extension to `php` :
```shellsession
user@host codingame-php-tests$ cp ./src/Training/Easy/Unary/Unary.dist ./src/Training/Easy/Unary/Unary.php
```
Then, add your code to solve the puzzle.

**If you change the class name or do not have an `execute()` method in it, the tests will not be able to run.**


## Test your solution

Executing all the tests :
```shellsession
user@host codingame-php-tests$ docker compose run --rm app ./tools/phpunit -c ./ci/phpunit.dist.xml
```

Executing tests for a particular puzzle or a test case :
```shellsession
user@host codingame-php-tests$ docker compose run --rm app ./tools/phpunit -c ./ci/phpunit.dist.xml --group [GROUP_NAME]
```

To view the list of test groups :
```shellsession
user@host codingame-php-tests$ docker compose run --rm app ./tools/phpunit -c ./ci/phpunit.dist.xml --list-groups
```


## Add your test (optional)

Every tests in `./tests/**/CGTest.php` files include the tests from CodinGame.
You can add your own tests in other `./tests/**/*Test.php` files and add them to a group with the `@group` annotation.


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

The maximum time allowed for a puzzle may differ from CodinGame.

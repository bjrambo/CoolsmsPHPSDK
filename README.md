# Coolsms PHP SDK

Send Message & Alimtalk using PHP and REST API Ver 4.

## Installation

- The recommended way to install Coolsms PHP SDK is through composer:

  ```bash
  $ composer require bjrambo/coolsmsphpsdk
  ```

- Github : https://github.com/bjrambo/CoolsmsPHPSDK

## Requirements

* PHP 7.0 or greater
* Composer
* PHP CURL extension
* PHP JSON extension

# Coding Standards

### 1. Nameing Conventions and Style.

* Use Pascal casing for class.

```
class SimpleMessage
```

### 2. Use real tabs that are equal to 4 spaces

### 3. Always place an opening curly brace ({) in a new line

### 4. Add curly braces even if there's only one line in the scope.

```php
if ($bSomething)
{
    return;
}
```

### 5. Always have a default case for a switch statement.

```php
switch ($i)
{
    case 0:
        echo "i는 0";
        break;
    case 1:
        echo "i는 1";
        break;
    case 2:
        echo "i는 2";
        break;
    default:
        echo "i는 0, 1, 2 어느것도 아니다";
}
```
Details not specified here follows the [PSR-1](https://www.php-fig.org/psr/psr-1/) and [PSR-2](https://www.php-fig.org/psr/psr-2/).
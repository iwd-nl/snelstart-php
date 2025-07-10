# Snelstart B2B API

PHP client library to use the Snelstart B2B API.
[![Build Status](https://travis-ci.com/iwd-nl/snelstart-php.svg?branch=master)](https://travis-ci.com/iwd-nl/snelstart-php)

__Note that this library is not created, or maintained, by Snelstart.__

# Pre-word
This release will support both version 1 and version 2. Version 1 is considered deprecated, as Snelstart does not activly promote it anymore. Instructions on how to upgrade will be added when the next release takes place.

# Installation
Installation is easy as 1, 2, 3 thanks to Composer.
```bash
composer require iwd-nl/snelstart-php
```

# Usage
Create an account at [https://b2bapi-developer.snelstart.nl/] and subscribe to 'Verkenning'. Obtain the Primary and Secondary key from your Profile and generate a key on the web interface of Snelstart under 'Maatwerk'. You are going to need these credentials for the next chapter.

## Authentication
Now that you have obtained the credentials you can start by connection the library to the API.
```php
$primaryKey = "<primary>";
$secondaryKey = "<secondary>";
$clientKey = "<maatwerksleutel>";

$bearerToken = new \SnelstartPHP\Secure\BearerToken\ClientKeyBearerToken($clientKey);
$accessTokenConnection = new \SnelstartPHP\Secure\AccessTokenConnection($bearerToken);
$accessToken = $accessTokenConnection->getToken();

$connection = new \SnelstartPHP\Secure\V2Connector(
    new \SnelstartPHP\Secure\ApiSubscriptionKey($primaryKey, $secondaryKey),
    $accessToken
);
```

_Please note that there is also a class named `SnelstartPHP\Secure\CachedAccessTokenConnection` for when you are done with developing. This will automatically take care of renewing expired access tokens. _

### Check if you are really authenticated
We implemented the `EchoConnector` to test to see if you are authenticated.

## Fetch data
For an example see ``var/doc/v2/inkoopboeking_find_all.php``

## Add data
For an example see ``var/doc/v2/inkoopboeking_add.php``

## Supported resources
Not all resources are currently implemented. Feel free to create a pull request.

# PHPStan

PHPStan scans your whole codebase and looks for both obvious & tricky bugs. Even in those rarely executed if statements 
that certainly aren't covered by tests. You can run it on your machine and in CI to prevent those bugs ever reaching 
your customers in production. 

 - vendor/bin/phpstan analyse  

Within the phpstan.neon configuration file the level and the check folder are defined 

# Links
- [https://b2bapi-developer.snelstart.nl/]
## DEPRECATED: This library and the REST API v1 has been deprecated. More information at https://hs.smsglobal.com/services-update

SMSGlobal Class Library for PHP
===============================

This is a wrapper for the [SMSGlobal](http://www.smsglobal.com/) REST API. Get an API key from SMSGlobal by signing up and viewing the API key page in the MXT platform.

View the [REST API documentation](http://www.smsglobal.com/rest-api/) for a list of available resources.

Quick Start
-----------
This wrapper is requires PHP 5.3 or greater, and either the cURL library or the HTTP stream wrapper to be installed and enabled.

To install, add the dependency to your `composer.json` file:

```json
{
    "require": {
        "smsglobal/rest-api-client": "*"
    }
}
```

And install with Composer.

```bash
$ cd path/to/your/project
$ composer install --no-dev
```

Not using Composer?
-------------------
You can install the library by downloading it from Github. Just use a PSR-0 compliant autoloader to load in the classes.

To run unit tests or generate documentation, you'll need PHPUnit and phpDocumentor.

Running Unit Tests
------------------
```bash
$ cd path/to/SMSGlobal/rest/api/client
$ composer install
$ phpunit
```

Get documentation
-----------------
Documentation is available on [the SMSGlobal website](http://www.smsglobal.com/docs/rest-api-client-php/), or you can generate it yourself:

```bash
$ cd path/to/SMSGlobal/rest/api/client
$ composer install
$ vendor/phpdocumentor/phpdocumentor/bin/phpdoc.php -c phpdoc.xml
```

Using the library
-----------------
Running Unit Tests
```php
// Include the Composer autoloader or use your own PSR-0 autoloader
require 'vendor/autoload.php';

use Smsglobal\RestApiClient\ApiKey;
use Smsglobal\RestApiClient\Resource\Sms;
use Smsglobal\RestApiClient\RestApiClient;

// Get an API key from SMSGlobal and insert the key and secret
$apiKey = new ApiKey('your-api-key', 'your-api-secret');

// All requests are done via a 'REST API client.' This abstracts away the REST
// API so you can deal with it like you would an ORM
$rest = new RestApiClient($apiKey);

// Now you can get objects
$contact = $rest->get('contact', 1); // Contact resource with ID = 1
// Edit them
$contact->setMsisdn('61447100250');
// And save them
$rest->save($contact);
// Or delete them
$rest->delete($contact);

// You can also instantiate new resources
$sms = new Sms();
$sms->setDestination('61447100250')
    ->setOrigin('Test')
    ->setMessage('Hello World');
// And save them
$rest->save($sms);
// When a new object is saved, the ID gets populated (it was null before)
echo $sms->getId(); // integer

// For an SMS, saving also sends the message, so you can use a more meaningful
// keyword for it
$sms->send($rest);

// You can get a list of available resources
$list = $rest->getList('sms');

foreach ($list->objects as $resource) {
    // ...
}

// Pagination data is included
echo $list->meta->getTotalPages(); // integer

// Lists can be filtered
// e.g. contacts belonging to group ID 1
$rest->getList('contact', 0, 20, array('group' => 1));
```

Notes
-----
1. Requesting the same object twice in one session will return the same instance (even in the resource lists)
2. Exceptions are thrown if you attempt to save an object with invalid data

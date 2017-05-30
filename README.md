# Expedia API for Laravel 5

This is a simple Laravel Service Provider providing access to the <a href="http://developer.ean.com/">Expedia API</a>.

## Installation

Add the package in your composer.json by executing the command. 

~~~
composer require galiasay/laravel-expedia
~~~

Once Expedia API is installed you need to register the service provider with the application. Open up `app/config/app.php` and find the `providers` key:

~~~php
'providers' => [
    Galiasay\Expedia\ExpediaServiceProvider::class,
];
~~~
And add an alias:
~~~php
'aliases' => [
    'ExpediaApi' => \Galiasay\Expedia\Facades\ExpediaApi::class
];
~~~

## Configuration

Create configuration file and migration table using artisan:

~~~
$ php artisan vendor:publish
~~~

Execute the database migrations:

~~~
$ php artisan migrate
~~~

Then update config/expedia.php with your credentials. You can also update your .env file with the following:

~~~
EXPEDIA_CID = my_expedia_cid
EXPEDIA_API_KEY = my_expedia_api_key 
EXPEDIA_SECRET = my_expedia_secret
EXPEDIA_MINOR_REV = my_expedia_rev
~~~

## Artisan Commands


### Import database

~~~
$ php artisan expedia:import
~~~

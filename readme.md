# SHUTTLE BASE | Slim 3 Kickstart

This the reduced version of the [shuttle kickstart](https://github.com/telekommander/shuttle) project based on

* [akrabat/slim3-skeleton](https://github.com/akrabat/slim3-skeleton)
* [mrcoco/slim3-eloquent-skeleton](https://github.com/mrcoco/slim3-eloquent-skeleton)

Includes Twig, Flash Messages, Monolog and Swiftmailer and a simple routing.

## Features

----------

### Simple routing

Just write in your */core/route.php*:

    $app->get("/yourroute", "App\\Controller\\YourController:yourroute");

And add the depending function in */src/Controller/YourController.php*

	public function yourroute($request, $response, $params)
	{
	    // DO SOMETHING
	}

Your route looks like this:

    http://localhost/yourroute/

----------

### Create your project:

    $ composer create-project -n -s dev telekommander/shuttle-base yourapp

### ... or clone and run:

    $ composer install

### (Re)generate composer autoloader

    $ composer dump-autoload -o

#### Run it:

1. `$ cd yourapp`
2. Change database settings `config/config.json`
3. `$ php -S 0.0.0.0:8888 -t web web/index.php`
4. Browse to `http://localhost:8888` 
or
6. Browse to `http://localhost/yourapp/` without step 3 and 4 above

#### Sample routes

* `http://localhost/yourapp/public/`
* `http://localhost/yourapp/public/dashboard/`
* `http://localhost/yourapp/public/json/0815/`

#### Key directories

* `app`: Application code
* `app/src`: All class files within the `App` namespace
* `storage/cache`: Twig's autocreated cache files
* `storage/log`: Log files
* `public`: Webserver root
* `vendor`: Composer dependencies
* `web/views`: Twig template files
* `web/assets`: Frontend files

#### Key files

* `public/index.php`: Public entry point to application
* `app/config.json`: Configuration
* `app/core/dependencies.php`: Services
* `app/core/middleware.php`: Application middleware
* `app/core/routes.php`: All application routes are here
* `app/src/Action/HomeController.php`: Action class for the home page
* `web/views/home.twig`: Twig template file for the home page

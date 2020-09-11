**HR ooba.kg project based on Symfony 5.1**

Installation
========================

1. Clone or download repository


2. Run composer

    composer install
    
3. Change db password, user, name, host and port in ".env" file
    
    project/.env
    
4. You will be asked for some questions to setup yuor database and other settings.
Provide correct login and password for your database. Then update database scheme

    php bin/console d:s:u -f
    

5. (Optional)For develpment you can run fixture data. In other way you have to load data into your database.

    php bin/console d:f:l
    

Requirements
-----------------

 * [Composer][16]
 * MySQL Database
 
Usefull links
-----------------
 
  * [Setup web server for symfony project][1]

*Symfony Standard Edition
========================

**WARNING**: This distribution does not support Symfony 4. See the
[Installing & Setting up the Symfony Framework][15] page to find a replacement
that fits you best.

Welcome to the Symfony Standard Edition - a fully-functional Symfony
application that you can use as the skeleton for your new applications.

For details on how to download and get started with Symfony, see the
[Installation][1] chapter of the Symfony Documentation.

What's inside?
--------------

The Symfony Standard Edition is configured with the following defaults:

  * An AppBundle you can use to start coding;

  * Twig as the only configured template engine;

  * Doctrine ORM/DBAL;

  * Swiftmailer;

  * Annotations enabled for everything.

It comes pre-configured with the following bundles:

  * **FrameworkBundle** - The core Symfony framework bundle

  * [**SensioFrameworkExtraBundle**][6] - Adds several enhancements, including
    template and routing annotation capability

  * [**DoctrineBundle**][7] - Adds support for the Doctrine ORM

  * [**TwigBundle**][8] - Adds support for the Twig templating engine

  * [**SecurityBundle**][9] - Adds security by integrating Symfony's security
    component

  * [**SwiftmailerBundle**][10] - Adds support for Swiftmailer, a library for
    sending emails

  * [**MonologBundle**][11] - Adds support for Monolog, a logging library

  * **WebProfilerBundle** (in dev/test env) - Adds profiling functionality and
    the web debug toolbar

  * **SensioDistributionBundle** (in dev/test env) - Adds functionality for
    configuring and working with Symfony distributions

  * [**SensioGeneratorBundle**][13] (in dev env) - Adds code generation
    capabilities

  * [**WebServerBundle**][14] (in dev env) - Adds commands for running applications
    using the PHP built-in web server

  * **DebugBundle** (in dev/test env) - Adds Debug and VarDumper component
    integration

All libraries and bundles included in the Symfony Standard Edition are
released under the MIT or BSD license.

Enjoy!

[1]:  https://symfony.com/doc/current/setup.html
[6]:  https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/index.html
[7]:  https://symfony.com/doc/current/doctrine.html
[8]:  https://symfony.com/doc/current/templating.html
[9]:  https://symfony.com/doc/current/security.html
[10]: https://symfony.com/doc/current/email.html
[11]: https://symfony.com/doc/current/logging.html
[13]: https://symfony.com/doc/current/bundles/SensioGeneratorBundle/index.html
[14]: https://symfony.com/doc/current/setup/built_in_web_server.html
[15]: https://symfony.com/doc/current/setup.html
[16]: https://getcomposer.org/download/
[17]: https://symfony.com/doc/current/setup/web_server_configuration.html#nginx
[18]: https://symfony.com/doc/current/setup/file_permissions.html

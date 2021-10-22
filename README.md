<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Advanced Project Template</h1>
    <br>
</p>

Yii 2 Advanced Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
developing complex Web applications with multiple tiers.

The template includes three tiers: front end, back end, and console, each of which
is a separate Yii application.

The template is designed to work in a team development environment. It supports
deploying the application in different environments.

Documentation is at [docs/guide/README.md](docs/guide/README.md).

[![Latest Stable Version](https://img.shields.io/packagist/v/yiisoft/yii2-app-advanced.svg)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Total Downloads](https://img.shields.io/packagist/dt/yiisoft/yii2-app-advanced.svg)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![build](https://github.com/yiisoft/yii2-app-advanced/workflows/build/badge.svg)](https://github.com/yiisoft/yii2-app-advanced/actions?query=workflow%3Abuild)

DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```


INSTALLATION INSTRUCTIONS
-------------------------

1) create directory in your server under root html or htdocs 
2) checkout or copy package into html or htdocs directory
3) install composer following instructions https://getcomposer.org/download/ composer version 2.0
4) open command line and execute command "composer install"
5) create MySql database "yii2appDb"
  5.1) edit your application config located "/app/environments/dev/common/config/main-local.php". Replace your MySql user and password, and host if needed
6) then open command line and execute command "init" in root directory of the app
  a) choose "development" as environment
  b) accept to overwrite all configs
7) be sure that server configuration has mod_rewrite installed and enabled
8) if you work on local host you should create new virtual host
  a) Windows edit hosts C:\Windows\System32\drivers\etc file and add row "127.0.0.1 app.localhost"
  b) On apache config C:\Apache24\conf\extra\httpd-vhosts.conf add host configuration

  ```
  <VirtualHost *:80>
    RewriteEngine On
    ServerAdmin admin@app.co
    DocumentRoot "c:/Apache24/htdocs/app"
    ServerName app.localhost
    ServerAlias app.localhost
    ErrorLog "C:/Apache24/htdocs/logs/app-error.log"
    CustomLog "C:/Apache24/logs/app-access.log" common
  </VirtualHost>
  ```
  d) Restart apache and open http://app.localhost on your host

9) once its done open http://app.localhost. Right after that, open http://app.localhost/requirements.php and check that all requirements for the framework proper work are full filled
10) go to root catalog, open .htaccess and remove all the commented blocks under "&lt;IfModule mod_rewrite.c &gt;" section
11) then open command prompt and execute command "php yii migrate", and choose "Yes".
12) Your App is ready.


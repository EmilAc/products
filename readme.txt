-----Products App------

This app was created in Linux Ubuntu 18.04 (VirtualBox) using Symfony 5.1.2 framework.

The following steps are provided for creating an environment for using this app:

- in root - sudo apt update, sudo apt upgrade, sudo apt autoremove, sudo apt autoclean
- install composer (if needed)
- go to path cd /var/www/html/
- install symfony - composer create-project symfony/website-skeleton project_name
- go to path cd /var/www/html/project_name/
- check doctrine version - doctrine -V (install doctrine if needed)
- set up .env file wth APP_DOMAIN=.. APP_BASE_URL=.. DATABASE_URL=.. and doctrine.yaml file
- create new user with all premisions for new database
- import products_db.sql database
- check for node.js version - nodejs -v (install it if needed) 
- install encore and webpack - composer require symfony/webpack-encore-bundle and yarn install
- check for webpack.encore.webif exists and yarn.lock and package.json if share same webpack-encore version
* node_modules is like vendor folder for php
- install bootstrap using yarn package manager - yarn add bootstrap --dev
- if needed install holderjs library - yarn add holderjs
- install popperjs library - yarn add popper.js
- install jquery - yarn add jquery 
- fix webpack.config.js file for new libraries
- run encore to compile bundle of js and css files - ./node_modules/.bin/encore dev, if needed run - yarn add webpack-notifier@^1.6.0 --dev before.
*this needs to be done every time when making changes in webpack.config.js file

in console: cd /var/www/html/project_name/ run:
- ./node_modules/.bin/encore dev - buld front
- php bin/console cache:clear - cache clear 

for uploading data in database:
in - /var/www/html/products/
run - php public/sqlScript.php


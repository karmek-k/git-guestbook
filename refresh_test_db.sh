#!/bin/bash

APP_ENV=test

php bin/console doctrine:database:drop --force --env $APP_ENV
php bin/console doctrine:database:create --env $APP_ENV
php bin/console doctrine:migrations:migrate -n --env $APP_ENV
php bin/console doctrine:fixtures:load -n --env $APP_ENV

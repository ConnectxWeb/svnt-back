#!/bin/bash
echo "################################"
echo "# composer install"
echo "################################"
composer install

echo "################################"
echo "# doctrine schema update"
echo "################################"
php bin/console doctrine:schema:update --force

echo "################################"
echo "# clear cache"
echo "################################"
php bin/console cache:clear --env=prod
php bin/console cache:clear --env=dev

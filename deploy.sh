#!/bin/bash
echo "##########################################################################"
echo "# deploy PROD                                                            #"
echo "##########################################################################"

#git checkout public/index_dev.php
#git pull

echo "Cleaning cache and logs"
rm -rf var/cache/* var/logs/*

echo "Composer install + clear cache"
php composer.phar install --no-interaction --optimize-autoloader
php bin/console cache:clear --no-warmup
php bin/console cache:warmup

echo "Clear doctrine cache"
php bin/console doctrine:cache:clear-result
php bin/console doctrine:cache:clear-query
php bin/console doctrine:cache:clear-metadata
echo "Migrate doctrine"
#php bin/console doctrine:migrations:diff
#php bin/console doctrine:migrations:generate
#php bin/console doctrine:migrations:migrate --no-interaction
php bin/console doctrine:schema:update --complete --force

chmod -R 777 var/*

echo -e " --> DONE\n"

#!/bin/bash
echo "##########################################################################"
echo "# deploy PROD                                                            #"
echo "##########################################################################"

#git checkout public/index_dev.php
#git pull

echo "Delete .env.local & .env.test if existing"
rm -f .env.local
rm -f .env.test

echo "Backup DB"
mysqldump --no-tablespaces --host=svntfrkroot.mysql.db --user=svntfrkroot --port=3306 --password=ds654fds54fhgj789A svntfrkroot >./_backup/db/backup_$(date +%Y-%m-%d-%H.%M.%S).sql

echo "Cleaning cache and logs"
rm -rf var/cache/* var/logs/*

echo "Composer install + clear cache"
php composer.phar install --no-dev --no-interaction --optimize-autoloader
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

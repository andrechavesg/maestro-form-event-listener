git pull origin master
composer install
php bin/console doctrine:migration:migrate
php bin/console cache:clear
php bin/console cache:clear --env=prod
php bin/console cache:warmup
php bin/console cache:warmup --env=prod

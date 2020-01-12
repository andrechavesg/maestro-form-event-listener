docker exec -w /home/wwwroot php composer install
docker exec php php /home/wwwroot/bin/console doctrine:migration:migrate
docker exec php php /home/wwwroot/bin/console cache:clear
docker exec php php /home/wwwroot/bin/console cache:clear --env=prod
docker exec php php /home/wwwroot/bin/console cache:warmup
docker exec php php /home/wwwroot/bin/console cache:warmup --env=prod
docker exec -w /home/wwwroot php chmod 777 -R var/
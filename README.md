# laravel-queue

To execute in local:

1. run `cp .env.example .env`
2. set DB environment
3. install composer
4. install dependencies `make install-dependencies or composer install`
5. run migration with `make migrate-local or php artisan migrate`
6. start serve with `star-server-local or php artisan server`
7. import JWT-collection.json in postman

To execute in docker:
1. run `cp .env.example .env`
2. set DB environment
3. run `run-docker or docker-compose up -d --build`
4. run migration with `migrate-docker or docker-compose exec api-lara php artisan migrate`
5. import JWT-collection.json in postman

# To get info queue:

To execute in local:
1. run `start-queue-local or php artisan queue:work --queue=queue1,queue2`

To execute in docker:
1. run `start-queue-docker or docker-compose exec api-lara php artisan queue:work --queue=queue1,queue2`

To update all classes run `docker-compose exec api-lara composer dump-autoload`

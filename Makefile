#To execute in local
install-dependencies:
	composer install

migrate-local:
	php artisan migrate

drop-local:
	php artisan migrate:rollback

start-server-local:
	php artisan server

start-queue-local:
	php artisan queue:work --queue=queue1,queue2

#To execute in docker
run-docker:
	docker-compose up -d --build

migrate-docker:
	docker-compose exec api-lara php artisan migrate

drop-docker:
	docker-compose exec api-lara php artisan migrate:rollback

start-queue-docker:
	docker-compose exec api-lara php artisan queue:work --queue=queue1,queue2

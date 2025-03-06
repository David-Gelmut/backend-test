init-build: init migrate seed
init-build-run: init migrate seed run
init:
	composer install
	npm install
run:
	npm run dev
run-up: up
	sudo npm run dev
up:
	docker-compose up -d
up-build:
	docker-compose up -d --build
down:
	docker-compose down
migrate:
	docker-compose exec app php artisan migrate
rollback:
	docker-compose exec app php artisan migrate:rollback
migrate-fresh:
	docker-compose exec app php artisan migrate:fresh
seed:
	docker-compose exec app php artisan db:seed
fresh-seed:
	docker-compose exec app php artisan migrate:fresh --seed

#Linux superuser commands
init-build-s: init-s migrate-s seed-s
init-build-run-s: init-s migrate-s seed-s run-s
init-s:
	composer install
	sudo npm install
run-s:
	sudo npm run dev
run-up-s: up-s
	sudo npm run dev
up-s:
	sudo docker-compose up -d
up-build-s:
	sudo docker-compose up -d --build
down-s:
	sudo docker-compose down
migrate-s:
	sudo docker-compose exec app php artisan migrate
rollback-s:
	sudo docker-compose exec app php artisan migrate:rollback
migrate-fresh-s:
	sudo docker-compose exec app php artisan migrate:fresh
seed-s:
	sudo docker-compose exec app php artisan db:seed
fresh-seed-s:
	sudo docker-compose exec app php artisan migrate:fresh --seed

init:
	docker-compose build
	rm -rf nextjs/node_modules
	docker-compose run --rm nextjs npm install
	rm -rf laravel/vendor
	docker-compose run --rm laravel composer install
	@make up

up:
	docker-compose up -d

down:
	docker-compose down

test:
	docker-compose run --rm laravel php artisan test --stop-on-failure

npm-install:
	docker-compose exec nextjs npm ci

npm-reinstall:
	rm -rf nextjs/node_modules
	@make npm-install
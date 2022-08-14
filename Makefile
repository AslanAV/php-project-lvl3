start:
	make artisan serve --host 0.0.0.0

start-frontend:
	npm run dev

setup:
	./vendor/bin/sail up -d
	composer install
	cp -n .env.example .env
	./vendor/bin/sail artisan key:gen --ansi
	touch database/database.sqlite
	./vendor/bin/sail artisan migrate
	./vendor/bin/sail artisan db:seed
#	npm ci
#	npm run build
	make ide-helper

watch:
	npm run watch

migrate:
	./vendor/bin/sail artisan migrate

console:
	./vendor/bin/sail artisan tinker

log:
	tail -f storage/logs/laravel.log

test:
	./vendor/bin/sail artisan test

test-coverage:
	XDEBUG_MODE=coverage ./vendor/bin/sail artisan test --coverage-clover build/logs/clover.xml

deploy:
	git push heroku

lint:
	composer exec --verbose phpcs -- --standard=PSR12 app routes tests

lint-fix:
	composer exec --verbose phpcbf -- --standard=PSR12 app routes tests

compose:
	docker-compose up

compose-test:
	docker-compose run web make test

compose-bash:
	docker-compose run web bash

compose-setup: compose-build
	docker-compose run web make setup

compose-build:
	docker-compose build

compose-db:
	docker-compose exec db psql -U postgres

compose-down:
	docker-compose down -v

ide-helper:
	./vendor/bin/sail artisan ide-helper:eloquent
	./vendor/bin/sail artisan ide-helper:gen
	./vendor/bin/sail artisan ide-helper:meta
	./vendor/bin/sail artisan ide-helper:mod -n
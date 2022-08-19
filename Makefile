start:
	php artisan serve --host 0.0.0.0

setup:
	composer install
	cp -n .env.example .env|| true
	php artisan key:gen --ansi
	touch database/database.sqlite
	php artisan migrate
	php artisan db:seed
	make ci

watch:
	npm run watch

migrate:
	php artisan migrate

console:
	php artisan tinker

log:
	tail -f storage/logs/laravel.log

test:
	php artisan test

deploy:
	git push heroku

lint:
	composer phpcs

lint-fix:
	composer phpcbf

test-coverage:
	composer exec --verbose phpunit tests -- --coverage-clover build/logs/clover.xml

install:
	composer install

validate:
	composer validate

ci:
	npm ci

build-front:
	npm run build

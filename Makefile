start:
	php artisan serve
setup:
	composer install
	cp -n .env.example .env|| true
	php artisan key:gen --ansi
	touch database/database.sqlite
	php artisan migrate
	php artisan db:seed
	npm install
watch:
	npm run watch
validate:
	composer validate
migrate:
	php artisan migrate
console:
	php artisan tinker
test:
	php artisan test
deploy:
	git push heroku
lint:
	composer run-script phpcs -- --standard=PSR12 routes tests
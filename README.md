## Local dev environment

Please read this guide for Laravel requirements: https://laravel.com/docs/5.6/installation

Navigate to the laravel project directory and run: 

	composer install

Next install node modules:

	npm install

Environment:

	cp .env.example .env
	php artisan key:generate

 * Make sure to configure your local .env file accordingly, such as your DB connection.

Run migrations (/database/migrations):

	php artisan migrate

Run seeders if you want fake data for testing (/database/seeds):

	php artisan db:seed

If you don't have composer installed on your mac, run:

	curl -sS https://getcomposer.org/installer | php
	mv composer.phar /usr/local/bin/composer

If you don't have node installed on your mac, see here:

https://treehouse.github.io/installation-guides/mac/node-mac.html

Serve locally by running:

	php artisan serve

Recommended local web server: https://laravel.com/docs/5.6/valet
	
	cd <project directory>
	valet park
	valet link
	valet domain test

Go to: http://project-name.test
## Local dev environment

Navigate to the laravel project directory and run: 

	composer install

Next install node modules:

	npm install

Last step (local .env file):

	cp .env.example .env
	php artisan key:generate

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
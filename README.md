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

Start your server with the public directory as your document root. If you are using the built in PHP server you can navigate to public and run ( I prefer to use Valet https://laravel.com/docs/5.6/valet ):
	
	php -S localhost:8000
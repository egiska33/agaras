
# Installation

* Upload the files to the server & setup everything for a standard web app
* Make sure that BZ2 PHP extension is installed and enabled
* Run ```composer install``` in the project directory
* Run ```php artisan migrate``` in the project directory
* Run ```php artisan db:seed``` in the project directory
* Make sure storage and bootstrap/cache has the required permissions
* Make sure storage and public/uploads has the required permissions
* Create an .env file from the .env.example and populate it with data

# Requirements

* PHP 7
* BZ2 PHP extension

# Usage

By default database seeder creates super admin model with these credentials:

* Username: admin@agaras.lt
* Password: agaras456

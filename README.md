# The Night Owl

The Night Owl is a Laravel application to a fictional Bookstore. It was made with the aim of fixing studied content.

----------

# Getting started

## Installation

The Night Owl was made using Laravel Sail with the framework in version 10 and the Laravel Breeze Inertia to the Auth. In addition, the MySql database was used on port 3306 and Redis on the por 6379, to the Front-end was used Vue 3 with the composition API.

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/10.x/installation)

```
git@github.com:RicardoCSM/bookstore_project.git
cd bookstore_project
```

## Usage

Install [Docker](https://www.docker.com/) on your system.

* [Install instructions](https://docs.docker.com/installation/mac/) for Mac OS X
* [Install instructions](https://docs.docker.com/installation/ubuntulinux/) for Ubuntu Linux
* [Install instructions](https://docs.docker.com/installation/) for other platforms

Access the Lavel Sail documentation [Laravel Sail](https://laravel.com/docs/10.x/sail).

To start the containers

```bash
./vendor/bin/sail up -d
```

If you are running the application for the first time you should
run the migrations

```bash
./vendor/bin/sail php artisan migrate # run migrations
```

If you prefer, run the migrations seeding the database, this way, in addition to facilitating the understanding of the project, you will have access to the admin dashboard

```bash
./vendor/bin/sail php artisan migrate --seed # run migrations seeding the database
```

```bash
email: admin@admin.com #admin login informations
password: admin0123
```

The application can be accessed at [http://localhost](http://localhost).

## Contributing

Pull requests are welcome. For major changes, please open an issue first
to discuss what you would like to change.

Please make sure to update tests as appropriate.

# Code overview

## Folders

- `app/Models` - Contains all the Eloquent models
- `app/Http/Controllers` - Contains all the controllers
- `app/Http/Middleware` - Contains the auth middleware
- `app/Http/Requests/Api` - Contains the api custom requests
- `app/Repositories` - Contains the filter repositorie
- `database/migrations` - Contains all the database migrations
- `database/seeders` / `database/factories` - Contains all the seeders and factories to feed the database
- `routes` - Contains all the routes defined in web.php and in api.php file
- `public/js` - Contains all the Front-End pages, components, interfaces, layouts and utils.
- `storage/app/public/images` - Contains all the book images

## Environment variables

- `.env` - Environment variables can be set in this file

***Note*** : You can quickly set the database information and other variables in this file and have the application fully working.
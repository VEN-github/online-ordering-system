# Online Ordering System with Inventory Management for Furniture Company

Capstone Project.

## Tech Stack

**Client:** Vue 3, Vue Router, Pinia, TailwindCSS

**Server:** Laravel 10

## Installation

### Prerequisite

- [PHP](https://www.php.net/) _at least version 8.2.3_
- [MySQL](https://www.mysql.com/) _at least version 8.0.3_
- [Composer](https://getcomposer.org/) _at least version 2.4.2_
- [Node.JS](https://nodejs.org/en/) _at least version 18.12.1_
- [Laragon](https://laragon.org/)

## Run Locally

Clone the project

```bash
  git clone https://github.com/VEN-github/online-ordering-system.git
```

Go to the project directory

```bash
  cd online-ordering-system
```

Copy the `.env.example` and named it `.env`.

> This contains the environment variables such as **application name**, **database connection**, and **url**.

```terminal
  cp .env.example .env
```

Create database.

> You may create the database by any method that you prefer.
> You can use `http://localhost/phpmyadmin` to create your database.

Install composer packages.

```terminal
  composer install
```

Install dependencies

```bash
  npm install
```

Generate application key.

```terminal
  php artisan key:generate
```

Create a symbolic link to access storage static files from public.

```terminal
  php artisan storage:link
```

Migrate `database/migrations` files and run `database/seeders` as well.

```terminal
  php artisan migrate --seed
```

Start the server

```bash
  npm run dev
```

## Routes

To access the admin panel, you must go to the admin subdomain `localhost:8000/admin`. This will redirect to login page if you have not started any session yet. Here is the admin credentials provided by the seeder:

**Email:** admin@admin.com\
**Password:** admin

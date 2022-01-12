## About Lukas Blog

This is a simple webpage that allows users to read and comment (if they're registered) on the posts they deem interesting. Application has an admin panel, that allows users of that role to CRUD (Create, Read, Update, Delete) blogposts.  Webpage has a newsletter functionality and gives users chance to subscribe and get updates. 


#
### Table of Contents

- [Prerequisites](#prerequisites)
- [Techstack](#tech-stack)
- [Getting Started](#getting-started)
- [Migrations](#migrations)
- [Development](#development)
- [DrawSQL Database Diagram](#drawsql-database-diagram)

#
### Prerequisites

- PHP@8.0 and up
- NMP@8.0 and up
- Composer@2.1.9 and up

#
### Tech Stack

- [Laravel@8.x](https://laravel.com/docs/8.x)

#
### Getting Started

1\. First step is to clone this repository from github:
```sh
git clone https://github.com/RedberryInternship/lukachochua-laravel-8-from-scratch.git
```

2\. Install composer through terminal
```sh
composer install
```

3\. Install JS dependencies via NPM 
```sh
npm install
```
and run
```sh
npm run dev
```

4\. Configure project env. file. In terminal run:
```sh
cp .env.example .env
```
and provide .env file with required environment variables:

#
**MYSQL:**
>DB_CONNECTION=mysql

>DB_HOST=127.0.0.1

>DB_PORT=3306

>DB_DATABASE=*****

>DB_USERNAME=*****

>DB_PASSWORD=*****


When finished setting up env. file, execute
```sh
php artisan config:cache
```

5\. Run 
```sh
  php artisan key:generate
```
To generate Auth key

Now you're good to go.

#
### Migrations

If you followed the steps in getting started section, migrations are fairly simple. You only need to execute:
```sh
php artisan:migrate
```

If needed, populate databases with faker data using a seeder:
```sh
php artisan migrate:fresh -seed
```

#
### Development

Run Laravel's built-in development server by executing:

```sh
  php artisan serve
```

Link storage to public in order to display images
```sh
  php artisan storage:link
```

To get access to the admin functionality open project file AppServiceProvider.php and change `username` to the intended one.

#
## DrawSQL Database Diagram

[DrawSQL Diagram](https://drawsql.app/redberry-13/diagrams/laravel-from-scratch)

![DB-DIAGRAM](https://github.com/RedberryInternship/lukachochua-laravel-8-from-scratch/blob/main/drawSQL.png)




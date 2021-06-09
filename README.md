# GitGuestbook [![Test with PHPUnit](https://github.com/karmek-k/git-guestbook/actions/workflows/test.yml/badge.svg?branch=master)](https://github.com/karmek-k/git-guestbook/actions/workflows/test.yml)

Modern guestbooks for GitHub.

Work in progress!

## Installation

GitGuestbook requires PHP 8 or greater.
You'll also need Composer, Node.js with Yarn and a database (I used PostgreSQL).


1. Install dependencies

`composer install`

2. Either create a `.env.local` file from `.env` template:

`cp .env .env.local`

or provide the environment variables manually.

**PLEASE** make sure that the `APP_ENV` variable
is set to either `dev` or `prod`!
Deploying on the `dev` environment poses a major security risk!

3. Create the database and apply migrations:

```
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

4. Install Node.js dependencies and build static assets:

```bash
yarn install

# for development
yarn watch

# for production
yarn build
```

5. Now you can run the built-in PHP web server

`php -S localhost:8000 -t public`

or use a specialized one, such as nginx or Apache.
Make sure that you point it at the `public/` catalog!

## Tests

Running the test suite:

`php bin/phpunit`
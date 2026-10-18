# FolioForge - Portfolio Template Generator (Laravel)

Pure Laravel (Blade + Eloquent + migrations). No extra database tools, no npm build step.
All data, including the profile picture, is stored in the Laravel database.

## Run locally (PHP 8.3+, Composer)

Run these commands from the project root:

```sh
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

Then open http://127.0.0.1:8000. The default SQLite database is created at
`database/database.sqlite`.

## Publish online (database must be online too)

Use any host that runs PHP, e.g. Railway or Render, and add a MySQL/PostgreSQL database in the same host.
Set these environment variables (Laravel's own DB settings):
  APP_KEY (run `php artisan key:generate --show`), APP_ENV=production, APP_DEBUG=false, APP_URL=<your url>,
  DB_CONNECTION=mysql (or pgsql), DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD
Start command:
  php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT
# COLLABORATION-WST-LARAVEL-

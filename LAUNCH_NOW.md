# Launch Now - Laravel + MySQL

## Status
Laravel app iko tayari kwa backend + UI package. Routes, controllers, models, Blade views, admin middleware, auth flow, migrations, and seed data zimeandaliwa.

## Local Run Requirements
- PHP 8.2+
- Composer
- MySQL running on port 3306
- Database name: `thesun_db`

## Local Setup
1. Create MySQL database:
```sql
CREATE DATABASE thesun_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

2. Configure `.env`:
```env
APP_NAME="the sun Agency"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=thesun_db
DB_USERNAME=root
DB_PASSWORD=
```

3. Run commands from project root:
```bash
composer install
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

4. Open:
```text
http://127.0.0.1:8000
```

## Admin Login
```text
Email: admin@thesun.test
Password: Admin12345
```

## User Login
```text
Email: user@thesun.test
Password: User12345
```

## Routes
- `/` public home
- `/about` about page
- `/services` services from MySQL
- `/blog` blog posts from MySQL
- `/contact` contact form saves to MySQL
- `/login` login
- `/register` registration
- `/admin/dashboard` protected admin dashboard

## Production Deployment Checklist
1. Upload the whole Laravel project to hosting.
2. Point domain document root to `public/`.
3. Set production `.env`:
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
DB_CONNECTION=mysql
DB_HOST=your_mysql_host
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```
4. Run:
```bash
composer install --no-dev --optimize-autoloader
php artisan key:generate
php artisan migrate --force
php artisan db:seed --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan storage:link
```
5. Set writable permissions for:
```text
storage/
bootstrap/cache/
```

## Security Notes
- Admin route is protected by `auth` + `admin` middleware.
- Passwords use Laravel hashing.
- Forms use CSRF tokens.
- Input validation is implemented in controllers.
- Production must use `APP_DEBUG=false`.

## Important
Current local machine could not run migrations because MySQL refused connection on `127.0.0.1:3306`. Start MySQL/XAMPP/WAMP or update `.env` DB credentials, then run `php artisan migrate:fresh --seed`.

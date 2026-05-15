Summary of DB & security updates

-- Added `database/schema.sql` (MySQL) with full schema for the app plus security enhancements.
- Updated `Dockerfile` to use `php:8.2-apache` and install needed PHP extensions.
- Updated `render.yaml` start command to `apache2-foreground`.
- Hardened login flow in `app/Http/Controllers/AuthController.php` with rate-limiting and account lockout.

Important follow-ups

- If you want the new columns active (e.g., `failed_login_attempts`, `lockout_until`, `last_login_at`, `two_factor_secret`), add a new migration to update the `users` table or run the SQL in `database/schema.sql` against your DB.
- Laravel's default password resets table is `password_resets`. This project uses `password_reset_tokens` in migrations; ensure `config/auth.php` (password broker) matches, or rename the table.
- Do NOT store plaintext passwords. The seeder currently uses `Hash::make` in `AdminUserSeeder` (good) — rotate the seeded admin password after deploy.
- Run `php artisan key:generate` and set `APP_KEY` in Render secrets before first run.

Commands

Run the SQL directly against MySQL (example):

```bash
mysql --host=HOST --user=USER --password=PASSWORD DB_NAME < database/schema.sql
```

Or create a migration to apply changes via Artisan.

Security recommendations

- Enforce HTTPS (set `APP_URL` to https and use `
  \Illuminate\Middleware\TrustProxies` / webserver redirects).
- Enable 2FA for admin users (consider Laravel Fortify or a package).
- Use a production-ready webserver (`nginx + php-fpm`) and tune `opcache`.
- Use strong secrets on Render and enable managed Postgres with SSL.

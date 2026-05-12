# Raksamesin

Marketplace alat berat berbasis Laravel, Filament, Tailwind, dan SQLite/MySQL. Fitur awal mencakup katalog unit, detail kendaraan, inquiry lead, admin panel, role permission, audit log, forgot password, dan login Google.

## Setup Lokal

```bash
composer install
npm install
copy .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
npm run build
php artisan serve --host=127.0.0.1 --port=8012
```

Admin panel:

```text
http://127.0.0.1:8012/admin
```

Akun demo:

```text
admin@raksamesin.test / password
sales@raksamesin.test / password
```

## Google Login

Isi variabel ini di `.env`:

```env
GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
GOOGLE_REDIRECT_URI=http://127.0.0.1:8012/auth/google/callback
```

Untuk production, ganti `APP_URL` dan `GOOGLE_REDIRECT_URI` memakai domain asli.

## Deploy Singkat

Di server production:

```bash
composer install --no-dev --optimize-autoloader
npm ci
npm run build
php artisan key:generate
php artisan migrate --force
php artisan storage:link
php artisan optimize
```

Pastikan document root web server diarahkan ke folder `public`.

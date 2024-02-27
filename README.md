# Php 7.3, Laravel 8.75, Database Mysql

### Installation

Assuming your machine meets all requirements - let's process to installation of project.

1. Create new database named "vrunda_brainerhub_ecom_store"

2. Open in cmd or terminal app and navigate to this folder.

3. Run following commands

```bash
composer update
```

```bash
cp .env.example .env
```

```bash
php artisan config:cache
```

```bash
php artisan migrate
```

```bash
php artisan serve
```

And navigate to generated server link (http://127.0.0.1:8000)




 
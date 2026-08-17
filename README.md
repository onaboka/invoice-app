# Invoice App

A Laravel 13 application running in Docker (no Sail), with custom host ports to avoid conflicts with other local projects.

## Stack

- **Laravel**: 13
- **PHP**: 8.4 (php:8.4-fpm)
- **Web server**: Nginx (alpine)
- **Database**: MySQL 8.0
- **Cache/Queue**: Redis (alpine)

## Project Structure

```
.
├── Dockerfile                  # PHP-FPM image definition
├── docker-compose.yml          # Services: app, nginx, mysql, redis
├── docker/
│   └── nginx/
│       └── default.conf        # Nginx virtual host config
├── .dockerignore
├── .env                        # Local environment config (not committed)
└── ...                         # Standard Laravel app files
```

## Services & Ports

| Service | Container name        | Host port | Container port |
|---------|------------------------|-----------|-----------------|
| Nginx   | invoice-app-nginx      | 8010      | 80              |
| MySQL   | invoice-app-mysql      | 3310      | 3306            |
| Redis   | invoice-app-redis      | 6390      | 6379            |
| PHP-FPM | invoice-app-php        | —         | 9000 (internal) |

Ports are set in `docker-compose.yml` and can be changed per project to avoid clashing with other apps running locally.

## Environment Variables

Key values in `.env`:

```env
APP_URL=http://localhost:8010

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=invoice_app
DB_USERNAME=laravel
DB_PASSWORD=secret

REDIS_HOST=redis
REDIS_PORT=6379
```

> `DB_HOST` and `REDIS_HOST` use the Docker Compose **service names** (`mysql`, `redis`), not `localhost`, since containers communicate over the internal Docker network.

## Getting Started

### 1. Build the images

```bash
docker compose build
```

### 2. Start the containers

```bash
docker compose up -d
```

### 3. Install dependencies (first run only, if not already installed)

```bash
docker compose exec app composer install
```

### 4. Generate the application key

```bash
docker compose exec app php artisan key:generate
```

### 5. Run migrations

```bash
docker compose exec app php artisan migrate
```

### 6. Open the app

Visit: [http://localhost:8010](http://localhost:8010)

## Common Commands

```bash
docker compose up -d              # start containers
docker compose down                # stop containers
docker compose down -v             # stop containers AND remove volumes (wipes DB data)
docker compose build --no-cache    # rebuild images from scratch
docker compose exec app php artisan ...   # run artisan commands
docker compose exec app composer ...      # run composer commands
docker compose logs -f app         # tail app container logs
docker compose ps                  # list running containers for this project
```

## Notes

- `docker compose down` / `up` only affects containers defined in this project's `docker-compose.yml` — other local Docker projects are unaffected, as long as each project has its own compose file and project name.
- MySQL's database/user are only created on the **first** container startup against an empty volume. If `DB_DATABASE` in `.env` is changed after the volume already exists, remove the `mysql` volume and restart to reinitialize:
  ```bash
  docker compose down
  docker volume rm <mysql-volume-name>
  docker compose up -d
  ```
- `vendor/`, `node_modules/`, and `.env` are intentionally excluded from version control (see `.gitignore`).

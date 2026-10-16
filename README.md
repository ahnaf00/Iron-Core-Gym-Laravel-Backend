# Iron Core Gym — Laravel API

The REST API behind the Iron Core Gym website and admin panel: members, trainers, classes,
membership plans, blog posts, contact messages and gym settings.
Laravel 13 on PHP 8.4, MySQL, Sanctum session authentication.

Deployed on AWS (CloudFront → ALB → private EC2 in Docker → RDS MySQL).
Architecture, evidence and the full write-up: **[iron-core-gym-aws](https://github.com/ahnaf00/iron-core-gym-aws)**

Frontend: [Iron-Core-Gym-Vue-JS](https://github.com/ahnaf00/Iron-Core-Gym-Vue-JS)

## Routes

All routes live under `/api/v1` (`routes/api.php`).

| Access | Routes |
|---|---|
| Public | `POST auth/login` (5 per minute) · `GET classes` · `GET trainers` · `GET pricing` · `GET blogs` · `GET blogs/{slug}` · `POST contact` · `GET settings` |
| Signed in (Sanctum) | `POST auth/logout` · `GET auth/me` |
| Admin | `GET admin/dashboard/stats` · CRUD on `admin/members`, `admin/trainers`, `admin/classes`, `admin/pricing`, `admin/blog` · `admin/messages` (list, show, mark read/unread, delete) · `GET`/`PUT admin/settings` |

## Run with Docker

The image is a multi-stage build (Composer dependencies → PHP 8.4 runtime). No `.env` is baked in;
every setting comes from environment variables at start-up.

```bash
docker build -t iron-core-api .
docker run -p 8000:8000 --env-file .env.docker -e RUN_MIGRATIONS=true iron-core-api
```

Environment variables it needs:

| Variable | Purpose |
|---|---|
| `APP_KEY` | Laravel encryption key (`php artisan key:generate --show`) |
| `APP_URL`, `FRONTEND_URL` | Public URLs of the API and the site |
| `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` | MySQL connection |
| `SESSION_DOMAIN`, `SANCTUM_STATEFUL_DOMAINS` | Cookie domain and the domains allowed to use session auth |
| `RUN_MIGRATIONS` | `true` runs `php artisan migrate --force` before serving |

Seeding is a one-time manual step: `php artisan db:seed --force`.

The whole stack (MySQL + API + frontend) also runs locally with the `docker-compose.yml` in the parent project.

# Laravel + Vue Yandex Reviews Skeleton

Minimal Dockerized starter that pairs a Laravel 11 API with a Vue 3 single page application. The current backend exposes Sanctum-protected stubs for Yandex reviews while the frontend renders login, settings and reviews pages against those endpoints.

## Tech stack

- **Backend:** Laravel 11 (PHP 8.2) with Laravel Sanctum token authentication
- **Frontend:** Vue 3, Vite, vue-router, Axios
- **Database:** MySQL 8
- **Tooling:** Docker & Docker Compose

## Getting started

### Requirements

- Docker 24+
- Docker Compose V2

### 1. Clone the repository

```bash
git clone <repository-url>
cd <repository-folder>
```

### 2. Configure environments

- Backend: copy the example environment file.
  ```bash
  cp backend/.env.example backend/.env
  ```
- Frontend: copy the example environment file if you wish to override the default API URL.
  ```bash
  cp frontend/.env.example frontend/.env
  ```

Ensure the database credentials match those defined in `docker-compose.yml`.

### 3. Build and start the stack

```bash
docker compose build
docker compose up -d
```

### 4. Generate the application key and run migrations

```bash
docker compose exec backend php artisan key:generate
docker compose exec backend php artisan migrate --seed
```

This will create the required authentication tables and insert a demo administrator user.

### 5. Access the services

- Backend API: http://localhost:8000/api
- Frontend SPA: http://localhost:5173

## Authentication workflow

Log in from the frontend (or via the API) with the seeded credentials:

- **Email:** `admin@example.com`
- **Password:** `password`

`POST /api/login` returns a Sanctum personal access token. Send it as a `Bearer` token for authenticated requests (`/api/user`, `/api/settings`, `/api/summary`, `/api/reviews`, `/api/logout`).

## Available API endpoints (stubs)

- `POST /api/login` – issue Sanctum token for valid credentials
- `POST /api/logout` – revoke current token
- `GET /api/user` – return authenticated user
- `GET /api/settings` – return hard-coded Yandex URL
- `POST /api/settings` – accept a URL and echo it back
- `GET /api/summary` – return dummy rating/total review numbers
- `GET /api/reviews` – return a static list of sample reviews

## Notes

- The Yandex integration is not yet implemented; review and summary data are fixed placeholders.
- Database migrations only cover the default Laravel authentication tables required by Sanctum.
- Update the host ports in `docker-compose.yml` if port `8000` or `5173` are already in use.

# FleetSys Backend
**This project is very big and has a lot to do**
FleetSys is a API backend application for managing vehicle fleets. This project is built with Laravel and PostgreSQL.

## Requirements

- **PHP 8.3**
- **Composer**
- **PostgreSQL 10 or above**

## How to Run

### Step 1: Install Dependencies

First, ensure you have PHP 8.3, Composer, and PostgreSQL installed on your machine.

### Step 2: Setup Environment

Copy the example environment file and create your own `.env` file:

```sh
cp .env-example .env
```

### Step 3: Generate App Key

```sh
php artisan key:generate
```
### Step 4: Run Migrations

Run the database migrations to set up the database schema:

```sh
php artisan migrate
```
### Step 5: Seed Database 🌱

Seed the database with initial data:

```sh
php artisan db:seed
```

### Step 6: Start the Server

```sh
php artisan serve
```
The application will be running at http://127.0.0.1:8000.

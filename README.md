# Laravel 12 Installation Guide

This guide will help you install a Laravel 12 project from GitHub to your local environment.

## Prerequisites
Ensure you have the following installed:
- **PHP 8.2 or later**
- **Composer** (PHP dependency manager)
- **MySQL or PostgreSQL** (or any other database supported by Laravel)
- **Node.js & NPM** (for frontend dependencies)
- **Git** (to clone the repository)

## Installation Steps

### 1. Clone the Repository
```sh
git clone https://github.com/hashmicro-code-test.git
cd hashmicro-code-test
```

### 2. Install Dependencies
```sh
composer install
npm install
```

### 3. Create Environment File
```sh
cp .env.example .env
```

### 4. Configure Environment Variables
Edit the `.env` file and update the following:
```ini
APP_NAME="Your App Name"
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### 5. Generate Application Key
```sh
php artisan key:generate
```

### 6. Run Database Migrations
```sh
php artisan migrate --seed
```

### 7. Start the Development Server
```sh
php artisan serve
```

### 8. Compile Frontend Assets
```sh
npm run dev
```

## Access the Application
Once the server is running, open your browser and visit:
```
http://127.0.0.1:8000
```

## Additional Commands
### To clear cache (if needed):
```sh
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## Contributing
If you want to contribute, fork the repository and submit a pull request.

## License
This project is licensed under [MIT License](LICENSE).


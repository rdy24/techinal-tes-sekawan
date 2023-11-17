# Technical Test Backend Developer Sekawan Media

## System Requirements

- PHP : v8.1.11
- MySQL : v8.0.30
- Framework : Laravel v10.10
- Web Browser : Microsoft Edge


## Installation
1. Clone github repository `git clone https://github.com/rdy24/techinal-tes-sekawan.git` or download zip
2. Install dependency, run composer install in terminal
   ```bash
    composer install
    ```
3. Copy .env.example to .env manually or using command in terminal
    ```bash
    copy .env.example .env
    ```
    or
    ```bash
    cp .env.example .env
    ```

4. Set your database in .env edit this line with your database configuration
   ```bash
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5. Generate App key
    ```bash
    php artisan key:generate
    ```

6. Migrate database and run seeder
    ```bash
    php artisan migrate --seed
    ```

7. Serve the application
    ```bash
    php artisan serve
    ```

## User Account

1. **Admin** (email: admin@gmail.com | password: admin123)
2. **Manager** (email: manager@gmail.com | password: manager123)
3. **Supervisor** (email: supervisor@gmail.com | password: supervisor123)

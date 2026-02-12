# Mini Blog

A modern blogging platform built with Symfony 8.0, featuring user authentication, post management, categories, and comments.

## 🚀 Features

- **User Management**
  - User registration and authentication
  - Role-based access control (Admin/User)
  - User profiles with profile pictures
  - User account activation system
  
- **Blog Posts**
  - Create, edit, and delete posts
  - Rich text content with images
  - Post categorization
  - Publish date tracking
  
- **Categories**
  - Organize posts by categories
  - Category management (Admin only)
  
- **Comments**
  - Comment on blog posts
  - User interaction and engagement
  
- **Admin Panel**
  - Dedicated admin dashboard
  - Post management
  - Category management
  - User management
  
- **Modern Frontend**
  - Symfony UX (Stimulus & Turbo)
  - AssetMapper for zero-build frontend
  - Responsive design

## 📋 Requirements

- **PHP** >= 8.4
- **Composer** 2.x
- **PostgreSQL** 16+ (or MySQL/MariaDB)
- **Docker & Docker Compose** (optional, for containerized database)

## 🛠️ Installation

### 1. Clone the Repository

```bash
git clone <repository-url>
cd mini_blog
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Configure Environment

Copy the `.env` file and configure your database:

```bash
cp .env .env.local
```

Edit `.env.local` with your database credentials:

```env
# For PostgreSQL (with Docker)
DATABASE_URL="postgresql://app:!ChangeMe!@127.0.0.1:5432/app?serverVersion=16&charset=utf8"

# Or for MySQL
DATABASE_URL="mysql://root:@127.0.0.1:3306/mini_blog?serverVersion=8.0"
```

Set your `APP_SECRET`:

```env
APP_SECRET=your-secret-key-here
```

### 4. Start the Database (Docker)

If using Docker Compose:

```bash
docker compose up -d
```

This will start a PostgreSQL 16 container.

### 5. Create the Database and Run Migrations

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

### 6. Load Fixtures (Optional)

Load sample data for development:

```bash
php bin/console doctrine:fixtures:load
```

This will create:
- Sample users (with admin accounts)
- Categories
- Blog posts
- Comments

### 7. Install Assets

```bash
php bin/console asset-map:compile
```

### 8. Start the Development Server

```bash
symfony server:start
```

Or use PHP's built-in server:

```bash
php -S localhost:8000 -t public/
```

Visit [http://localhost:8000](http://localhost:8000) to see your blog!

## 🔑 Default Accounts

After loading fixtures, you can log in with these credentials:

**Admin Account:**
- Email: `admin@example.com`
- Password: Check `UserFixtures.php`

**Regular User:**
- Email: `user@example.com`
- Password: Check `UserFixtures.php`

## 📁 Project Structure

```
mini_blog/
├── assets/              # Frontend assets (JS, CSS)
├── bin/                 # Console scripts
├── config/              # Configuration files
│   ├── packages/        # Bundle configurations
│   └── routes/          # Route definitions
├── migrations/          # Database migrations
├── public/              # Web root
├── src/
│   ├── Controller/      # Controllers
│   ├── Entity/          # Doctrine entities
│   ├── Form/            # Form types
│   ├── Repository/      # Database repositories
│   ├── DataFixtures/    # Sample data
│   └── Security/        # Security components
├── templates/           # Twig templates
├── tests/               # Tests
└── var/                 # Cache and logs
```

## 🔒 Security

This application implements:
- CSRF protection
- Password hashing with bcrypt
- Role-based access control
- User account activation
- Secure session management

## 🧪 Testing

Run the test suite:

```bash
php bin/phpunit
```

## 🚀 Deployment

### Production Setup

1. Set environment to production:

```env
APP_ENV=prod
APP_DEBUG=0
```

2. Optimize autoloader and clear cache:

```bash
composer install --no-dev --optimize-autoloader
php bin/console cache:clear --env=prod
php bin/console cache:warmup --env=prod
```

3. Run migrations:

```bash
php bin/console doctrine:migrations:migrate --no-interaction
```

4. Set proper permissions:

```bash
chown -R www-data:www-data var/
```

## 📦 Docker Compose Services

- **database**: PostgreSQL 16 Alpine
  - Port: 5432
  - Default database: `app`
  - Default user: `app`
  - Default password: `!ChangeMe!` (change in production!)

## 🛠️ Available Commands

```bash
# Database
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load

# Cache
php bin/console cache:clear
php bin/console cache:warmup

# Assets
php bin/console asset-map:compile
php bin/console importmap:install

# Development
symfony server:start
symfony console make:entity
symfony console make:controller
```

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📝 License

This project is proprietary software.

## 🙏 Built With

- [Symfony 8.0](https://symfony.com/) - PHP Framework
- [Doctrine ORM](https://www.doctrine-project.org/) - Database ORM
- [Twig](https://twig.symfony.com/) - Template Engine
- [Symfony UX](https://ux.symfony.com/) - Modern Frontend Components
- [PostgreSQL](https://www.postgresql.org/) - Database
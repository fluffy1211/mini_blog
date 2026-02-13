# Mini Blog

A modern blogging platform built with Symfony 8.0, featuring user authentication, post management, categories, and comments.

## 🚀 Features

- **User Management**
  - User registration and authentication
  - Role-based access control (Admin/User)
  - User profiles with profile pictures
  - User account activation/deactivation system
  - Admin can toggle user account status
  
- **Blog Posts**
  - Create, edit, and delete posts
  - Image upload with automatic file management
  - Old images automatically deleted when updating
  - Post categorization
  - Publish date tracking
  - Author attribution
  
- **Categories**
  - Organize posts by categories
  - Full CRUD operations (Admin only)
  - Category assignment to posts
  
- **Comment System**
  - Comment on blog posts
  - **Comment moderation system**
    - Comments require approval before display
    - Admin can approve/disapprove/delete comments
    - Status tracking (pending, approved, rejected)
    - Separate views for pending and approved comments
  
- **Admin Panel**
  - Comprehensive admin dashboard
  - **Post Management**
    - Create posts with image upload
    - Edit posts with image replacement
    - Delete posts
  - **Category Management**
    - Create, edit, and delete categories
  - **User Management**
    - View all registered users
    - Activate/deactivate user accounts
  - **Comment Moderation**
    - Review pending comments
    - Approve or disapprove comments
    - Delete inappropriate comments
  
- **Modern Frontend**
  - Symfony UX (Stimulus & Turbo)
  - AssetMapper for zero-build frontend
  - Responsive design
  - CSRF protection on all forms

## 📋 Requirements

- **PHP** >= 8.4
- **Composer** 2.x
- **MySQL** 8.0+ or MariaDB 10.5+

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

### 3. Install and Configure MySQL

Make sure MySQL is installed and running on your system.

**For macOS:**
```bash
brew install mysql
brew services start mysql
```

**For Ubuntu/Debian:**
```bash
sudo apt update
sudo apt install mysql-server
sudo systemctl start mysql
```

**For Windows:**
Download and install MySQL from [https://dev.mysql.com/downloads/installer/](https://dev.mysql.com/downloads/installer/)

### 4. Configure Environment

Copy the `.env` file and configure your database:

```bash
cp .env .env.local
```

Edit `.env.local` with your MySQL credentials:

```env
# MySQL Configuration
DATABASE_URL="mysql://root:your_password@127.0.0.1:3306/mini_blog?serverVersion=8.0"
```

Replace `your_password` with your MySQL root password (leave empty if no password is set).

Set your `APP_SECRET`:

```env
APP_SECRET=your-secret-key-here
```

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
- Comments (pending and approved)

### 7. Create Uploads Directory

Create the directory for post images:

```bash
mkdir -p public/uploads
chmod 755 public/uploads
```

### 8. Install Assets

```bash
php bin/console asset-map:compile
```

### 9. Start the Development Server

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
- Password: Check `src/DataFixtures/UserFixtures.php`

**Regular User:**
- Email: `user@example.com`
- Password: Check `src/DataFixtures/UserFixtures.php`

## 📁 Project Structure

```
mini_blog/
├── assets/              # Frontend assets (JS, CSS, Stimulus controllers)
│   ├── controllers/     # Stimulus controllers
│   └── styles/          # CSS files
├── bin/                 # Console scripts
├── config/              # Configuration files
│   ├── jwt/             # JWT keys (generated)
│   ├── packages/        # Bundle configurations
│   └── routes/          # Route definitions
├── migrations/          # Database migrations
├── public/              # Web root
│   └── uploads/         # User-uploaded images
├── src/
│   ├── Controller/      # Controllers (Admin, Post, etc.)
│   ├── Entity/          # Doctrine entities (User, Post, Comment, Category)
│   ├── Form/            # Form types
│   ├── Repository/      # Database repositories
│   ├── DataFixtures/    # Sample data generators
│   └── Security/        # Security components (UserChecker)
├── templates/           # Twig templates
│   ├── admin/           # Admin panel views
│   ├── post/            # Post views
│   ├── security/        # Login/Register views
│   └── partials/        # Reusable template parts
├── tests/               # Tests
└── var/                 # Cache and logs
```

## 🔒 Security

This application implements:
- CSRF protection on all forms
- Password hashing with bcrypt
- Role-based access control (ROLE_USER, ROLE_ADMIN)
- User account activation/deactivation
- Secure session management
- User checker for active account validation

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

2. Generate JWT keys (if not already done):

```bash
php bin/console lexik:jwt:generate-keypair
```

3. Optimize autoloader and clear cache:

```bash
composer install --no-dev --optimize-autoloader
php bin/console cache:clear --env=prod
php bin/console cache:warmup --env=prod
```

4. Run migrations:

```bash
php bin/console doctrine:migrations:migrate --no-interaction
```

5. Set proper permissions:

```bash
chown -R www-data:www-data var/
chown -R www-data:www-data public/uploads/
chmod -R 755 public/uploads/
```

## ️ Available Commands

```bash
# Database
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load

# JWT Keys
php bin/console lexik:jwt:generate-keypair

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
symfony console make:migration
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
- [MySQL](https://www.mysql.com/) - Database
# Cyber Help India — Modular Lightweight MVC PHP Architecture

An extensible, framework-free PHP 8.5+ foundation engineered for modular, page-by-page development. Designed with separation of concerns, modern security practices, reusable layouts, and clean PSR-4 conventions.

---

## Table of Contents
1. [Project Overview](#project-overview)
2. [Project Structure](#project-structure)
3. [Requirements](#requirements)
4. [Installation & Setup](#installation--setup)
5. [Configuring Environment (.env)](#configuring-environment-env)
6. [Database Setup](#database-setup)
7. [Starting the Local PHP Server](#starting-the-local-php-server)
8. [Architecture & Request Flow](#architecture--request-flow)
9. [How Routing Works](#how-routing-works)
10. [How to Create a New Page](#how-to-create-a-new-page)
11. [How to Create a Controller](#how-to-create-a-controller)
12. [How to Create a Model](#how-to-create-a-model)
13. [How to Add CSS & JavaScript](#how-to-add-css--javascript)
14. [Security Best Practices](#security-best-practices)

---

## 1. Project Overview
- **Language**: PHP 8.2+ (tested & optimized for PHP 8.5+)
- **Database**: MySQL / MariaDB (via PDO)
- **Frontend**: HTML5, Vanilla CSS3 (Custom Design Tokens, Mobile-First), Vanilla JavaScript
- **Frameworks**: None (Pure, clean, beginner-friendly PHP architecture)
- **Autoloading**: PSR-4 compatible (`App\` &rarr; `app/`)

---

## 2. Project Structure

```
cyber-help-india/
│
├── public/                     # Web-accessible document root
│   ├── index.php               # Front controller & single entry point
│   ├── .htaccess               # URL rewrites and hidden-file blocking
│   ├── assets/
│   │   ├── css/
│   │   │   ├── style.css       # Core design tokens, base styles & components
│   │   │   └── responsive.css  # Mobile and tablet media queries
│   │   ├── js/
│   │   │   └── main.js         # Navigation drawer & AJAX helper hooks
│   │   ├── images/
│   │   │   ├── logo/           # Branding graphics (.gitkeep)
│   │   │   ├── pages/          # Page-specific banners & graphics (.gitkeep)
│   │   │   └── uploads/        # Static demo assets (.gitkeep)
│   │   └── fonts/              # Custom web fonts (.gitkeep)
│   └── uploads/                # User uploaded media (.gitkeep)
│
├── app/                        # Application source code (Protected)
│   ├── config/
│   │   ├── config.php          # Central configuration repository
│   │   └── database.php        # PDO Database connection singleton
│   ├── controllers/
│   │   ├── Controller.php      # Abstract base controller (view/json helpers)
│   │   └── HomeController.php  # Public homepage controller
│   ├── models/                 # Future database models (.gitkeep)
│   ├── views/
│   │   ├── layouts/
│   │   │   ├── header.php      # Doctype, <head>, meta, fonts, asset links
│   │   │   ├── footer.php      # Footer links, helpline, script tags
│   │   │   └── main.php        # Master layout wrapper (header + nav + content + footer)
│   │   ├── components/
│   │   │   ├── navbar.php      # Responsive navigation bar with mobile toggle
│   │   │   ├── alert.php       # Reusable notification banner
│   │   │   ├── button.php      # Reusable button / anchor component
│   │   │   └── pagination.php  # Accessible page navigation component
│   │   ├── pages/
│   │   │   ├── home.php        # Homepage content (Hero, Intro, CTA)
│   │   │   └── placeholder.php # Reusable "Coming Soon" foundation page
│   │   └── errors/
│   │       ├── 404.php         # Clean 404 Not Found screen
│   │       ├── 500.php         # Production 500 error screen
│   │       └── debug.php       # Rich developer debug trace screen
│   ├── helpers/
│   │   ├── auth.php            # Session authentication state helpers
│   │   ├── functions.php       # env(), config(), view(), asset(), base_url()
│   │   ├── security.php        # e() XSS filter, CSRF tokens, security headers
│   │   └── validation.php      # Form and request input validator
│   └── routes/
│       ├── Router.php          # Regex URL router & action dispatcher
│       └── web.php             # Route definitions table
│
├── database/
│   ├── migrations/             # Database version migrations (.gitkeep)
│   ├── seeds/                  # Seed data scripts (.gitkeep)
│   └── schema.sql              # Base database schema & SQL templates
│
├── storage/
│   ├── logs/                   # Application error logs (app.log)
│   ├── cache/                  # Runtime cache files (.gitkeep)
│   └── sessions/               # File-based sessions (.gitkeep)
│
├── tests/
│   └── test_smoke.php          # Quick automated architecture check
│
├── .env                        # Local active configuration (ignored by git)
├── .env.example                # Example configuration template
├── .gitignore                  # Git ignore rules preserving .gitkeep
├── composer.json               # PSR-4 definition and dependencies
└── README.md                   # Complete architectural guide
```

---

## 3. Requirements
- **PHP**: 8.2 or higher (8.5+ recommended)
- **PHP Extensions**: `pdo`, `pdo_mysql`, `session`, `mbstring`, `json`
- **Database**: MySQL 5.7+ / 8.0+ or MariaDB 10.3+
- **Web Server** (optional for production): Apache with `mod_rewrite` or Nginx

---

## 4. Installation & Setup

1. **Clone the repository**:
   ```bash
   git clone <repo-url> cyber-help-india
   cd cyber-help-india
   ```

2. **Set up Environment File**:
   ```bash
   cp .env.example .env
   ```

3. **Verify Directory Permissions**:
   Ensure the `storage/` directory is writable:
   ```bash
   chmod -R 775 storage public/uploads
   ```

4. **Verify Foundation with Smoke Test**:
   ```bash
   php tests/test_smoke.php
   ```

---

## 5. Configuring Environment (.env)

Edit the `.env` file in the root directory:

```env
APP_NAME="Cyber Help India"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cyber_help_db
DB_USERNAME=root
DB_PASSWORD=your_mysql_password
DB_CHARSET=utf8mb4
```

- When `APP_DEBUG=true`: Detailed stack traces with file locations are displayed on screen.
- When `APP_DEBUG=false`: Generic, secure 500 error pages are shown to visitors, and errors are written to `storage/logs/app.log`.

---

## 6. Database Setup

1. Ensure MySQL is running on your machine.
2. Import the starter schema from `database/schema.sql`:
   ```bash
   mysql -u root -p < database/schema.sql
   ```
3. Update `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` in your `.env`.

> **Note**: The homepage runs independently without requiring database tables. The database connection is established on-demand when a Model calls `Database::connect()`.

---

## 7. Starting the Local PHP Server

Run PHP's built-in development server pointing to the `public/` directory:

```bash
php -S localhost:8000 -t public
```

Now open [http://localhost:8000](http://localhost:8000) in your web browser.

---

## 8. Architecture & Request Flow

```
Incoming Browser Request (e.g. GET /)
             │
             ▼
   public/index.php (Front Controller)
             │
             ├── Loads Autoloader & Helpers (functions, security, validation, auth)
             ├── Loads .env variables
             ├── Sends HTTP Security Headers
             ├── Initializes Secure Session
             └── Registers Centralized Exception Handler
             │
             ▼
   app/routes/web.php (Route Matching via Router)
             │
             ▼
   app/controllers/HomeController.php (Controller Action)
             │
             ├── Fetches data or prepares view model (Model layer if required)
             └── Calls $this->view('pages/home', $data)
             │
             ▼
   app/views/layouts/main.php (View & Layout Engine)
             │
             ├── app/views/layouts/header.php
             ├── app/views/components/navbar.php
             ├── app/views/pages/home.php (Injected content)
             └── app/views/layouts/footer.php
             │
             ▼
   HTTP 200 Response sent to Client
```

---

## 9. How Routing Works

Routes are registered in `app/routes/web.php` using `App\Routes\Router`:

### Registering Basic Routes
```php
use App\Routes\Router;
use App\Controllers\HomeController;

// Controller action
Router::get('/', [HomeController::class, 'index']);

// Closure action
Router::get('/about', function() {
    view('pages/placeholder', ['title' => 'About Us']);
});
```

### Route Parameters
Place dynamic segments in `{parameter_name}` braces:
```php
Router::get('/blog/{slug}', [BlogController::class, 'show']);
```
The parameter `$slug` is automatically passed into the controller method:
```php
public function show(string $slug): void {
    // ...
}
```

### Supported HTTP Verbs
- `Router::get($path, $action)`
- `Router::post($path, $action)`
- `Router::match(['GET', 'POST'], $path, $action)`

---

## 10. How to Create a New Page

Building a new page takes 3 steps:

### Step 1: Create the View
Create `app/views/pages/services.php`:
```php
<?php
/**
 * Services Page
 */
?>
<section class="section">
    <div class="container">
        <h1>Cyber Safety Services</h1>
        <p>Explore our community workshops and vulnerability checks.</p>
    </div>
</section>
```

### Step 2: Create or Update Controller
In `app/controllers/ServicesController.php`:
```php
namespace App\Controllers;

class ServicesController extends Controller {
    public function index(): void {
        $this->view('pages/services', [
            'pageTitle' => 'Our Services — Cyber Help India',
            'metaDescription' => 'Practical cybersecurity support and guides.'
        ]);
    }
}
```

### Step 3: Register the Route
In `app/routes/web.php`:
```php
use App\Controllers\ServicesController;

Router::get('/services', [ServicesController::class, 'index']);
```

---

## 11. How to Create a Controller

All controllers extend `App\Controllers\Controller`:

```php
namespace App\Controllers;

class IncidentController extends Controller {
    public function create(): void {
        $this->view('pages/report_incident', [
            'pageTitle' => 'Report an Incident'
        ]);
    }

    public function store(): void {
        // Validate incoming POST data
        $result = validate($_POST, [
            'name'  => 'required|min:3',
            'email' => 'required|email',
            'description' => 'required|min:10'
        ]);

        if (!$result['isValid']) {
            $this->view('pages/report_incident', [
                'errors' => $result['errors'],
                'old'    => $_POST
            ]);
            return;
        }

        // Return JSON or redirect
        $this->redirect('/incident/success');
    }
}
```

---

## 12. How to Create a Model

Place models in `app/models/` using `App\Config\Database`:

```php
namespace App\Models;

use App\Config\Database;
use PDO;

class User {
    public static function findById(int $id): ?array {
        $stmt = Database::query("SELECT * FROM users WHERE id = :id LIMIT 1", ['id' => $id]);
        $user = $stmt->fetch();
        return $user ?: null;
    }

    public static function create(array $data): int {
        $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        Database::query($sql, [
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_BCRYPT)
        ]);

        return (int) Database::connect()->lastInsertId();
    }
}
```

---

## 13. How to Add CSS & JavaScript

1. **Global CSS**: Add styles to `public/assets/css/style.css` using the defined CSS custom properties (tokens).
2. **Responsive CSS**: Add media query overrides in `public/assets/css/responsive.css`.
3. **Client-Side JS**: Add DOM interactions and fetch logic in `public/assets/js/main.js`.
4. **Cache Busting**: The `asset('css/style.css')` helper automatically appends `?v=<timestamp>` to prevent stale caching.

---

## 14. Security Best Practices

This architecture enforces fundamental security principles:

1. **XSS Prevention**: Always escape dynamic output in HTML templates using `e($variable)`:
   ```html
   <h2>Hello, <?= e($user['name']) ?></h2>
   ```
2. **CSRF Protection**: For all HTML forms, include `<?= csrf_field() ?>`:
   ```html
   <form method="POST" action="/contact">
       <?= csrf_field() ?>
       <button type="submit">Submit</button>
   </form>
   ```
   Verify tokens in controllers using `verify_csrf_token()`.
3. **SQL Injection Defense**: Always use PDO prepared statements with bound parameters (`Database::query($sql, $params)`). Never concatenate user input directly into SQL strings.
4. **Hardened Sessions**: Session cookies are configured with `HttpOnly`, `SameSite=Lax`, and `Secure` attributes.
5. **Security Headers**: Standard headers (`X-Content-Type-Options`, `X-Frame-Options`, `Referrer-Policy`) are emitted on every request.
6. **Isolated Web Root**: Only `public/` is exposed to web visitors. Configuration files, `.env`, views, controllers, and logs are located outside `public/` and protected by `.htaccess` rules.

<?php
/**
 * Web Routes Configuration
 * 
 * Defines all user-facing web routes for the application.
 * Mapped to controllers or simple closures.
 */

declare(strict_types=1);

use App\Routes\Router;
use App\Controllers\HomeController;

// -----------------------------------------------------------------------------
// Core Routes
// -----------------------------------------------------------------------------

// Homepage
Router::get('/', [HomeController::class, 'index']);

// About Page (Foundation Placeholder)
Router::get('/about', function () {
    view('pages/placeholder', [
        'pageTitle' => 'About Us — Cyber Help India',
        'title'     => 'About Cyber Help India',
        'subtitle'  => 'Our mission is to empower citizens and organizations with knowledge, tools, and immediate response steps against digital threats.',
        'badge'     => 'Coming Soon'
    ]);
});

// Contact Page (Foundation Placeholder)
Router::get('/contact', function () {
    view('pages/placeholder', [
        'pageTitle' => 'Contact & Support — Cyber Help India',
        'title'     => 'Get in Touch with Cyber Help',
        'subtitle'  => 'Helpline directory, community reporting resources, and incident support channels are currently being prepared.',
        'badge'     => 'Coming Soon'
    ]);
});

// -----------------------------------------------------------------------------
// Future Route Examples (Ready for implementation)
// -----------------------------------------------------------------------------
// Router::get('/services', [ServicesController::class, 'index']);
// Router::get('/blog', [BlogController::class, 'index']);
// Router::get('/blog/{slug}', [BlogController::class, 'show']);
// Router::get('/login', [AuthController::class, 'showLogin']);
// Router::post('/login', [AuthController::class, 'login']);
// Router::get('/register', [AuthController::class, 'showRegister']);
// Router::get('/dashboard', [DashboardController::class, 'index']);
// Router::get('/admin', [AdminController::class, 'index']);

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

// Services Page (Foundation Placeholder)
Router::get('/services', function () {
    view('pages/placeholder', [
        'pageTitle' => 'Our Services — Cyber Help India',
        'title'     => 'Cyber Security Services',
        'subtitle'  => 'Comprehensive digital safety, fraud investigation support, and cyber consultation services are coming soon.',
        'badge'     => 'Coming Soon'
    ]);
});

// Softwares Page (Foundation Placeholder)
Router::get('/softwares', function () {
    view('pages/placeholder', [
        'pageTitle' => 'Security Softwares — Cyber Help India',
        'title'     => 'Security Tools & Software',
        'subtitle'  => 'Curated, vetted anti-phishing, malware protection, and digital hygiene tools for Indian users.',
        'badge'     => 'Coming Soon'
    ]);
});

// Packages Page (Foundation Placeholder)
Router::get('/packages', function () {
    view('pages/placeholder', [
        'pageTitle' => 'Safety Packages — Cyber Help India',
        'title'     => 'Digital Safety Packages',
        'subtitle'  => 'Tailored cybersecurity protection plans for individuals, schools, and small businesses.',
        'badge'     => 'Coming Soon'
    ]);
});

// Career Page (Foundation Placeholder)
Router::get('/career', function () {
    view('pages/placeholder', [
        'pageTitle' => 'Careers — Cyber Help India',
        'title'     => 'Join Our Mission',
        'subtitle'  => 'Career opportunities and internship programs in cyber defense, awareness, and community outreach.',
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

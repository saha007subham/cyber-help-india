<?php
/**
 * Navigation Bar Component
 * 
 * Top-level responsive navigation header with brand identifier,
 * menu links, mobile toggle, and emergency helpline highlight.
 */
declare(strict_types=1);

$currentUri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$currentUri = '/' . trim($currentUri, '/');
if ($currentUri === '//') {
    $currentUri = '/';
}
?>
<header class="site-header">
    <div class="container navbar-container">
        <a href="<?= base_url() ?>" class="navbar-brand" aria-label="Cyber Help India Home">
            <img src="<?= asset('images/logo/cyber-help-india.png') ?>" alt="Cyber Help India" class="brand-logo" width="92" height="50">
        </a>

        <!-- Mobile Navigation Toggle Button -->
        <button id="nav-toggle" class="nav-toggle" aria-label="Toggle navigation menu" aria-expanded="false" aria-controls="primary-nav">
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
        </button>

        <!-- Navigation Links -->
        <nav id="primary-nav" class="navbar-nav" aria-label="Main Navigation">
            <ul class="nav-list">
                <li class="nav-item">
                    <a href="<?= base_url() ?>" class="nav-link <?= $currentUri === '/' ? 'active' : '' ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('about') ?>" class="nav-link <?= $currentUri === '/about' ? 'active' : '' ?>">About</a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('contact') ?>" class="nav-link <?= $currentUri === '/contact' ? 'active' : '' ?>">Contact</a>
                </li>
            </ul>

            <div class="nav-cta-group">
                <a href="tel:1930" class="btn btn-emergency" title="National Cyber Crime Helpline">
                    <span class="emergency-icon">&#128222;</span>
                    <span>Emergency: <strong>1930</strong></span>
                </a>
            </div>
        </nav>
    </div>
</header>

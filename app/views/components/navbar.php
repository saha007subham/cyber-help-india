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
                    <a href="<?= base_url('services') ?>" class="nav-link <?= $currentUri === '/services' ? 'active' : '' ?>">Services</a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('softwares') ?>" class="nav-link <?= $currentUri === '/softwares' ? 'active' : '' ?>">Softwares</a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('packages') ?>" class="nav-link <?= $currentUri === '/packages' ? 'active' : '' ?>">Packages</a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('career') ?>" class="nav-link <?= $currentUri === '/career' ? 'active' : '' ?>">Career</a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('contact') ?>" class="nav-link <?= $currentUri === '/contact' ? 'active' : '' ?>">Contact</a>
                </li>
            </ul>

            <div class="nav-cta-group">
                <!-- Send Enquiry Button -->
                <a href="<?= base_url('contact') ?>" class="btn-header-enquiry" title="Send Enquiry">
                    <span class="enquiry-icon" aria-hidden="true">
                        <svg width="18" height="14" viewBox="0 0 28 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 1H5C2.79086 1 1 2.79086 1 5V13C1 15.2091 2.79086 17 5 17H6V20.5L10.5 17H19C21.2091 17 23 15.2091 23 13V5C23 2.79086 21.2091 1 19 1Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M23 6.5H24C25.6569 6.5 27 7.84315 27 9.5V14.5C27 16.1569 25.6569 17.5 24 17.5H23V20.5L19.5 17.5H17" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <circle cx="7.5" cy="9" r="1.2" fill="white"/>
                            <circle cx="12" cy="9" r="1.2" fill="white"/>
                            <circle cx="16.5" cy="9" r="1.2" fill="white"/>
                        </svg>
                    </span>
                    <span class="enquiry-text">Send Enquiry</span>
                </a>

                <!-- Let's Talk & Phone Number Button -->
                <div class="header-call-wrap">
                    <span class="talk-tagline">Let's Talk</span>
                    <a href="tel:9233556555" class="btn-header-call" title="Call 92335 56555">
                        <span class="call-icon-wrap" aria-hidden="true">
                            <svg width="22" height="18" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7 13.5C8.8 17.2 11.8 20.2 15.5 22L18.4 19.1C18.8 18.7 19.3 18.6 19.8 18.7C21.2 19.2 22.8 19.5 24.4 19.5C25.3 19.5 26 20.2 26 21.1V26.2C26 27.1 25.3 27.8 24.4 27.8C12.6 27.8 3.2 18.4 3.2 6.6C3.2 5.7 3.9 5 4.8 5H9.9C10.8 5 11.5 5.7 11.5 6.6C11.5 8.2 11.8 9.8 12.3 11.2C12.4 11.7 12.3 12.2 11.9 12.6L7 13.5Z" fill="white"/>
                                <path d="M22.5 7C25.5 10 25.5 15 22.5 18" stroke="white" stroke-width="2.4" stroke-linecap="round"/>
                                <path d="M26 3.5C31 8.5 31 18.5 26 23.5" stroke="white" stroke-width="2.4" stroke-linecap="round"/>
                            </svg>
                        </span>
                        <span class="call-number">92335 56555</span>
                    </a>
                </div>
            </div>
        </nav>
    </div>
</header>

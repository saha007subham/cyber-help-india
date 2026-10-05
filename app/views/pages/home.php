<?php
/**
 * Homepage View
 * 
 * Clean, modern base homepage consisting of:
 * 1. Hero Section
 * 2. Short Introduction & Threat Awareness
 * 3. Quick Action CTA
 */
declare(strict_types=1);
?>

<!-- =========================================================================
     Hero Section
     ========================================================================= -->
<section class="hero-section">
    <div class="container hero-container">
        <div class="hero-layout">
            <div class="hero-copy">
                <div class="hero-visual-bg" aria-hidden="true">
                    <span class="hero-glow hero-glow-primary"></span>
                    <span class="hero-glow hero-glow-secondary"></span>
                    <span class="hero-orb"></span>
                    <span class="hero-particles">
                        <span class="particle particle-1"></span>
                        <span class="particle particle-2"></span>
                        <span class="particle particle-3"></span>
                        <span class="particle particle-4"></span>
                        <span class="particle particle-5"></span>
                        <span class="particle particle-6"></span>
                        <span class="particle particle-7"></span>
                        <span class="particle particle-8"></span>
                    </span>
                    <svg class="hero-network" viewBox="0 0 640 420" preserveAspectRatio="xMidYMid meet" aria-hidden="true">
                        <path d="M36 116 C 134 70, 210 72, 286 122 S 438 182, 560 124"/>
                        <path d="M86 252 C 176 210, 246 206, 332 236 S 496 300, 584 272"/>
                        <path d="M160 44 C 214 118, 196 194, 246 260 S 390 330, 498 292"/>
                        <path d="M420 54 C 372 132, 390 206, 346 268 S 250 336, 206 306"/>
                        <circle cx="72" cy="116" r="2.5"/>
                        <circle cx="210" cy="78" r="2.5"/>
                        <circle cx="286" cy="122" r="2.5"/>
                        <circle cx="560" cy="124" r="2.5"/>
                        <circle cx="160" cy="252" r="2.5"/>
                        <circle cx="344" cy="236" r="2.5"/>
                        <circle cx="584" cy="272" r="2.5"/>
                        <circle cx="420" cy="54" r="2.5"/>
                        <circle cx="346" cy="268" r="2.5"/>
                    </svg>
                </div>

                <div class="hero-content">
                    <!-- <div class="hero-badge-wrap">
                        <span class="badge badge-accent">
                            <span class="badge-dot"></span> Citizen Cybersecurity Initiative
                        </span>
                    </div> -->

                    <h1 class="hero-title">
                        Think Digital. <br class="hidden-mobile">
                        <span class="text-gradient">Grow Smarter.</span>
                    </h1>

                    <p class="hero-subtitle">
                        From Stunning Websites to Smart Software, strategy to results - we take care of your business with Ai Based Digital Marketing.
                    </p>

                    <div class="hero-actions">
                        <a href="tel:1930" class="btn-header-enquiry hero-quote-btn" id="hero-emergency-btn">
                            Get A Free Quote <span class="btn-icon">&rarr;</span>
                        </a>
                        <a href="<?= base_url('about') ?>" class="btn btn-outline btn-lg" id="hero-explore-btn">
                            Learn More
                        </a>
                    </div>

                    <div class="hero-trust-badges" aria-label="Trust badges">
                        <img class="hero-trust-badge" src="<?= asset('images/logo/facebook-partner.svg') ?>" alt="Facebook" />
                        <img class="hero-trust-badge" src="<?= asset('images/logo/google-addwords-partner.svg') ?>" alt="Google Ads" />
                        <img class="hero-trust-badge" src="<?= asset('images/logo/google-partner.svg') ?>" alt="Google Partners" />
                        <img class="hero-trust-badge" src="<?= asset('images/logo/msme.jpg') ?>" alt="MSME" />
                    </div>
                </div>
            </div>

            <div class="hero-visual cyber-glow-border" aria-label="Cyber safety slideshow">
                <svg class="cyber-glow-border-svg" viewBox="0 0 560 440" preserveAspectRatio="none" aria-hidden="true">
                    <defs>
                        <linearGradient id="cyberScanGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#7dd3fc"/>
                            <stop offset="35%" stop-color="#38bdf8"/>
                            <stop offset="70%" stop-color="#60a5fa"/>
                            <stop offset="100%" stop-color="#c084fc"/>
                        </linearGradient>
                        <filter id="cyberScanGlow" x="-50%" y="-50%" width="200%" height="200%">
                            <feGaussianBlur stdDeviation="2.8" result="blur"/>
                            <feMerge>
                                <feMergeNode in="blur"/>
                                <feMergeNode in="SourceGraphic"/>
                            </feMerge>
                        </filter>
                    </defs>
                    <rect class="scan-track" x="1" y="1" width="558" height="438" rx="28" />
                    <rect class="scan-signal" x="1" y="1" width="558" height="438" rx="28" />
                </svg>
                <div class="hero-slider">
                    <div class="hero-slide">
                        <img src="<?= asset('images/logo/Hero-image-1.jpg') ?>" alt="Cyber safety awareness campaign" />
                    </div>
                    <div class="hero-slide">
                        <img src="<?= asset('images/logo/Hero-image-2.jpg') ?>" alt="Reporting cyber crimes and scams" />
                    </div>
                    <div class="hero-slide">
                        <img src="<?= asset('images/logo/Hero-image-3.jpg') ?>" alt="Cybersecurity guidance and protection" />
                    </div>
                    <div class="hero-slide">
                        <img src="<?= asset('images/logo/Hero-image-1.jpg') ?>" alt="Cyber safety awareness campaign repeat" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Metric Badges -->
        
    </div>
</section>

<!-- =========================================================================
     Introduction & Threat Awareness Section
     ========================================================================= -->
<section class="section intro-section">
    <div class="container">
        <div class="section-header text-center">
            <span class="badge badge-subtle">Awareness & Action</span>
            <h2 class="section-title">Why Fast Action Matters</h2>
            <p class="section-lead max-w-700 mx-auto">
                Cyber crimes in India — from UPI fraud and fake job offers to SIM swapping — rely on urgency and deception. Understanding the right steps within the first hour drastically improves recovery rates.
            </p>
        </div>

        <?php if (!empty($quickGuides)): ?>
            <div class="card-grid">
                <?php foreach ($quickGuides as $guide): ?>
                    <article class="feature-card">
                        <div class="card-badge-wrap">
                            <span class="badge badge-secondary"><?= e($guide['badge']) ?></span>
                        </div>
                        <h3 class="card-title"><?= e($guide['title']) ?></h3>
                        <p class="card-desc"><?= e($guide['desc']) ?></p>
                        <div class="card-action">
                            <a href="<?= base_url('about') ?>" class="card-link">
                                Read guidance <span class="arrow">&rarr;</span>
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- =========================================================================
     Call-to-Action Section
     ========================================================================= -->
<section class="section cta-section">
    <div class="container">
        <div class="cta-banner">
            <div class="cta-content">
                <h2 class="cta-title">Facing an Ongoing Scam or Financial Loss?</h2>
                <p class="cta-text">
                    Act in the <strong>"Golden Hour"</strong>. Dial 1930 immediately to freeze financial transactions across banks and payment intermediaries, then file an official report at cybercrime.gov.in.
                </p>
            </div>
            <div class="cta-buttons">
                <a href="tel:1930" class="btn btn-emergency btn-lg">
                    Dial 1930
                </a>
                <a href="https://cybercrime.gov.in" target="_blank" rel="noopener noreferrer" class="btn btn-secondary btn-lg">
                    Official Portal &nearr;
                </a>
            </div>
        </div>
    </div>
</section>

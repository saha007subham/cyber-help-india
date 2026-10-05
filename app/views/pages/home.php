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
                <div class="hero-badge-wrap">
                    <span class="badge badge-accent">
                        <span class="badge-dot"></span> Citizen Cybersecurity Initiative
                    </span>
                </div>

                <h1 class="hero-title">
                    Defend Your Digital Life. <br class="hidden-mobile">
                    <span class="text-gradient">Report Cyber Threats Rapidly.</span>
                </h1>

                <p class="hero-subtitle">
                    An open guidance platform built to empower Indian citizens, students, and organizations with proactive cyber defense, scam detection, and rapid recovery steps.
                </p>

                <div class="hero-actions">
                    <a href="tel:1930" class="btn btn-emergency btn-lg" id="hero-emergency-btn">
                        <span class="btn-icon">&#128222;</span> Call 1930 (Helpline)
                    </a>
                    <a href="<?= base_url('about') ?>" class="btn btn-outline btn-lg" id="hero-explore-btn">
                        Explore Guidance &rarr;
                    </a>
                </div>
            </div>

            <div class="hero-visual" aria-label="Cyber safety slideshow">
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
        <?php if (!empty($stats)): ?>
            <div class="hero-stats-grid">
                <?php foreach ($stats as $stat): ?>
                    <div class="stat-card">
                        <span class="stat-value"><?= e($stat['value']) ?></span>
                        <span class="stat-label"><?= e($stat['label']) ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
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

<?php
/**
 * Footer Layout Template
 * 
 * Reusable footer and document scripts.
 */
declare(strict_types=1);
?>
    <footer class="site-footer">
        <div class="container footer-container">
            <div class="footer-brand">
                <div class="footer-logo">
                    <span class="logo-shield">&#128737;&#65039;</span>
                    <span class="logo-text">Cyber Help <strong>India</strong></span>
                </div>
                <p class="footer-tagline">
                    An independent, public digital safety awareness initiative designed to help Indian citizens detect scams, report crimes, and protect their privacy.
                </p>
                <div class="helpline-badge">
                    <span class="helpline-label">National Cybercrime Helpline:</span>
                    <a href="tel:1930" class="helpline-number">Call 1930</a>
                </div>
            </div>

            <div class="footer-links-group">
                <h4 class="footer-heading">Navigation</h4>
                <ul class="footer-links">
                    <li><a href="<?= base_url() ?>">Home</a></li>
                    <li><a href="<?= base_url('about') ?>">About Initiative</a></li>
                    <li><a href="<?= base_url('contact') ?>">Contact & Support</a></li>
                </ul>
            </div>

            <div class="footer-links-group">
                <h4 class="footer-heading">Emergency Links</h4>
                <ul class="footer-links">
                    <li><a href="https://cybercrime.gov.in" target="_blank" rel="noopener noreferrer">cybercrime.gov.in &nearr;</a></li>
                    <li><a href="https://sancharsaathi.gov.in" target="_blank" rel="noopener noreferrer">Sanchar Saathi Portal &nearr;</a></li>
                    <li><a href="https://www.rbi.org.in" target="_blank" rel="noopener noreferrer">RBI Fraud Helpline &nearr;</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container footer-bottom-content">
                <p>&copy; <?= date('Y') ?> <?= e(config('app.name', 'Cyber Help India')) ?>. All rights reserved.</p>
                <p class="footer-disclaimer">This portal provides educational & guidance resources for digital safety awareness.</p>
            </div>
        </div>
    </footer>
</div><!-- /.site-wrapper -->

<!-- Main Client-Side JavaScript -->
<script src="<?= asset('js/main.js') ?>" defer></script>
</body>
</html>

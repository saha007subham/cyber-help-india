<?php
/**
 * 404 Not Found View
 */
?>
<section class="section section-error">
    <div class="container text-center">
        <div class="error-code">404</div>
        <h1 class="page-title">Page Not Found</h1>
        <p class="section-lead max-w-600 mx-auto">
            The page you requested <code class="code-pill"><?= e($requestedPath ?? '') ?></code> could not be found or may have moved.
        </p>

        <div class="mt-4">
            <a href="<?= base_url() ?>" class="btn btn-primary">
                &larr; Back to Homepage
            </a>
        </div>
    </div>
</section>

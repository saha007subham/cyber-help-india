<?php
/**
 * Placeholder Page View
 * Used for pages under construction (e.g., About, Contact).
 */
?>
<section class="section section-placeholder">
    <div class="container text-center">
        <span class="badge badge-accent mb-3"><?= e($badge ?? 'Under Construction') ?></span>
        <h1 class="page-title"><?= e($title ?? 'Coming Soon') ?></h1>
        <p class="section-lead max-w-600 mx-auto">
            <?= e($subtitle ?? 'This section is being built as part of our modular rollout plan.') ?>
        </p>

        <div class="mt-4">
            <a href="<?= base_url() ?>" class="btn btn-primary">
                &larr; Return to Homepage
            </a>
        </div>
    </div>
</section>

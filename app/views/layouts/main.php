<?php
/**
 * Main Application Layout
 * 
 * Combines header, navbar, dynamic view content, and footer.
 */
declare(strict_types=1);

// Include standard header
require_once __DIR__ . '/header.php';

// Include navbar component
require_once __DIR__ . '/../components/navbar.php';
?>

<main id="main-content" class="site-main">
    <?= $content ?? '' ?>
</main>

<?php
// Include standard footer
require_once __DIR__ . '/footer.php';
?>

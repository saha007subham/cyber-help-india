<?php
/**
 * Pagination Component
 * 
 * Reusable accessible pagination control.
 * 
 * Usage:
 * component('pagination', ['currentPage' => 1, 'totalPages' => 5, 'baseUrl' => '/blog?page=']);
 */
declare(strict_types=1);

$currentPage = (int)($currentPage ?? 1);
$totalPages  = (int)($totalPages ?? 1);
$baseUrl     = $baseUrl ?? '?page=';

if ($totalPages <= 1) {
    return;
}
?>
<nav class="pagination-wrapper" aria-label="Page navigation">
    <ul class="pagination-list">
        <!-- Previous Page Link -->
        <li class="page-item <?= $currentPage <= 1 ? 'disabled' : '' ?>">
            <?php if ($currentPage > 1): ?>
                <a href="<?= e($baseUrl) . ($currentPage - 1) ?>" class="page-link" aria-label="Previous">
                    &laquo; Prev
                </a>
            <?php else: ?>
                <span class="page-link">&laquo; Prev</span>
            <?php endif; ?>
        </li>

        <!-- Numbered Page Links -->
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?= $i === $currentPage ? 'active' : '' ?>">
                <?php if ($i === $currentPage): ?>
                    <span class="page-link" aria-current="page"><?= $i ?></span>
                <?php else: ?>
                    <a href="<?= e($baseUrl) . $i ?>" class="page-link"><?= $i ?></a>
                <?php endif; ?>
            </li>
        <?php endfor; ?>

        <!-- Next Page Link -->
        <li class="page-item <?= $currentPage >= $totalPages ? 'disabled' : '' ?>">
            <?php if ($currentPage < $totalPages): ?>
                <a href="<?= e($baseUrl) . ($currentPage + 1) ?>" class="page-link" aria-label="Next">
                    Next &raquo;
                </a>
            <?php else: ?>
                <span class="page-link">Next &raquo;</span>
            <?php endif; ?>
        </li>
    </ul>
</nav>

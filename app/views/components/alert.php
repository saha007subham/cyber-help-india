<?php
/**
 * Alert Component
 * 
 * Reusable notification banner for success, warning, error, or info messages.
 * 
 * Usage:
 * component('alert', ['type' => 'success', 'message' => 'Profile updated successfully!']);
 */
declare(strict_types=1);

$type = $type ?? 'info';
$message = $message ?? '';
$dismissible = $dismissible ?? true;
$id = $id ?? 'alert-' . bin2hex(random_bytes(4));

$icon = match($type) {
    'success' => '&#10004;&#65039;',
    'error', 'danger' => '&#10060;',
    'warning' => '&#9888;&#65039;',
    default   => '&#8505;&#65039;',
};
?>
<div id="<?= e($id) ?>" class="alert alert-<?= e($type) ?>" role="alert">
    <div class="alert-content">
        <span class="alert-icon"><?= $icon ?></span>
        <div class="alert-message"><?= e($message) ?></div>
    </div>
    <?php if ($dismissible): ?>
        <button type="button" class="alert-close" aria-label="Dismiss alert" onclick="this.closest('.alert').remove();">
            &times;
        </button>
    <?php endif; ?>
</div>

<?php
/**
 * Button Component
 * 
 * Reusable button or anchor styled as a button.
 * 
 * Usage:
 * component('button', ['text' => 'Submit', 'variant' => 'primary', 'type' => 'submit']);
 * component('button', ['text' => 'Read More', 'href' => '/about', 'variant' => 'outline']);
 */
declare(strict_types=1);

$text = $text ?? 'Click Here';
$href = $href ?? null;
$variant = $variant ?? 'primary';
$size = $size ?? 'md';
$type = $type ?? 'button';
$id = !empty($id) ? 'id="' . e($id) . '"' : '';
$extraClass = $class ?? '';

$classNames = "btn btn-{$variant} btn-{$size} {$extraClass}";
?>
<?php if ($href !== null): ?>
    <a href="<?= e($href) ?>" <?= $id ?> class="<?= trim($classNames) ?>">
        <?= e($text) ?>
    </a>
<?php else: ?>
    <button type="<?= e($type) ?>" <?= $id ?> class="<?= trim($classNames) ?>">
        <?= e($text) ?>
    </button>
<?php endif; ?>

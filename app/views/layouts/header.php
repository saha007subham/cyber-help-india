<?php
/**
 * Header Layout Template
 * 
 * Reusable HTML <head> and document prelude.
 */
declare(strict_types=1);

$siteTitle = config('app.name', 'Cyber Help India');
$title = !empty($pageTitle) ? "{$pageTitle}" : "{$siteTitle} — Digital Safety & Citizen Support";
$desc  = $metaDescription ?? 'Practical cyber safety guidance, scam reporting assistance, and immediate digital defense resources.';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="<?= e($desc) ?>">
    <meta name="theme-color" content="#0d1527">

    <title><?= e($title) ?></title>

    <!-- Google Fonts: Inter, Outfit & Caveat -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@600;700&family=Inter:wght@400;500;600;700&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Core Stylesheets -->
    <link rel="stylesheet" href="<?= asset('css/style.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/responsive.css') ?>">
</head>
<body>
<div class="site-wrapper">

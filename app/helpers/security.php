<?php
/**
 * Security Helper Functions
 * 
 * Provides defense-in-depth utilities including XSS escaping, CSRF protection,
 * secure session initialization, and HTTP security headers.
 */

declare(strict_types=1);

/**
 * Escapes HTML entities for secure output (XSS defense).
 *
 * @param mixed $value Value to escape.
 * @return string Safe HTML string.
 */
function e(mixed $value): string {
    return htmlspecialchars((string)($value ?? ''), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/**
 * Starts a hardened PHP session with secure cookie attributes.
 *
 * @return void
 */
function start_secure_session(): void {
    if (session_status() === PHP_SESSION_NONE) {
        $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
            || (!empty($_SERVER['SERVER_PORT']) && (int)$_SERVER['SERVER_PORT'] === 443)
            || (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');

        session_set_cookie_params([
            'lifetime' => 0,            // Session cookie expires when browser closes
            'path'     => '/',
            'domain'   => '',
            'secure'   => $isHttps,     // True over HTTPS
            'httponly' => true,         // Prevent JavaScript access to cookie
            'samesite' => 'Lax'         // CSRF protection for cross-site requests
        ]);

        ini_set('session.use_only_cookies', '1');
        ini_set('session.use_strict_mode', '1');

        session_start();
    }
}

/**
 * Generates or retrieves the active CSRF token for the current session.
 *
 * @return string 64-character hexadecimal CSRF token.
 */
function csrf_token(): string {
    start_secure_session();

    if (empty($_SESSION['_csrf_token'])) {
        $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['_csrf_token'];
}

/**
 * Generates a hidden HTML input tag containing the CSRF token.
 *
 * @return string HTML input element.
 */
function csrf_field(): string {
    $token = e(csrf_token());
    return '<input type="hidden" name="csrf_token" value="' . $token . '">';
}

/**
 * Verifies the provided CSRF token against the stored session token.
 *
 * @param string|null $token Submitted token, or null to read from $_POST / headers.
 * @return bool True if valid, false otherwise.
 */
function verify_csrf_token(?string $token = null): bool {
    start_secure_session();

    if ($token === null) {
        $token = $_POST['csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
    }

    if (empty($_SESSION['_csrf_token']) || empty($token)) {
        return false;
    }

    return hash_equals($_SESSION['_csrf_token'], $token);
}

/**
 * Sends recommended HTTP security headers.
 *
 * @return void
 */
function send_security_headers(): void {
    if (headers_sent()) {
        return;
    }

    // Prevent MIME type sniffing
    header('X-Content-Type-Options: nosniff');

    // Protect against clickjacking
    header('X-Frame-Options: SAMEORIGIN');

    // Enable browser XSS filter protection
    header('X-XSS-Protection: 1; mode=block');

    // Control referrer information sent with requests
    header('Referrer-Policy: strict-origin-when-cross-origin');

    // Restrict unnecessary browser features
    header('Permissions-Policy: camera=(), microphone=(), geolocation=()');
}

/**
 * Sanitizes generic user text input.
 *
 * @param string $input Raw string.
 * @return string Stripped clean string.
 */
function sanitize_string(string $input): string {
    return trim(strip_tags($input));
}

<?php
/**
 * Authentication Helper Functions (Foundation)
 * 
 * Provides session-backed authentication state helpers ready for future
 * login, registration, and role-based access control.
 */

declare(strict_types=1);

/**
 * Checks if a user is currently authenticated.
 *
 * @return bool
 */
function auth_check(): bool {
    start_secure_session();
    return !empty($_SESSION['user_id']);
}

/**
 * Checks if the current visitor is a guest (not authenticated).
 *
 * @return bool
 */
function auth_guest(): bool {
    return !auth_check();
}

/**
 * Retrieves the currently authenticated user's data array, or null.
 *
 * @return array<string, mixed>|null
 */
function auth_user(): ?array {
    start_secure_session();
    return $_SESSION['user'] ?? null;
}

/**
 * Retrieves the current authenticated user's ID, or null.
 *
 * @return int|string|null
 */
function auth_id(): int|string|null {
    start_secure_session();
    return $_SESSION['user_id'] ?? null;
}

/**
 * Logs in a user by saving their identity to session and regenerating session ID.
 *
 * @param array $user User record (must include 'id').
 * @return void
 */
function auth_login(array $user): void {
    start_secure_session();
    // Prevent session fixation
    session_regenerate_id(true);

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user'] = $user;
}

/**
 * Logs out the current user and clears session state.
 *
 * @return void
 */
function auth_logout(): void {
    start_secure_session();

    $_SESSION = [];

    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params['path'],
            $params['domain'],
            $params['secure'],
            $params['httponly']
        );
    }

    session_destroy();
}

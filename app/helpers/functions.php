<?php
/**
 * Global Helper Functions
 * 
 * Provides essential utility functions used across the application,
 * including environment access, configuration retrieval, asset linking,
 * URL generation, and view rendering.
 */

declare(strict_types=1);

/**
 * Loads environment variables from a .env file into $_ENV and getenv().
 *
 * @param string $path Path to the .env file.
 * @return void
 */
function load_env(string $path): void {
    if (!file_exists($path) || !is_readable($path)) {
        return;
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);

        // Skip comments and empty lines
        if ($line === '' || str_starts_with($line, '#')) {
            continue;
        }

        // Parse KEY=VALUE
        if (strpos($line, '=') !== false) {
            [$key, $value] = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);

            // Strip surrounding quotes
            if (
                (str_starts_with($value, '"') && str_ends_with($value, '"')) ||
                (str_starts_with($value, "'") && str_ends_with($value, "'"))
            ) {
                $value = substr($value, 1, -1);
            }

            // Set in environment if not already defined
            if (!array_key_exists($key, $_ENV)) {
                putenv("{$key}={$value}");
                $_ENV[$key] = $value;
                $_SERVER[$key] = $value;
            }
        }
    }
}

/**
 * Gets the value of an environment variable with a fallback default.
 * Handles boolean and null conversions.
 *
 * @param string $key Environment key.
 * @param mixed $default Fallback value if key is not found.
 * @return mixed
 */
function env(string $key, mixed $default = null): mixed {
    $val = $_ENV[$key] ?? getenv($key);

    if ($val === false || $val === null) {
        return $default;
    }

    return match (strtolower((string)$val)) {
        'true', '(true)' => true,
        'false', '(false)' => false,
        'empty', '(empty)' => '',
        'null', '(null)' => null,
        default => $val,
    };
}

/**
 * Retrieves a configuration value using dot notation (e.g., config('app.name')).
 *
 * @param string|null $key Dot-notation key or null to get all config.
 * @param mixed $default Default value if key is missing.
 * @return mixed
 */
function config(?string $key = null, mixed $default = null): mixed {
    static $config = null;

    if ($config === null) {
        $configFile = dirname(__DIR__) . '/config/config.php';
        $config = file_exists($configFile) ? require $configFile : [];
    }

    if ($key === null) {
        return $config;
    }

    $segments = explode('.', $key);
    $data = $config;

    foreach ($segments as $segment) {
        if (!is_array($data) || !array_key_exists($segment, $data)) {
            return $default;
        }
        $data = $data[$segment];
    }

    return $data;
}

/**
 * Generates an absolute base URL for the application.
 *
 * @param string $path Optional path to append.
 * @return string
 */
function base_url(string $path = ''): string {
    $configuredUrl = config('app.url');

    // If an external non-localhost URL is explicitly set, use it
    if (!empty($configuredUrl) && !str_contains((string)$configuredUrl, 'localhost') && !str_contains((string)$configuredUrl, '127.0.0.1')) {
        $baseUrl = rtrim((string)$configuredUrl, '/');
    } elseif (!empty($_SERVER['HTTP_HOST'])) {
        $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
            || (!empty($_SERVER['SERVER_PORT']) && (int)$_SERVER['SERVER_PORT'] === 443)
            || (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');

        $scheme = $isHttps ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];
        $baseUrl = "{$scheme}://{$host}";
    } else {
        $baseUrl = rtrim((string)($configuredUrl ?: 'http://localhost:8000'), '/');
    }

    $path = ltrim($path, '/');
    return $path !== '' ? "{$baseUrl}/{$path}" : $baseUrl;
}

/**
 * Generates a public asset URL with cache-busting timestamp support.
 *
 * @param string $path Relative asset path within public/assets (e.g. 'css/style.css').
 * @return string
 */
function asset(string $path): string {
    $cleanPath = ltrim($path, '/');
    $assetUrl = base_url("assets/{$cleanPath}");

    $localFile = dirname(__DIR__, 2) . "/public/assets/{$cleanPath}";
    if (file_exists($localFile)) {
        $version = filemtime($localFile);
        $assetUrl .= "?v={$version}";
    }

    return $assetUrl;
}

/**
 * Renders a view template wrapped optionally in a layout.
 *
 * @param string $viewPath Relative path to view file in app/views (e.g., 'pages/home').
 * @param array $data Associative array of variables extracted into the view.
 * @param string|null $layout Layout name in app/views/layouts (default 'main'), or null for raw view.
 * @return void
 */
function view(string $viewPath, array $data = [], ?string $layout = 'main'): void {
    extract($data);

    $viewFile = dirname(__DIR__) . '/views/' . ltrim($viewPath, '/') . '.php';

    if (!file_exists($viewFile)) {
        throw new RuntimeException("View file not found: {$viewPath} ({$viewFile})");
    }

    // Capture the view content
    ob_start();
    require $viewFile;
    $content = ob_get_clean();

    if ($layout !== null) {
        $layoutFile = dirname(__DIR__) . "/views/layouts/{$layout}.php";
        if (!file_exists($layoutFile)) {
            throw new RuntimeException("Layout file not found: {$layout} ({$layoutFile})");
        }
        require $layoutFile;
    } else {
        echo $content;
    }
}

/**
 * Renders a reusable view component.
 *
 * @param string $componentName Component name in app/views/components (e.g., 'alert', 'button').
 * @param array $data Component variables.
 * @return void
 */
function component(string $componentName, array $data = []): void {
    extract($data);
    $componentFile = dirname(__DIR__) . '/views/components/' . ltrim($componentName, '/') . '.php';

    if (file_exists($componentFile)) {
        require $componentFile;
    } else {
        echo "<!-- Component '{$componentName}' not found -->";
    }
}

/**
 * Performs a safe HTTP redirect.
 *
 * @param string $path Internal path or absolute URL.
 * @param int $statusCode HTTP status code (301, 302, 303, etc.).
 * @return void
 */
function redirect(string $path, int $statusCode = 302): void {
    $url = filter_var($path, FILTER_VALIDATE_URL) ? $path : base_url($path);
    http_response_code($statusCode);
    header("Location: {$url}");
    exit;
}

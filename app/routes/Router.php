<?php
/**
 * Simple Lightweight Router
 * 
 * Maps HTTP requests to controller methods or closures, supporting route
 * parameters (e.g., /blog/{slug}) and standard RESTful HTTP methods.
 */

declare(strict_types=1);

namespace App\Routes;

use RuntimeException;

class Router {
    /**
     * Stored route definitions indexed by HTTP method.
     * @var array<string, array<int, array{pattern: string, regex: string, paramNames: string[], action: mixed}>>
     */
    private static array $routes = [
        'GET'    => [],
        'POST'   => [],
        'PUT'    => [],
        'PATCH'  => [],
        'DELETE' => [],
    ];

    /**
     * Registers a GET route.
     *
     * @param string $path Route URI pattern (e.g., '/services', '/blog/{slug}').
     * @param callable|array|string $action Controller action or closure.
     * @return void
     */
    public static function get(string $path, callable|array|string $action): void {
        self::addRoute('GET', $path, $action);
    }

    /**
     * Registers a POST route.
     *
     * @param string $path Route URI pattern.
     * @param callable|array|string $action Controller action or closure.
     * @return void
     */
    public static function post(string $path, callable|array|string $action): void {
        self::addRoute('POST', $path, $action);
    }

    /**
     * Registers a route matching any specified methods.
     *
     * @param array<string> $methods List of HTTP verbs.
     * @param string $path Route URI pattern.
     * @param callable|array|string $action Controller action or closure.
     * @return void
     */
    public static function match(array $methods, string $path, callable|array|string $action): void {
        foreach ($methods as $method) {
            self::addRoute(strtoupper($method), $path, $action);
        }
    }

    /**
     * Internal helper to register and compile route patterns to regex.
     *
     * @param string $method HTTP method.
     * @param string $path Route path.
     * @param mixed $action Action to invoke.
     * @return void
     */
    private static function addRoute(string $method, string $path, mixed $action): void {
        $path = '/' . trim($path, '/');
        if ($path === '//') {
            $path = '/';
        }

        // Convert {param} placeholders to named regex groups
        $paramNames = [];
        $regex = preg_replace_callback('/\{([a-zA-Z_][a-zA-Z0-9_]*)\}/', function ($matches) use (&$paramNames) {
            $paramNames[] = $matches[1];
            return '(?P<' . $matches[1] . '>[^/]+)';
        }, $path);

        $regex = '#^' . $regex . '$#';

        self::$routes[$method][] = [
            'pattern'    => $path,
            'regex'      => $regex,
            'paramNames' => $paramNames,
            'action'     => $action,
        ];
    }

    /**
     * Dispatches an incoming HTTP request to its registered route handler.
     *
     * @param string $uri The raw request URI from $_SERVER['REQUEST_URI'].
     * @param string $method The HTTP method (GET, POST, etc.).
     * @return void
     */
    public static function dispatch(string $uri, string $method): void {
        // Strip query string and sanitize URI
        $path = parse_url($uri, PHP_URL_PATH) ?? '/';
        $path = '/' . trim($path, '/');
        if ($path === '//') {
            $path = '/';
        }

        $method = strtoupper($method);

        // Check for method override (e.g. _method input in forms)
        if ($method === 'POST' && isset($_POST['_method'])) {
            $overrideMethod = strtoupper((string)$_POST['_method']);
            if (in_array($overrideMethod, ['PUT', 'PATCH', 'DELETE'], true)) {
                $method = $overrideMethod;
            }
        }

        $routesForMethod = self::$routes[$method] ?? [];

        foreach ($routesForMethod as $route) {
            if (preg_match($route['regex'], $path, $matches)) {
                // Extract named parameter values
                $params = [];
                foreach ($route['paramNames'] as $name) {
                    if (isset($matches[$name])) {
                        $params[$name] = $matches[$name];
                    }
                }

                self::executeAction($route['action'], $params);
                return;
            }
        }

        // No route matched: Render 404
        self::handleNotFound($path);
    }

    /**
     * Executes the controller action or closure with parameters.
     *
     * @param mixed $action Action definition.
     * @param array $params Route parameters.
     * @return void
     */
    private static function executeAction(mixed $action, array $params): void {
        // 1. Closure or anonymous function
        if (is_callable($action)) {
            call_user_func_array($action, array_values($params));
            return;
        }

        // 2. [ControllerClass, 'method'] array
        if (is_array($action) && count($action) === 2) {
            [$class, $method] = $action;
            if (!class_exists($class)) {
                throw new RuntimeException("Controller class '{$class}' not found.");
            }
            $controller = new $class();
            if (!method_exists($controller, $method)) {
                throw new RuntimeException("Method '{$method}' not found in controller '{$class}'.");
            }
            call_user_func_array([$controller, $method], array_values($params));
            return;
        }

        // 3. 'Controller@method' string
        if (is_string($action) && str_contains($action, '@')) {
            [$class, $method] = explode('@', $action, 2);
            if (!str_contains($class, '\\')) {
                $class = "App\\Controllers\\{$class}";
            }
            if (!class_exists($class)) {
                throw new RuntimeException("Controller class '{$class}' not found.");
            }
            $controller = new $class();
            if (!method_exists($controller, $method)) {
                throw new RuntimeException("Method '{$method}' not found in controller '{$class}'.");
            }
            call_user_func_array([$controller, $method], array_values($params));
            return;
        }

        throw new RuntimeException("Invalid route action specified.");
    }

    /**
     * Handles 404 Not Found response.
     *
     * @param string $path The requested path.
     * @return void
     */
    private static function handleNotFound(string $path): void {
        http_response_code(404);
        $notFoundView = dirname(__DIR__) . '/views/errors/404.php';

        if (file_exists($notFoundView)) {
            view('errors/404', [
                'pageTitle' => '404 - Page Not Found',
                'requestedPath' => $path
            ]);
        } else {
            echo "<h1>404 Not Found</h1><p>The page at " . htmlspecialchars($path) . " was not found.</p>";
        }
    }
}

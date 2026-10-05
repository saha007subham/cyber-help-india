<?php
/**
 * Base Controller
 * 
 * Abstract controller class providing common methods for rendering views,
 * returning JSON responses, and performing redirects.
 */

declare(strict_types=1);

namespace App\Controllers;

abstract class Controller {
    /**
     * Renders a view template.
     *
     * @param string $path View path (e.g. 'pages/home').
     * @param array $data Data array passed to view.
     * @param string|null $layout Layout file name (default 'main').
     * @return void
     */
    protected function view(string $path, array $data = [], ?string $layout = 'main'): void {
        view($path, $data, $layout);
    }

    /**
     * Sends a JSON response with status code and headers.
     *
     * @param mixed $data Data to encode as JSON.
     * @param int $statusCode HTTP response status.
     * @return void
     */
    protected function json(mixed $data, int $statusCode = 200): void {
        http_response_code($statusCode);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        exit;
    }

    /**
     * Redirects to another path or URL.
     *
     * @param string $path Target path or URL.
     * @param int $statusCode HTTP status code.
     * @return void
     */
    protected function redirect(string $path, int $statusCode = 302): void {
        redirect($path, $statusCode);
    }
}

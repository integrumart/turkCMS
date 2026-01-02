<?php

declare(strict_types=1);

namespace turkCMS\core;

/**
 * Router
 * Regex-based router supporting GET and POST methods
 */
class Router
{
    private array $routes = [
        'GET' => [],
        'POST' => []
    ];

    /**
     * Register a GET route
     */
    public function get(string $pattern, callable $handler): void
    {
        $this->addRoute('GET', $pattern, $handler);
    }

    /**
     * Register a POST route
     */
    public function post(string $pattern, callable $handler): void
    {
        $this->addRoute('POST', $pattern, $handler);
    }

    /**
     * Add a route for a specific method
     */
    private function addRoute(string $method, string $pattern, callable $handler): void
    {
        $this->routes[$method][] = [
            'pattern' => $pattern,
            'handler' => $handler
        ];
    }

    /**
     * Dispatch the current request
     */
    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);

        // Remove trailing slash except for root
        if ($uri !== '/' && substr($uri, -1) === '/') {
            $uri = rtrim($uri, '/');
        }

        // Try to match routes for the current method
        if (isset($this->routes[$method])) {
            foreach ($this->routes[$method] as $route) {
                if ($this->matchRoute($route['pattern'], $uri, $matches)) {
                    // Remove the full match from matches array
                    array_shift($matches);
                    call_user_func_array($route['handler'], $matches);
                    return;
                }
            }
        }

        // No route matched - 404
        $this->notFound();
    }

    /**
     * Match a route pattern against URI
     */
    private function matchRoute(string $pattern, string $uri, ?array &$matches = null): bool
    {
        // Convert route pattern to regex
        $regex = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([^/]+)', $pattern);
        $regex = '#^' . $regex . '$#';

        return (bool) preg_match($regex, $uri, $matches);
    }

    /**
     * Handle 404 Not Found
     */
    private function notFound(): void
    {
        http_response_code(404);
        echo '<h1>404 - Page Not Found</h1>';
        exit;
    }
}

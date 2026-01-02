<?php

declare(strict_types=1);

namespace turkCMS\core;

class Router
{
    private array $routes = [];

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
     * Add a route with method and pattern
     */
    private function addRoute(string $method, string $pattern, callable $handler): void
    {
        $this->routes[] = [
            'method' => $method,
            'pattern' => $pattern,
            'handler' => $handler,
        ];
    }

    /**
     * Dispatch the request to matching route
     */
    public function dispatch(string $method, string $uri): void
    {
        // Remove query string
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }

        $uri = rawurldecode($uri);
        $uri = '/' . trim($uri, '/');

        foreach ($this->routes as $route) {
            if ($route['method'] !== $method) {
                continue;
            }

            // Convert route pattern to regex
            $pattern = $this->convertPatternToRegex($route['pattern']);

            if (preg_match($pattern, $uri, $matches)) {
                // Remove full match from matches
                array_shift($matches);
                
                // Call handler with matched parameters
                call_user_func_array($route['handler'], $matches);
                return;
            }
        }

        // No route matched - 404
        http_response_code(404);
        echo "404 - Page Not Found";
    }

    /**
     * Convert route pattern to regex
     */
    private function convertPatternToRegex(string $pattern): string
    {
        // Escape forward slashes
        $pattern = str_replace('/', '\/', $pattern);
        
        // Convert :param to named capture groups
        $pattern = preg_replace('/\:([a-zA-Z0-9_]+)/', '([^\/]+)', $pattern);
        
        return '/^' . $pattern . '$/';
    }
}

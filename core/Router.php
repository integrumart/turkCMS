<?php

declare(strict_types=1);

namespace turkCMS\core;

/**
 * Router
 * 
 * Regex-based router supporting GET/POST requests
 */
class Router
{
    private array $routes = [
        'GET' => [],
        'POST' => []
    ];

    /**
     * Register a GET route
     *
     * @param string $pattern URL pattern (regex)
     * @param callable $callback Callback function
     * @return void
     */
    public function get(string $pattern, callable $callback): void
    {
        $this->routes['GET'][$pattern] = $callback;
    }

    /**
     * Register a POST route
     *
     * @param string $pattern URL pattern (regex)
     * @param callable $callback Callback function
     * @return void
     */
    public function post(string $pattern, callable $callback): void
    {
        $this->routes['POST'][$pattern] = $callback;
    }

    /**
     * Dispatch the current request
     *
     * @return void
     */
    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        // Remove leading slash for matching
        $uri = trim($uri, '/');

        if (!isset($this->routes[$method])) {
            $this->handleNotFound();
            return;
        }

        foreach ($this->routes[$method] as $pattern => $callback) {
            if (preg_match($pattern, $uri, $matches)) {
                // Remove the full match from matches
                array_shift($matches);
                call_user_func_array($callback, $matches);
                return;
            }
        }

        $this->handleNotFound();
    }

    /**
     * Handle 404 Not Found
     *
     * @return void
     */
    private function handleNotFound(): void
    {
        http_response_code(404);
        echo "<h1>404 - Page Not Found</h1>";
    }
}

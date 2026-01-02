<?php

declare(strict_types=1);

namespace turkCMS\core;

/**
 * Router
 * 
 * Regex-based router supporting GET and POST methods.
 */
class Router
{
    /**
     * @var array<string, array<string, callable>> Registered routes
     */
    private array $routes = [
        'GET' => [],
        'POST' => []
    ];

    /**
     * Register a GET route
     * 
     * @param string $pattern URL pattern (regex)
     * @param callable $callback Callback function to execute
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
     * @param callable $callback Callback function to execute
     * @return void
     */
    public function post(string $pattern, callable $callback): void
    {
        $this->routes['POST'][$pattern] = $callback;
    }

    /**
     * Dispatch the request to the appropriate route
     * 
     * @return void
     */
    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $uri = $this->getUri();

        if (!isset($this->routes[$method])) {
            $this->notFound();
            return;
        }

        foreach ($this->routes[$method] as $pattern => $callback) {
            if (preg_match($pattern, $uri, $matches)) {
                // Remove the full match from the matches array
                array_shift($matches);
                
                // Call the callback with matched parameters
                call_user_func_array($callback, $matches);
                return;
            }
        }

        $this->notFound();
    }

    /**
     * Get the request URI
     * 
     * @return string Cleaned URI path
     */
    private function getUri(): string
    {
        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        
        // Remove query string
        if (($pos = strpos($uri, '?')) !== false) {
            $uri = substr($uri, 0, $pos);
        }

        // Remove trailing slash (except for root)
        if ($uri !== '/' && substr($uri, -1) === '/') {
            $uri = substr($uri, 0, -1);
        }

        return $uri;
    }

    /**
     * Handle 404 Not Found
     * 
     * @return void
     */
    private function notFound(): void
    {
        http_response_code(404);
        echo '<h1>404 - Sayfa Bulunamadı</h1>';
        echo '<p>Aradığınız sayfa mevcut değil.</p>';
    }
}

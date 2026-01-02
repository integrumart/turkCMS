<?php

declare(strict_types=1);

namespace turkCMS\core;

use turkCMS\app\Controllers\FrontController;
use turkCMS\app\Controllers\AdminController;

/**
 * Bootstrap
 * 
 * Initializes the application and registers routes
 */
class Bootstrap
{
    private Router $router;

    /**
     * Constructor
     */
    public function __construct()
    {
        // Initialize storage
        Storage::init();

        // Create router instance
        $this->router = new Router();

        // Register routes
        $this->registerRoutes();
    }

    /**
     * Register application routes
     *
     * @return void
     */
    private function registerRoutes(): void
    {
        $frontController = new FrontController();
        $adminController = new AdminController();

        // Homepage
        $this->router->get('/^$/', [$frontController, 'home']);

        // Admin routes
        $this->router->get('/^admin$/', [$adminController, 'dashboard']);
        $this->router->get('/^admin\/login$/', [$adminController, 'login']);
        $this->router->post('/^admin\/login$/', [$adminController, 'handleLogin']);

        // Generic page route (catch-all)
        $this->router->get('/^(.+)$/', [$frontController, 'page']);
    }

    /**
     * Run the application
     *
     * @return void
     */
    public function run(): void
    {
        try {
            $this->router->dispatch();
        } catch (\Exception $e) {
            $this->handleError($e);
        }
    }

    /**
     * Handle application errors
     *
     * @param \Exception $e Exception
     * @return void
     */
    private function handleError(\Exception $e): void
    {
        http_response_code(500);
        echo "<h1>Application Error</h1>";
        echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
        
        if (Config::get('site.debug', false)) {
            echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
        }
    }
}

<?php

declare(strict_types=1);

namespace turkCMS\core;

use turkCMS\app\Controllers\FrontController;
use turkCMS\app\Controllers\AdminController;

class Bootstrap
{
    private Router $router;

    public function __construct()
    {
        $this->router = new Router();
    }

    /**
     * Initialize the application
     */
    public function run(): void
    {
        // Register routes
        $this->registerRoutes();

        // Dispatch the request
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        $this->router->dispatch($method, $uri);
    }

    /**
     * Register application routes
     */
    private function registerRoutes(): void
    {
        $frontController = new FrontController();
        $adminController = new AdminController();

        // Frontend routes
        $this->router->get('/', [$frontController, 'home']);
        $this->router->get('/page/:slug', [$frontController, 'page']);

        // Admin routes
        $this->router->get('/admin', [$adminController, 'dashboard']);
        $this->router->get('/admin/login', [$adminController, 'login']);
        $this->router->post('/admin/login', [$adminController, 'loginPost']);
    }
}

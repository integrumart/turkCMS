<?php

declare(strict_types=1);

namespace turkCMS\core;

use turkCMS\app\Controllers\FrontController;
use turkCMS\app\Controllers\AdminController;

/**
 * Bootstrap
 * 
 * Initializes the application and registers routes.
 */
class Bootstrap
{
    /**
     * @var Router Router instance
     */
    private Router $router;

    /**
     * @var View View instance
     */
    private View $view;

    /**
     * Constructor
     */
    public function __construct()
    {
        // Initialize core components
        $this->router = new Router();
        $this->view = new View();

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
        $frontController = new FrontController($this->view);
        $adminController = new AdminController($this->view);

        // Frontend routes
        $this->router->get('#^/$#', [$frontController, 'home']);
        $this->router->get('#^/([a-z0-9-]+)$#', [$frontController, 'page']);

        // Admin routes
        $this->router->get('#^/admin$#', [$adminController, 'dashboard']);
        $this->router->get('#^/admin/login$#', [$adminController, 'login']);
        $this->router->post('#^/admin/login$#', [$adminController, 'loginPost']);
    }

    /**
     * Run the application
     * 
     * @return void
     */
    public function run(): void
    {
        // Load site configuration
        Config::load('site');

        // Dispatch the request
        $this->router->dispatch();
    }
}

<?php

declare(strict_types=1);

namespace turkCMS\core;

use turkCMS\app\Controllers\FrontController;
use turkCMS\app\Controllers\AdminController;

/**
 * Bootstrap
 * Initializes the application and registers routes
 */
class Bootstrap
{
    private Storage $storage;
    private Config $config;
    private Router $router;
    private View $view;

    public function __construct()
    {
        // Initialize core components
        $this->storage = new Storage();
        $this->config = new Config($this->storage);
        
        // Load site configuration
        $this->config->load('site');
        
        // Initialize view with theme from config
        $theme = $this->config->get('site.theme', 'default');
        $this->view = new View($this->storage, $theme);
        
        // Initialize router
        $this->router = new Router();
        
        // Register routes
        $this->registerRoutes();
    }

    /**
     * Register application routes
     */
    private function registerRoutes(): void
    {
        $frontController = new FrontController($this->storage, $this->config, $this->view);
        $adminController = new AdminController($this->storage, $this->config, $this->view);

        // Homepage
        $this->router->get('/', function () use ($frontController) {
            $frontController->home();
        });

        // Generic page route
        $this->router->get('/{slug}', function (string $slug) use ($frontController) {
            $frontController->page($slug);
        });

        // Admin routes
        $this->router->get('/admin/login', function () use ($adminController) {
            $adminController->login();
        });

        $this->router->post('/admin/login', function () use ($adminController) {
            $adminController->authenticate();
        });

        $this->router->get('/admin/dashboard', function () use ($adminController) {
            $adminController->dashboard();
        });
    }

    /**
     * Run the application
     */
    public function run(): void
    {
        $this->router->dispatch();
    }
}

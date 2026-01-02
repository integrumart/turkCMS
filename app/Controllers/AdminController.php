<?php

declare(strict_types=1);

namespace turkCMS\app\Controllers;

use turkCMS\core\View;

class AdminController
{
    private View $view;

    public function __construct()
    {
        $this->view = new View();
    }

    /**
     * Display admin dashboard
     */
    public function dashboard(): void
    {
        echo "Admin Dashboard - Coming Soon";
    }

    /**
     * Display login page
     */
    public function login(): void
    {
        echo "Admin Login - Coming Soon";
    }

    /**
     * Process login form
     */
    public function loginPost(): void
    {
        echo "Login processing - Coming Soon";
    }
}

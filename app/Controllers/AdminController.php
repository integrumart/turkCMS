<?php

declare(strict_types=1);

namespace turkCMS\app\Controllers;

use turkCMS\core\Storage;
use turkCMS\core\Config;
use turkCMS\core\View;

/**
 * Admin Controller
 * Handles admin dashboard and authentication (placeholder implementation)
 */
class AdminController
{
    private Storage $storage;
    private Config $config;
    private View $view;

    public function __construct(Storage $storage, Config $config, View $view)
    {
        $this->storage = $storage;
        $this->config = $config;
        $this->view = $view;
    }

    /**
     * Display login page
     */
    public function login(): void
    {
        echo '<h1>Admin Login</h1>';
        echo '<p>Login functionality placeholder. To be implemented.</p>';
        echo '<form method="POST" action="/admin/login">';
        echo '<input type="text" name="username" placeholder="Username" required><br><br>';
        echo '<input type="password" name="password" placeholder="Password" required><br><br>';
        echo '<button type="submit">Login</button>';
        echo '</form>';
    }

    /**
     * Authenticate admin user
     */
    public function authenticate(): void
    {
        // Placeholder for authentication logic
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        echo '<h1>Authentication</h1>';
        echo '<p>Authentication logic placeholder. To be implemented.</p>';
        echo '<p>Received username: ' . htmlspecialchars($username) . '</p>';
        echo '<a href="/admin/dashboard">Go to Dashboard</a>';
    }

    /**
     * Display admin dashboard
     */
    public function dashboard(): void
    {
        echo '<h1>Admin Dashboard</h1>';
        echo '<p>Dashboard functionality placeholder. To be implemented.</p>';
        echo '<ul>';
        echo '<li><a href="/">View Site</a></li>';
        echo '<li><a href="/admin/login">Logout</a></li>';
        echo '</ul>';
    }
}

<?php

declare(strict_types=1);

namespace turkCMS\app\Controllers;

use turkCMS\core\View;

/**
 * AdminController
 * 
 * Handles admin dashboard and login
 */
class AdminController
{
    private View $view;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->view = new View();
    }

    /**
     * Display admin dashboard
     *
     * @return void
     */
    public function dashboard(): void
    {
        echo "<h1>Admin Dashboard</h1>";
        echo "<p>Welcome to the turkCMS admin panel.</p>";
        echo "<p><a href='/admin/login'>Login</a></p>";
    }

    /**
     * Display login form
     *
     * @return void
     */
    public function login(): void
    {
        echo "<h1>Admin Login</h1>";
        echo "<form method='POST' action='/admin/login'>";
        echo "<label>Username: <input type='text' name='username' required></label><br>";
        echo "<label>Password: <input type='password' name='password' required></label><br>";
        echo "<button type='submit'>Login</button>";
        echo "</form>";
    }

    /**
     * Handle login form submission
     *
     * @return void
     */
    public function handleLogin(): void
    {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Placeholder authentication logic
        if ($username === 'admin' && $password === 'admin') {
            echo "<h1>Login Successful</h1>";
            echo "<p>Welcome back, {$this->view->escape($username)}!</p>";
        } else {
            echo "<h1>Login Failed</h1>";
            echo "<p>Invalid credentials. <a href='/admin/login'>Try again</a></p>";
        }
    }
}

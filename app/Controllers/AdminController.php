<?php

declare(strict_types=1);

namespace turkCMS\app\Controllers;

use turkCMS\core\View;
use turkCMS\core\Config;

/**
 * AdminController
 * 
 * Handles admin routes (dashboard, login).
 */
class AdminController
{
    /**
     * @var View View instance
     */
    private View $view;

    /**
     * Constructor
     * 
     * @param View $view View instance
     */
    public function __construct(View $view)
    {
        $this->view = $view;
    }

    /**
     * Display the admin dashboard
     * 
     * @return void
     */
    public function dashboard(): void
    {
        echo '<h1>Admin Dashboard</h1>';
        echo '<p>Admin paneline hoş geldiniz.</p>';
        echo '<p><a href="/admin/login">Giriş Yap</a></p>';
    }

    /**
     * Display the login page
     * 
     * @return void
     */
    public function login(): void
    {
        echo '<h1>Admin Girişi</h1>';
        echo '<form method="POST" action="/admin/login">';
        echo '<label>Kullanıcı Adı: <input type="text" name="username" required></label><br>';
        echo '<label>Şifre: <input type="password" name="password" required></label><br>';
        echo '<button type="submit">Giriş Yap</button>';
        echo '</form>';
    }

    /**
     * Handle login form submission
     * 
     * @return void
     */
    public function loginPost(): void
    {
        // This is a placeholder - actual authentication logic would go here
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if ($username === 'admin' && $password === 'admin') {
            echo '<h1>Giriş Başarılı</h1>';
            echo '<p>Hoş geldiniz, ' . htmlspecialchars($username) . '!</p>';
            echo '<p><a href="/admin">Dashboard\'a Git</a></p>';
        } else {
            echo '<h1>Giriş Başarısız</h1>';
            echo '<p>Kullanıcı adı veya şifre hatalı.</p>';
            echo '<p><a href="/admin/login">Tekrar Dene</a></p>';
        }
    }
}

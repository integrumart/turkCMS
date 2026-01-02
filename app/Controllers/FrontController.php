<?php

declare(strict_types=1);

namespace turkCMS\app\Controllers;

use turkCMS\core\View;
use turkCMS\core\Config;
use turkCMS\app\Services\ContentService;

/**
 * FrontController
 * 
 * Handles homepage and generic page routes
 */
class FrontController
{
    private View $view;
    private ContentService $contentService;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->view = new View();
        $this->contentService = new ContentService();
    }

    /**
     * Display the homepage
     *
     * @return void
     */
    public function home(): void
    {
        $page = $this->contentService->getPage('home');

        if ($page === null) {
            http_response_code(404);
            echo "<h1>Homepage not found</h1>";
            return;
        }

        $this->view->render('home', [
            'title' => $page['meta']['title'] ?? Config::get('site.title'),
            'content' => $page['html'],
            'meta' => $page['meta']
        ]);
    }

    /**
     * Display a generic page
     *
     * @param string $slug Page slug
     * @return void
     */
    public function page(string $slug): void
    {
        $page = $this->contentService->getPage($slug);

        if ($page === null) {
            http_response_code(404);
            echo "<h1>Page not found</h1>";
            echo "<p>The page '{$this->view->escape($slug)}' could not be found.</p>";
            return;
        }

        $this->view->render('page', [
            'title' => $page['meta']['title'] ?? ucfirst($slug),
            'content' => $page['html'],
            'meta' => $page['meta']
        ]);
    }
}

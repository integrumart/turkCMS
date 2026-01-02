<?php

declare(strict_types=1);

namespace turkCMS\app\Controllers;

use turkCMS\core\View;
use turkCMS\core\Config;
use turkCMS\app\Services\ContentService;

class FrontController
{
    private ContentService $contentService;
    private View $view;

    public function __construct()
    {
        $this->contentService = new ContentService();
        $this->view = new View();
    }

    /**
     * Display homepage
     */
    public function home(): void
    {
        $page = $this->contentService->getPage('home');

        if (!$page) {
            http_response_code(404);
            echo "Homepage not found";
            return;
        }

        $this->view->withData([
            'title' => $page['meta']['title'] ?? Config::get('site.title', 'Home'),
            'content' => $page['content'],
            'meta' => $page['meta'],
        ]);

        $this->view->render('home');
    }

    /**
     * Display a generic page by slug
     */
    public function page(string $slug): void
    {
        $page = $this->contentService->getPage($slug);

        if (!$page) {
            http_response_code(404);
            echo "Page not found: {$slug}";
            return;
        }

        $this->view->withData([
            'title' => $page['meta']['title'] ?? $slug,
            'content' => $page['content'],
            'meta' => $page['meta'],
        ]);

        $this->view->render('page');
    }
}

<?php

declare(strict_types=1);

namespace turkCMS\app\Controllers;

use turkCMS\core\Storage;
use turkCMS\core\Config;
use turkCMS\core\View;
use turkCMS\app\Services\ContentService;

/**
 * Front Controller
 * Handles public-facing pages (homepage and generic pages)
 */
class FrontController
{
    private Storage $storage;
    private Config $config;
    private View $view;
    private ContentService $contentService;

    public function __construct(Storage $storage, Config $config, View $view)
    {
        $this->storage = $storage;
        $this->config = $config;
        $this->view = $view;
        $this->contentService = new ContentService($storage);
    }

    /**
     * Display the homepage
     */
    public function home(): void
    {
        $page = $this->contentService->getPage('home');

        if ($page === null) {
            http_response_code(404);
            echo '<h1>404 - Homepage not found</h1>';
            return;
        }

        $data = [
            'title' => $page['frontmatter']['title'] ?? 'Home',
            'content' => $page['html'],
            'site' => [
                'title' => $this->config->get('site.title', 'turkCMS'),
                'lang' => $this->config->get('site.lang', 'tr')
            ]
        ];

        $this->view->display('home', $data);
    }

    /**
     * Display a generic page by slug
     */
    public function page(string $slug): void
    {
        $page = $this->contentService->getPage($slug);

        if ($page === null) {
            http_response_code(404);
            echo '<h1>404 - Page not found</h1>';
            return;
        }

        $data = [
            'title' => $page['frontmatter']['title'] ?? ucfirst($slug),
            'content' => $page['html'],
            'site' => [
                'title' => $this->config->get('site.title', 'turkCMS'),
                'lang' => $this->config->get('site.lang', 'tr')
            ]
        ];

        $this->view->display('page', $data);
    }
}

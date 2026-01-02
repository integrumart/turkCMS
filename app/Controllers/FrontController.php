<?php

declare(strict_types=1);

namespace turkCMS\app\Controllers;

use turkCMS\core\View;
use turkCMS\core\Config;
use turkCMS\app\Services\ContentService;

/**
 * FrontController
 * 
 * Handles frontend routes (homepage and pages).
 */
class FrontController
{
    /**
     * @var View View instance
     */
    private View $view;

    /**
     * @var ContentService Content service instance
     */
    private ContentService $contentService;

    /**
     * Constructor
     * 
     * @param View $view View instance
     */
    public function __construct(View $view)
    {
        $this->view = $view;
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
            echo '<h1>Ana sayfa bulunamadı</h1>';
            return;
        }

        $this->view->render('home', [
            'page' => $page,
            'site_title' => Config::get('site.title', 'turkCMS'),
            'site_lang' => Config::get('site.lang', 'tr')
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
            echo '<h1>404 - Sayfa Bulunamadı</h1>';
            echo '<p>Aradığınız sayfa mevcut değil.</p>';
            return;
        }

        $this->view->render('page', [
            'page' => $page,
            'site_title' => Config::get('site.title', 'turkCMS'),
            'site_lang' => Config::get('site.lang', 'tr')
        ]);
    }
}

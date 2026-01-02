<?php

declare(strict_types=1);

namespace turkCMS\core;

/**
 * View
 * 
 * Template engine to render files from themes/
 */
class View
{
    private string $theme;
    private array $data = [];

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->theme = Config::get('site.theme', 'default');
    }

    /**
     * Set data to be passed to the view
     *
     * @param array $data Data array
     * @return self
     */
    public function with(array $data): self
    {
        $this->data = array_merge($this->data, $data);
        return $this;
    }

    /**
     * Render a view template
     *
     * @param string $view View name
     * @param array $data Additional data
     * @return void
     */
    public function render(string $view, array $data = []): void
    {
        $data = array_merge($this->data, $data);
        
        $viewPath = dirname(__DIR__) . "/themes/{$this->theme}/{$view}.php";

        if (!file_exists($viewPath)) {
            throw new \RuntimeException("View not found: {$viewPath}");
        }

        extract($data);
        require $viewPath;
    }

    /**
     * Render a partial template
     *
     * @param string $partial Partial name
     * @param array $data Data to pass to partial
     * @return void
     */
    public function partial(string $partial, array $data = []): void
    {
        $data = array_merge($this->data, $data);
        
        $partialPath = dirname(__DIR__) . "/themes/{$this->theme}/partials/{$partial}.php";

        if (!file_exists($partialPath)) {
            throw new \RuntimeException("Partial not found: {$partialPath}");
        }

        extract($data);
        require $partialPath;
    }

    /**
     * Escape HTML output
     *
     * @param string $string String to escape
     * @return string
     */
    public function escape(string $string): string
    {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }
}

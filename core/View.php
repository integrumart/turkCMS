<?php

declare(strict_types=1);

namespace turkCMS\core;

class View
{
    private array $data = [];
    private string $theme;

    public function __construct()
    {
        $this->theme = Config::get('site.theme', 'default');
    }

    /**
     * Set data for the view
     */
    public function with(string $key, $value): self
    {
        $this->data[$key] = $value;
        return $this;
    }

    /**
     * Set multiple data items
     */
    public function withData(array $data): self
    {
        $this->data = array_merge($this->data, $data);
        return $this;
    }

    /**
     * Render a view file
     */
    public function render(string $view, array $data = []): void
    {
        $data = array_merge($this->data, $data);
        
        // Extract data to make variables available in view
        extract($data);

        $viewPath = Storage::themePath("{$this->theme}/{$view}.php");

        if (!file_exists($viewPath)) {
            throw new \RuntimeException("View not found: {$view}");
        }

        require $viewPath;
    }

    /**
     * Render a partial
     */
    public function partial(string $partial, array $data = []): void
    {
        $data = array_merge($this->data, $data);
        extract($data);

        $partialPath = Storage::themePath("{$this->theme}/partials/{$partial}.php");

        if (!file_exists($partialPath)) {
            throw new \RuntimeException("Partial not found: {$partial}");
        }

        require $partialPath;
    }

    /**
     * Escape output for HTML
     */
    public function e(string $string): string
    {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }
}

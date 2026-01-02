<?php

declare(strict_types=1);

namespace turkCMS\core;

/**
 * View
 * 
 * Template engine to render files from themes directory.
 */
class View
{
    /**
     * @var string Current theme name
     */
    private string $theme;

    /**
     * @var array<string, mixed> Data to pass to views
     */
    private array $data = [];

    /**
     * Constructor
     * 
     * @param string|null $theme Theme name (defaults to config value)
     */
    public function __construct(?string $theme = null)
    {
        $this->theme = $theme ?? Config::get('site.theme', 'default');
    }

    /**
     * Render a view
     * 
     * @param string $view View file name (without .php extension)
     * @param array<string, mixed> $data Data to pass to the view
     * @return void
     */
    public function render(string $view, array $data = []): void
    {
        $this->data = array_merge($this->data, $data);
        
        $viewPath = Storage::themePath($this->theme, "{$view}.php");
        
        if (!Storage::exists($viewPath)) {
            echo "View not found: {$view}";
            return;
        }

        // Extract data to make it available as variables in the view
        extract($this->data);

        // Render the view
        require $viewPath;
    }

    /**
     * Render a view and return as string
     * 
     * @param string $view View file name (without .php extension)
     * @param array<string, mixed> $data Data to pass to the view
     * @return string Rendered view content
     */
    public function renderToString(string $view, array $data = []): string
    {
        ob_start();
        $this->render($view, $data);
        return ob_get_clean();
    }

    /**
     * Render a partial
     * 
     * @param string $partial Partial file name (without .php extension)
     * @param array<string, mixed> $data Data to pass to the partial
     * @return void
     */
    public function partial(string $partial, array $data = []): void
    {
        $partialPath = Storage::themePath($this->theme, "partials/{$partial}.php");
        
        if (!Storage::exists($partialPath)) {
            echo "Partial not found: {$partial}";
            return;
        }

        // Merge data
        $data = array_merge($this->data, $data);
        
        // Extract data to make it available as variables
        extract($data);

        // Render the partial
        require $partialPath;
    }

    /**
     * Set data to be available in all views
     * 
     * @param string $key Data key
     * @param mixed $value Data value
     * @return void
     */
    public function set(string $key, mixed $value): void
    {
        $this->data[$key] = $value;
    }

    /**
     * Get the current theme name
     * 
     * @return string Theme name
     */
    public function getTheme(): string
    {
        return $this->theme;
    }
}

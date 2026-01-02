<?php

declare(strict_types=1);

namespace turkCMS\core;

/**
 * View Template Engine
 * Renders template files from themes directory
 */
class View
{
    private Storage $storage;
    private string $theme;

    public function __construct(Storage $storage, string $theme = 'default')
    {
        $this->storage = $storage;
        $this->theme = $theme;
    }

    /**
     * Render a view template
     */
    public function render(string $template, array $data = []): string
    {
        $templatePath = $this->storage->themePath($this->theme, "{$template}.php");

        if (!$this->storage->exists($templatePath)) {
            throw new \RuntimeException("Template not found: {$template}.php in theme {$this->theme}");
        }

        // Extract data to variables for use in templates
        // Safe to use here as data is controlled by the application, not user input
        extract($data, EXTR_SKIP);

        // Start output buffering
        ob_start();

        // Include the template
        include $templatePath;

        // Return the buffered content
        return ob_get_clean();
    }

    /**
     * Render and output a view template
     */
    public function display(string $template, array $data = []): void
    {
        echo $this->render($template, $data);
    }

    /**
     * Render a partial template
     */
    public function partial(string $partial, array $data = []): string
    {
        return $this->render("partials/{$partial}", $data);
    }
}

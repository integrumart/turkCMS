<?php

declare(strict_types=1);

namespace turkCMS\app\Services;

use turkCMS\core\Storage;
use Parsedown;

class ContentService
{
    private Parsedown $parsedown;

    public function __construct()
    {
        $this->parsedown = new Parsedown();
    }

    /**
     * Read and parse a markdown file
     * 
     * @return array|null Returns ['meta' => array, 'content' => string] or null if not found
     */
    public function getPage(string $slug): ?array
    {
        $path = Storage::contentPath("pages/{$slug}.md");

        if (!file_exists($path)) {
            return null;
        }

        $content = file_get_contents($path);
        
        // Parse frontmatter and content
        $parsed = $this->parseFrontmatter($content);

        // Convert markdown to HTML
        $parsed['content'] = $this->parsedown->text($parsed['content']);

        return $parsed;
    }

    /**
     * Parse YAML frontmatter from markdown content
     * 
     * @return array Returns ['meta' => array, 'content' => string]
     */
    private function parseFrontmatter(string $content): array
    {
        $meta = [];
        $body = $content;

        // Check if content starts with ---
        if (preg_match('/^---\s*\n(.*?)\n---\s*\n(.*)$/s', $content, $matches)) {
            $frontmatter = $matches[1];
            $body = $matches[2];

            // Parse simple YAML (key: value pairs)
            $lines = explode("\n", $frontmatter);
            foreach ($lines as $line) {
                $line = trim($line);
                if (empty($line) || strpos($line, ':') === false) {
                    continue;
                }

                $parts = explode(':', $line, 2);
                if (count($parts) !== 2) {
                    continue;
                }

                [$key, $value] = $parts;
                $key = trim($key);
                $value = trim($value);

                // Remove quotes if present
                if ((substr($value, 0, 1) === '"' && substr($value, -1) === '"') ||
                    (substr($value, 0, 1) === "'" && substr($value, -1) === "'")) {
                    $value = substr($value, 1, -1);
                }

                $meta[$key] = $value;
            }
        }

        return [
            'meta' => $meta,
            'content' => $body,
        ];
    }

    /**
     * Get all pages
     * 
     * @return array
     */
    public function getAllPages(): array
    {
        $pagesPath = Storage::contentPath('pages');
        $files = glob($pagesPath . '/*.md');
        $pages = [];

        foreach ($files as $file) {
            $slug = basename($file, '.md');
            $page = $this->getPage($slug);
            if ($page) {
                $page['slug'] = $slug;
                $pages[] = $page;
            }
        }

        return $pages;
    }
}

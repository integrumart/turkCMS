<?php

declare(strict_types=1);

namespace turkCMS\app\Services;

use turkCMS\core\Storage;
use Parsedown;

/**
 * ContentService
 * 
 * Logic to read .md files, parse YAML frontmatter, and render Markdown to HTML
 */
class ContentService
{
    private Parsedown $parsedown;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->parsedown = new Parsedown();
    }

    /**
     * Get a page by slug
     *
     * @param string $slug Page slug
     * @return array|null Page data or null if not found
     */
    public function getPage(string $slug): ?array
    {
        $filePath = Storage::contentPath("pages/{$slug}.md");

        if (!Storage::exists($filePath)) {
            return null;
        }

        $content = file_get_contents($filePath);
        return $this->parseContent($content);
    }

    /**
     * Parse content with frontmatter
     *
     * @param string $content Raw content
     * @return array Parsed content with metadata
     */
    private function parseContent(string $content): array
    {
        $frontmatter = [];
        $body = $content;

        // Check for YAML frontmatter
        if (preg_match('/^---\s*\n(.*?)\n---\s*\n(.*)$/s', $content, $matches)) {
            $frontmatter = $this->parseYaml($matches[1]);
            $body = $matches[2];
        }

        // Convert Markdown to HTML
        $html = $this->parsedown->text($body);

        return [
            'meta' => $frontmatter,
            'body' => $body,
            'html' => $html
        ];
    }

    /**
     * Simple YAML parser for frontmatter
     *
     * @param string $yaml YAML content
     * @return array Parsed data
     */
    private function parseYaml(string $yaml): array
    {
        $data = [];
        $lines = explode("\n", $yaml);

        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line) || strpos($line, '#') === 0) {
                continue;
            }

            if (strpos($line, ':') !== false) {
                [$key, $value] = explode(':', $line, 2);
                $key = trim($key);
                $value = trim($value);

                // Remove quotes from value
                $value = trim($value, '"\'');

                $data[$key] = $value;
            }
        }

        return $data;
    }

    /**
     * List all pages
     *
     * @return array List of page slugs
     */
    public function listPages(): array
    {
        $pagesDir = Storage::contentPath('pages');
        $pages = [];

        if (!is_dir($pagesDir)) {
            return $pages;
        }

        $files = scandir($pagesDir);
        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'md') {
                $pages[] = pathinfo($file, PATHINFO_FILENAME);
            }
        }

        return $pages;
    }
}

<?php

declare(strict_types=1);

namespace turkCMS\app\Services;

use turkCMS\core\Storage;
use Parsedown;

/**
 * Content Service
 * Handles reading and parsing markdown files with YAML frontmatter
 */
class ContentService
{
    private Storage $storage;
    private Parsedown $parsedown;

    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
        $this->parsedown = new Parsedown();
    }

    /**
     * Get page content by slug
     */
    public function getPage(string $slug): ?array
    {
        $filePath = $this->storage->contentPath("pages/{$slug}.md");

        if (!$this->storage->exists($filePath)) {
            return null;
        }

        $content = $this->storage->get($filePath);
        return $this->parseContent($content);
    }

    /**
     * Parse markdown content with YAML frontmatter
     */
    private function parseContent(string $content): array
    {
        $frontmatter = [];
        $body = $content;

        // Check for YAML frontmatter (between --- markers)
        if (preg_match('/^---\s*\n(.*?)\n---\s*\n(.*)/s', $content, $matches)) {
            $frontmatterText = $matches[1];
            $body = $matches[2];

            // Parse YAML frontmatter manually (simple key: value pairs)
            $frontmatter = $this->parseYaml($frontmatterText);
        }

        // Convert markdown to HTML
        $html = $this->parsedown->text($body);

        return [
            'frontmatter' => $frontmatter,
            'body' => $body,
            'html' => $html
        ];
    }

    /**
     * Simple YAML parser for frontmatter
     * Supports basic key: value pairs
     */
    private function parseYaml(string $yaml): array
    {
        $result = [];
        $lines = explode("\n", $yaml);

        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line) || strpos($line, '#') === 0) {
                continue;
            }

            if (strpos($line, ':') !== false) {
                list($key, $value) = explode(':', $line, 2);
                $key = trim($key);
                $value = trim($value);

                // Remove quotes if present
                if ((substr($value, 0, 1) === '"' && substr($value, -1) === '"') ||
                    (substr($value, 0, 1) === "'" && substr($value, -1) === "'")) {
                    $value = substr($value, 1, -1);
                }

                $result[$key] = $value;
            }
        }

        return $result;
    }

    /**
     * List all pages
     */
    public function listPages(): array
    {
        $pagesDir = $this->storage->contentPath('pages');
        $pages = [];

        if (!is_dir($pagesDir)) {
            return $pages;
        }

        $files = scandir($pagesDir);
        foreach ($files as $file) {
            if (substr($file, -3) === '.md') {
                $slug = substr($file, 0, -3);
                $pages[] = $slug;
            }
        }

        return $pages;
    }
}

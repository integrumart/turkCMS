<?php

declare(strict_types=1);

namespace turkCMS\app\Services;

use Parsedown;
use turkCMS\core\Storage;

/**
 * ContentService
 * 
 * Service for reading and parsing Markdown content files with YAML frontmatter.
 */
class ContentService
{
    /**
     * @var Parsedown Markdown parser instance
     */
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
     * @param string $slug Page slug (filename without extension)
     * @return array<string, mixed>|null Page data or null if not found
     */
    public function getPage(string $slug): ?array
    {
        $path = Storage::contentPath("pages/{$slug}.md");
        
        if (!Storage::exists($path)) {
            return null;
        }

        $content = Storage::read($path);
        if ($content === false) {
            return null;
        }

        return $this->parseContent($content);
    }

    /**
     * Parse content with YAML frontmatter
     * 
     * @param string $content Raw content with frontmatter
     * @return array<string, mixed> Parsed content data
     */
    private function parseContent(string $content): array
    {
        $data = [
            'title' => '',
            'description' => '',
            'author' => '',
            'date' => '',
            'meta' => [],
            'content' => '',
            'html' => ''
        ];

        // Check for YAML frontmatter (---\n...\n---)
        if (preg_match('/^---\s*\n(.*?)\n---\s*\n(.*)$/s', $content, $matches)) {
            $frontmatter = $matches[1];
            $markdown = $matches[2];

            // Parse frontmatter manually (simple key: value pairs)
            $data['meta'] = $this->parseFrontmatter($frontmatter);
            
            // Extract common fields
            $data['title'] = $data['meta']['title'] ?? '';
            $data['description'] = $data['meta']['description'] ?? '';
            $data['author'] = $data['meta']['author'] ?? '';
            $data['date'] = $data['meta']['date'] ?? '';

            $data['content'] = trim($markdown);
        } else {
            // No frontmatter, treat entire content as markdown
            $data['content'] = trim($content);
        }

        // Convert Markdown to HTML
        $data['html'] = $this->parsedown->text($data['content']);

        return $data;
    }

    /**
     * Parse YAML frontmatter (simple key: value pairs)
     * 
     * @param string $frontmatter YAML frontmatter string
     * @return array<string, string> Parsed frontmatter data
     */
    private function parseFrontmatter(string $frontmatter): array
    {
        $data = [];
        $lines = explode("\n", $frontmatter);

        foreach ($lines as $line) {
            $line = trim($line);
            
            // Skip empty lines and comments
            if (empty($line) || strpos($line, '#') === 0) {
                continue;
            }

            // Parse key: value pairs
            if (preg_match('/^([^:]+):\s*(.*)$/', $line, $matches)) {
                $key = trim($matches[1]);
                $value = trim($matches[2]);
                
                // Remove quotes if present
                $value = trim($value, '"\'');
                
                $data[$key] = $value;
            }
        }

        return $data;
    }

    /**
     * Get all pages
     * 
     * @return array<int, array<string, mixed>> Array of page data
     */
    public function getAllPages(): array
    {
        $pagesDir = Storage::contentPath('pages');
        
        if (!is_dir($pagesDir)) {
            return [];
        }

        $pages = [];
        $files = glob($pagesDir . '/*.md');

        if ($files === false) {
            return [];
        }

        foreach ($files as $file) {
            $slug = basename($file, '.md');
            $page = $this->getPage($slug);
            
            if ($page !== null) {
                $page['slug'] = $slug;
                $pages[] = $page;
            }
        }

        return $pages;
    }
}

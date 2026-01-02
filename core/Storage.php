<?php

declare(strict_types=1);

namespace turkCMS\core;

/**
 * Storage Helper
 * Provides helper methods for file paths
 */
class Storage
{
    private string $basePath;

    public function __construct(?string $basePath = null)
    {
        $this->basePath = $basePath ?? dirname(__DIR__);
    }

    public function path(string $relativePath): string
    {
        return $this->basePath . DIRECTORY_SEPARATOR . ltrim($relativePath, '/\\');
    }

    public function dataPath(string $relativePath = ''): string
    {
        return $this->path('data' . DIRECTORY_SEPARATOR . ltrim($relativePath, '/\\'));
    }

    public function contentPath(string $relativePath = ''): string
    {
        return $this->path('content' . DIRECTORY_SEPARATOR . ltrim($relativePath, '/\\'));
    }

    public function themePath(string $theme, string $relativePath = ''): string
    {
        return $this->path('themes' . DIRECTORY_SEPARATOR . $theme . DIRECTORY_SEPARATOR . ltrim($relativePath, '/\\'));
    }

    public function exists(string $path): bool
    {
        return file_exists($path);
    }

    public function get(string $path): string
    {
        if (!$this->exists($path)) {
            throw new \RuntimeException("File not found: {$path}");
        }
        return file_get_contents($path);
    }
}

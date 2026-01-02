<?php

declare(strict_types=1);

namespace turkCMS\core;

/**
 * Storage Helper
 * 
 * Provides utility methods for file path management.
 */
class Storage
{
    /**
     * Get the full path for a data file
     * 
     * @param string $path Relative path from data directory
     * @return string Full path to the file
     */
    public static function dataPath(string $path): string
    {
        return BASE_PATH . '/data/' . ltrim($path, '/');
    }

    /**
     * Get the full path for a content file
     * 
     * @param string $path Relative path from content directory
     * @return string Full path to the file
     */
    public static function contentPath(string $path): string
    {
        return BASE_PATH . '/content/' . ltrim($path, '/');
    }

    /**
     * Get the full path for a theme file
     * 
     * @param string $theme Theme name
     * @param string $path Relative path from theme directory
     * @return string Full path to the file
     */
    public static function themePath(string $theme, string $path): string
    {
        return BASE_PATH . '/themes/' . $theme . '/' . ltrim($path, '/');
    }

    /**
     * Check if a file exists
     * 
     * @param string $path Full path to the file
     * @return bool True if file exists, false otherwise
     */
    public static function exists(string $path): bool
    {
        return file_exists($path);
    }

    /**
     * Read file contents
     * 
     * @param string $path Full path to the file
     * @return string|false File contents or false on failure
     */
    public static function read(string $path): string|false
    {
        if (!self::exists($path)) {
            return false;
        }
        return file_get_contents($path);
    }
}

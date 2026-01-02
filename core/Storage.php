<?php

declare(strict_types=1);

namespace turkCMS\core;

/**
 * Storage
 * 
 * Helper for managing file paths in the CMS
 */
class Storage
{
    private static string $basePath;

    /**
     * Initialize the base path
     *
     * @return void
     */
    public static function init(): void
    {
        self::$basePath = dirname(__DIR__);
    }

    /**
     * Get the base path
     *
     * @return string
     */
    public static function basePath(): string
    {
        if (!isset(self::$basePath)) {
            self::init();
        }
        return self::$basePath;
    }

    /**
     * Get the content directory path
     *
     * @param string $path Additional path
     * @return string
     */
    public static function contentPath(string $path = ''): string
    {
        $base = self::basePath() . '/content';
        return $path ? $base . '/' . ltrim($path, '/') : $base;
    }

    /**
     * Get the data directory path
     *
     * @param string $path Additional path
     * @return string
     */
    public static function dataPath(string $path = ''): string
    {
        $base = self::basePath() . '/data';
        return $path ? $base . '/' . ltrim($path, '/') : $base;
    }

    /**
     * Get the theme directory path
     *
     * @param string $path Additional path
     * @return string
     */
    public static function themePath(string $path = ''): string
    {
        $theme = Config::get('site.theme', 'default');
        $base = self::basePath() . '/themes/' . $theme;
        return $path ? $base . '/' . ltrim($path, '/') : $base;
    }

    /**
     * Check if a file exists
     *
     * @param string $path File path
     * @return bool
     */
    public static function exists(string $path): bool
    {
        return file_exists($path);
    }
}

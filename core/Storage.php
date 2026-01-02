<?php

declare(strict_types=1);

namespace turkCMS\core;

class Storage
{
    private static ?string $basePath = null;

    /**
     * Initialize storage with base path
     */
    public static function init(string $basePath): void
    {
        self::$basePath = rtrim($basePath, '/');
    }

    /**
     * Ensure storage has been initialized
     */
    private static function ensureInitialized(): void
    {
        if (self::$basePath === null) {
            throw new \RuntimeException('Storage not initialized. Call Storage::init() first.');
        }
    }

    /**
     * Get path to data directory
     */
    public static function dataPath(string $path = ''): string
    {
        self::ensureInitialized();
        return self::$basePath . '/data/' . ltrim($path, '/');
    }

    /**
     * Get path to content directory
     */
    public static function contentPath(string $path = ''): string
    {
        self::ensureInitialized();
        return self::$basePath . '/content/' . ltrim($path, '/');
    }

    /**
     * Get path to themes directory
     */
    public static function themePath(string $path = ''): string
    {
        self::ensureInitialized();
        return self::$basePath . '/themes/' . ltrim($path, '/');
    }

    /**
     * Get base path
     */
    public static function basePath(string $path = ''): string
    {
        self::ensureInitialized();
        return self::$basePath . '/' . ltrim($path, '/');
    }
}

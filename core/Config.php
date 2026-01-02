<?php

declare(strict_types=1);

namespace turkCMS\core;

class Config
{
    private static array $cache = [];

    /**
     * Load and retrieve a configuration value using dot notation
     * 
     * @param string $key Configuration key in dot notation (e.g., 'site.title')
     * @param mixed $default Default value if key not found
     * @return mixed
     */
    public static function get(string $key, $default = null)
    {
        $parts = explode('.', $key);
        $file = array_shift($parts);

        // Load configuration file if not cached
        if (!isset(self::$cache[$file])) {
            $path = Storage::dataPath("config/{$file}.json");
            
            if (!file_exists($path)) {
                return $default;
            }

            $content = file_get_contents($path);
            self::$cache[$file] = json_decode($content, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                return $default;
            }
        }

        // Navigate through the array using remaining parts
        $value = self::$cache[$file];
        foreach ($parts as $part) {
            if (!is_array($value) || !isset($value[$part])) {
                return $default;
            }
            $value = $value[$part];
        }

        return $value;
    }

    /**
     * Clear configuration cache
     */
    public static function clearCache(): void
    {
        self::$cache = [];
    }
}

<?php

declare(strict_types=1);

namespace turkCMS\core;

/**
 * Config Helper
 * 
 * Loads and retrieves configuration values from JSON files using dot-notation.
 */
class Config
{
    /**
     * @var array<string, mixed> Cached configuration data
     */
    private static array $config = [];

    /**
     * Load a configuration file
     * 
     * @param string $name Configuration file name (without .json extension)
     * @return void
     */
    public static function load(string $name): void
    {
        $path = Storage::dataPath("config/{$name}.json");
        
        if (!Storage::exists($path)) {
            return;
        }

        $content = Storage::read($path);
        if ($content === false) {
            return;
        }

        $data = json_decode($content, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return;
        }

        self::$config[$name] = $data;
    }

    /**
     * Get a configuration value using dot-notation
     * 
     * @param string $key Configuration key (e.g., 'site.title')
     * @param mixed $default Default value if key doesn't exist
     * @return mixed Configuration value or default
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        $parts = explode('.', $key);
        $file = array_shift($parts);

        // Load the config file if not already loaded
        if (!isset(self::$config[$file])) {
            self::load($file);
        }

        // If file doesn't exist, return default
        if (!isset(self::$config[$file])) {
            return $default;
        }

        // Navigate through the array using dot-notation
        $value = self::$config[$file];
        foreach ($parts as $part) {
            if (!is_array($value) || !isset($value[$part])) {
                return $default;
            }
            $value = $value[$part];
        }

        return $value;
    }

    /**
     * Get all configuration data for a file
     * 
     * @param string $name Configuration file name
     * @return array<string, mixed> Configuration data
     */
    public static function all(string $name): array
    {
        if (!isset(self::$config[$name])) {
            self::load($name);
        }

        return self::$config[$name] ?? [];
    }
}

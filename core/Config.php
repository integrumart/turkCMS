<?php

declare(strict_types=1);

namespace turkCMS\core;

/**
 * Config Helper
 * 
 * Loads and retrieves configuration values using dot-notation
 */
class Config
{
    private static array $data = [];

    /**
     * Load configuration from a JSON file
     *
     * @param string $name Configuration file name (without .json)
     * @return void
     */
    public static function load(string $name): void
    {
        $path = dirname(__DIR__) . "/data/config/{$name}.json";
        
        if (!file_exists($path)) {
            throw new \RuntimeException("Configuration file not found: {$path}");
        }

        $content = file_get_contents($path);
        $decoded = json_decode($content, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException("Invalid JSON in configuration file: {$path}");
        }

        self::$data[$name] = $decoded;
    }

    /**
     * Get configuration value using dot-notation
     *
     * @param string $key Key in dot notation (e.g., 'site.title')
     * @param mixed $default Default value if key not found
     * @return mixed
     */
    public static function get(string $key, $default = null)
    {
        $parts = explode('.', $key);
        $file = array_shift($parts);

        if (!isset(self::$data[$file])) {
            self::load($file);
        }

        $value = self::$data[$file];

        foreach ($parts as $part) {
            if (!is_array($value) || !isset($value[$part])) {
                return $default;
            }
            $value = $value[$part];
        }

        return $value;
    }

    /**
     * Check if configuration key exists
     *
     * @param string $key Key in dot notation
     * @return bool
     */
    public static function has(string $key): bool
    {
        try {
            return self::get($key) !== null;
        } catch (\RuntimeException $e) {
            return false;
        }
    }
}

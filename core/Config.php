<?php

declare(strict_types=1);

namespace turkCMS\core;

/**
 * Configuration Helper
 * Loads and retrieves configuration from JSON files using dot-notation
 */
class Config
{
    private array $config = [];
    private Storage $storage;

    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
    }

    /**
     * Load a configuration file
     */
    public function load(string $name): void
    {
        $path = $this->storage->dataPath("config/{$name}.json");
        
        if (!$this->storage->exists($path)) {
            throw new \RuntimeException("Config file not found: {$name}.json");
        }

        $content = $this->storage->get($path);
        $data = json_decode($content, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException("Invalid JSON in config file: {$name}.json");
        }

        $this->config[$name] = $data;
    }

    /**
     * Get a configuration value using dot notation
     * Example: get('site.title') or get('site', 'default')
     */
    public function get(string $key, $default = null)
    {
        $parts = explode('.', $key);
        $value = $this->config;

        foreach ($parts as $part) {
            if (!isset($value[$part])) {
                return $default;
            }
            $value = $value[$part];
        }

        return $value;
    }

    /**
     * Check if a configuration key exists
     */
    public function has(string $key): bool
    {
        $parts = explode('.', $key);
        $value = $this->config;

        foreach ($parts as $part) {
            if (!isset($value[$part])) {
                return false;
            }
            $value = $value[$part];
        }

        return true;
    }
}

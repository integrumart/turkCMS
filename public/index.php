<?php

declare(strict_types=1);

/**
 * turkCMS Entry Point
 * 
 * This file serves as the main entry point for the application.
 * It loads the Composer autoloader and initializes the Bootstrap class.
 */

// Load Composer autoloader
require_once __DIR__ . '/../vendor/autoload.php';

// Define base path constant
define('BASE_PATH', dirname(__DIR__));

// Initialize and run the application
$bootstrap = new turkCMS\core\Bootstrap();
$bootstrap->run();

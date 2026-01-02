<?php

declare(strict_types=1);

// Load composer autoload
require_once __DIR__ . '/../vendor/autoload.php';

// Initialize storage with base path
turkCMS\core\Storage::init(dirname(__DIR__));

// Run the application
$app = new turkCMS\core\Bootstrap();
$app->run();

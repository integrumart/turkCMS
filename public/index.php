<?php

declare(strict_types=1);

/**
 * turkCMS - Flat-file Content Management System
 * Entry Point
 */

// Load Composer autoloader
require_once __DIR__ . '/../vendor/autoload.php';

// Bootstrap the application
$app = new turkCMS\core\Bootstrap();
$app->run();

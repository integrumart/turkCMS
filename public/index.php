<?php

declare(strict_types=1);

/**
 * turkCMS - Corporate-grade flat-file CMS
 * 
 * Entry point for the application
 */

// Load Composer autoloader
require_once dirname(__DIR__) . '/vendor/autoload.php';

// Bootstrap the application
$bootstrap = new turkCMS\core\Bootstrap();
$bootstrap->run();

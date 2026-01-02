# turkCMS

Türk CMS - Corporate-grade flat-file CMS built with PHP.

## Overview

turkCMS is a comprehensive, flat-file content management system designed for corporate use. It stores data in files (Markdown for content, JSON for configuration) without requiring a database.

## Features

- **Flat-File Architecture**: No database required - all content stored in Markdown and JSON files
- **PSR-4 Autoloading**: Modern PHP architecture with namespace support
- **Markdown Support**: Content written in Markdown with YAML frontmatter
- **Routing System**: Regex-based routing supporting GET/POST requests
- **Template Engine**: Flexible theming system with partials
- **Admin Panel**: Basic admin dashboard and login system

## Requirements

- PHP >= 7.4
- Composer

## Installation

1. Clone the repository:
```bash
git clone https://github.com/integrumart/turkCMS.git
cd turkCMS
```

2. Install dependencies:
```bash
composer install
```

3. Configure your web server to point to the `public/` directory, or use PHP's built-in server:
```bash
cd public
php -S localhost:8000
```

4. Visit `http://localhost:8000` in your browser

## Directory Structure

```
turkCMS/
├── app/                    # Application logic
│   ├── Controllers/        # Controllers for handling requests
│   └── Services/           # Business logic services
├── content/                # Content files (Markdown)
│   └── pages/              # Page content
├── core/                   # Core system files
│   ├── Bootstrap.php       # Application bootstrap
│   ├── Config.php          # Configuration manager
│   ├── Router.php          # URL routing
│   ├── Storage.php         # File path helper
│   └── View.php            # Template engine
├── data/                   # Data files (JSON)
│   └── config/             # Configuration files
├── public/                 # Web root directory
│   ├── .htaccess           # Apache rewrite rules
│   └── index.php           # Entry point
└── themes/                 # Theme files
    └── default/            # Default theme
        ├── partials/       # Partial templates
        ├── home.php        # Homepage template
        ├── layout.php      # Main layout
        └── page.php        # Generic page template
```

## Usage

### Creating Content

Create new pages by adding Markdown files to `content/pages/`:

```markdown
---
title: My Page Title
description: Page description
author: Admin
date: 2026-01-02
---

# Page Content

Your content here in Markdown format.
```

### Configuration

Edit `data/config/site.json` to customize site settings:

```json
{
    "title": "Your Site Name",
    "theme": "default",
    "lang": "tr"
}
```

### Routes

- `/` - Homepage
- `/[slug]` - Generic pages (e.g., `/hakkimizda`)
- `/admin` - Admin dashboard
- `/admin/login` - Admin login

## Development

The system follows PSR-12 coding standards and uses strict typing throughout.

### Adding New Routes

Edit `core/Bootstrap.php` to add new routes:

```php
$this->router->get('/^your-route$/', [$controller, 'method']);
```

### Creating Custom Themes

Copy the `themes/default` directory and customize the templates.

## License

This project is licensed under the GPL-3.0-or-later License - see the LICENSE file for details.

## Credits

Built with:
- [Parsedown](https://github.com/erusev/parsedown) - Markdown parser

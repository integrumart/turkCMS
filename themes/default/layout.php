<!DOCTYPE html>
<html lang="<?= $this->e(turkCMS\core\Config::get('site.lang', 'tr')) ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $this->e($meta['description'] ?? '') ?>">
    <title><?= $this->e($title ?? turkCMS\core\Config::get('site.title', 'turkCMS')) ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            line-height: 1.6;
            color: #333;
            background: #f5f5f5;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        header {
            background: #2c3e50;
            color: white;
            padding: 1rem 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        header h1 {
            font-size: 1.8rem;
        }
        nav {
            margin-top: 1rem;
        }
        nav a {
            color: white;
            text-decoration: none;
            margin-right: 1.5rem;
            transition: color 0.3s;
        }
        nav a:hover {
            color: #3498db;
        }
        main {
            background: white;
            margin: 2rem auto;
            padding: 2rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border-radius: 4px;
            min-height: 60vh;
        }
        footer {
            background: #34495e;
            color: white;
            text-align: center;
            padding: 2rem 0;
            margin-top: 2rem;
        }
        h1, h2, h3 {
            margin-top: 1.5rem;
            margin-bottom: 1rem;
            color: #2c3e50;
        }
        p {
            margin-bottom: 1rem;
        }
        ul {
            margin-left: 2rem;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <?php $this->partial('header'); ?>
    
    <main class="container">
        <?php echo $content ?? ''; ?>
    </main>
    
    <?php $this->partial('footer'); ?>
</body>
</html>

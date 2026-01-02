<?php
/**
 * Home Page Template
 */
?>
<!DOCTYPE html>
<html lang="<?php echo $this->escape(turkCMS\core\Config::get('site.lang', 'tr')); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $this->escape($title) : $this->escape(turkCMS\core\Config::get('site.title')); ?></title>
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
            background: #f4f4f4;
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
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        header h1 {
            margin: 0;
        }
        nav {
            margin-top: 1rem;
        }
        nav a {
            color: white;
            text-decoration: none;
            margin-right: 20px;
            padding: 5px 10px;
            border-radius: 3px;
            transition: background 0.3s;
        }
        nav a:hover {
            background: rgba(255,255,255,0.1);
        }
        main {
            background: white;
            margin: 2rem auto;
            padding: 2rem;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            min-height: 400px;
        }
        footer {
            background: #34495e;
            color: white;
            text-align: center;
            padding: 2rem 0;
            margin-top: 2rem;
        }
        h1, h2, h3 {
            margin-bottom: 1rem;
            color: #2c3e50;
        }
        p {
            margin-bottom: 1rem;
        }
        blockquote {
            border-left: 4px solid #3498db;
            padding-left: 1rem;
            margin: 1rem 0;
            color: #555;
            font-style: italic;
        }
        ul, ol {
            margin-left: 2rem;
            margin-bottom: 1rem;
        }
        li {
            margin-bottom: 0.5rem;
        }
        a {
            color: #3498db;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 3rem 0;
            margin: -2rem -2rem 2rem -2rem;
            border-radius: 5px 5px 0 0;
            text-align: center;
        }
        .hero h1 {
            color: white;
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body>
    <?php $this->partial('header'); ?>
    
    <main class="container">
        <div class="hero">
            <h1><?php echo $this->escape($title); ?></h1>
            <?php if (isset($meta['description'])): ?>
                <p><?php echo $this->escape($meta['description']); ?></p>
            <?php endif; ?>
        </div>
        
        <div class="content">
            <?php echo $content ?? ''; ?>
        </div>
    </main>
    
    <?php $this->partial('footer'); ?>
</body>
</html>

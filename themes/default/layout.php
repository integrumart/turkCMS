<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($site_lang ?? 'tr'); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo htmlspecialchars($page['description'] ?? ''); ?>">
    <title><?php echo htmlspecialchars($page['title'] ?? $site_title ?? 'turkCMS'); ?> - <?php echo htmlspecialchars($site_title ?? 'turkCMS'); ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f5f5f5;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        header {
            background-color: #2c3e50;
            color: #fff;
            padding: 1rem 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        header h1 {
            font-size: 1.8rem;
            font-weight: 600;
        }
        
        nav {
            margin-top: 1rem;
        }
        
        nav a {
            color: #fff;
            text-decoration: none;
            margin-right: 1.5rem;
            transition: color 0.3s;
        }
        
        nav a:hover {
            color: #3498db;
        }
        
        main {
            background-color: #fff;
            margin: 2rem auto;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            min-height: 400px;
        }
        
        footer {
            background-color: #34495e;
            color: #ecf0f1;
            text-align: center;
            padding: 2rem 0;
            margin-top: 3rem;
        }
        
        h1, h2, h3, h4, h5, h6 {
            margin: 1.5rem 0 1rem;
            color: #2c3e50;
        }
        
        h1 { font-size: 2.5rem; }
        h2 { font-size: 2rem; }
        h3 { font-size: 1.5rem; }
        
        p {
            margin-bottom: 1rem;
        }
        
        ul, ol {
            margin-left: 2rem;
            margin-bottom: 1rem;
        }
        
        a {
            color: #3498db;
            text-decoration: none;
        }
        
        a:hover {
            text-decoration: underline;
        }
        
        hr {
            border: none;
            border-top: 1px solid #ddd;
            margin: 2rem 0;
        }
        
        .meta {
            color: #7f8c8d;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>
    <?php $this->partial('header', ['site_title' => $site_title ?? 'turkCMS']); ?>
    
    <div class="container">
        <main>
            <?php echo $content ?? ''; ?>
        </main>
    </div>
    
    <?php $this->partial('footer', ['site_title' => $site_title ?? 'turkCMS']); ?>
</body>
</html>

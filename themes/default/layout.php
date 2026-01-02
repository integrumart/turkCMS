<!DOCTYPE html>
<html lang="<?= htmlspecialchars($site['lang'] ?? 'tr') ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Page') ?> - <?= htmlspecialchars($site['title'] ?? 'turkCMS') ?></title>
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
            color: white;
            padding: 20px 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        header .site-title {
            font-size: 28px;
            margin-bottom: 10px;
        }
        
        header .site-title a {
            color: white;
            text-decoration: none;
        }
        
        header nav ul {
            list-style: none;
            display: flex;
            gap: 20px;
        }
        
        header nav a {
            color: #ecf0f1;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        header nav a:hover {
            color: #3498db;
        }
        
        main {
            background-color: white;
            margin: 40px auto;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            min-height: 400px;
        }
        
        main h1 {
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 36px;
        }
        
        main h2 {
            color: #34495e;
            margin-top: 30px;
            margin-bottom: 15px;
            font-size: 28px;
        }
        
        main p {
            margin-bottom: 15px;
        }
        
        main ul, main ol {
            margin-left: 30px;
            margin-bottom: 15px;
        }
        
        main li {
            margin-bottom: 8px;
        }
        
        main a {
            color: #3498db;
            text-decoration: none;
        }
        
        main a:hover {
            text-decoration: underline;
        }
        
        main strong {
            color: #2c3e50;
        }
        
        footer {
            background-color: #34495e;
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: 40px;
        }
        
        @media (max-width: 768px) {
            header nav ul {
                flex-direction: column;
                gap: 10px;
            }
            
            main {
                margin: 20px 10px;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <?php echo $this->partial('header', ['site' => $site ?? []]); ?>
    
    <div class="container">
        <main>
            <?= $content ?? '' ?>
        </main>
    </div>
    
    <?php echo $this->partial('footer', ['site' => $site ?? []]); ?>
</body>
</html>

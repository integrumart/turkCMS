<?php
// Home page view - uses layout
$layoutContent = $content ?? '<p>No content available</p>';
?>
<?php echo $this->render('layout', [
    'title' => $title ?? 'Home',
    'site' => $site ?? [],
    'content' => $layoutContent
]); ?>

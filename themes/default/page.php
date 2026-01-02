<?php
// Generic page view - uses layout
$layoutContent = $content ?? '<p>No content available</p>';
?>
<?php echo $this->render('layout', [
    'title' => $title ?? 'Page',
    'site' => $site ?? [],
    'content' => $layoutContent
]); ?>

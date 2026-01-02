<?php
/**
 * Generic Page View
 */

// Start capturing content
ob_start();
?>

<article>
    <?php if (!empty($page['date'])): ?>
        <div class="meta">
            <span>Yayın Tarihi: <?php echo htmlspecialchars($page['date']); ?></span>
            <?php if (!empty($page['author'])): ?>
                <span> | Yazar: <?php echo htmlspecialchars($page['author']); ?></span>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    
    <?php echo $page['html']; ?>
</article>

<?php
// Get the captured content
$content = ob_get_clean();

// Include the layout
include __DIR__ . '/layout.php';

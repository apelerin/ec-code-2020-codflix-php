<?php ob_start(); ?>

<h3 class="mediaD-title"><?= $media['title']; ?></h3>

<div class="info-media">
    <div><?= $media['type']?></div>
    <div><?= $media['status']?></div>
    <div><?= $media['release_date']?></div>
    <div><?= $media['summary']?></div>
    <div><?= $media['trailer_url']?></div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>

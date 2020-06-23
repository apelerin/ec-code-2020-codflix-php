<?php ob_start(); ?>

Hello there
<?= $media['title']; ?>

<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>

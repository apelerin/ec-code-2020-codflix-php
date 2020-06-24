<?php ob_start(); ?>

<h3 class="mediaD-title"><?= $media['title']; ?></h3>

<div class="info-media">
    <div><?= $media['type']?></div>
    <div><?= $media['status']?></div>
    <div><?= $media['release_date']?></div>
    <div><?= $media['summary']?></div>

    <?php
    if ($media['type'] == "Film"):
        if (!isset($_GET['play'])): ?>
            <div class="button_cont" align="center">
                <a class="button_play" href="index.php?media=<?= $media['id']; ?>&play=true">
                    <span>Trailer
                </a>
            </div>
        <?php
        else:
            echo '<div>';
            echo '<iframe allowfullscreen="" frameborder="0"src="' . $media['trailer_url'] . '" ></iframe>';
            echo '<a class="button_play" href="index.php?media=' . $media['id'] . '"><span>Stop</a>';
        endif;
    else:

    endif; ?>

    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
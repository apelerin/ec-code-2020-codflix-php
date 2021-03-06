<?php ob_start(); ?>

<h3 class="mediaD-title"><?= $media['title']; ?></h3>

<div>
    <div class="media-info">
        <div>Genre: <?= $genre['name']?></div>
        <div>Type: <?= $media['type']?></div>
        <div>État: <?= $media['status']?></div>
        <div>Date de parution: <?= $media['release_date']?></div>
        <div><?= $media['summary']?></div>
    </div>
    <?php

    if (isset($_GET['current_play'])):
        echo '<div><iframe allowfullscreen="" frameborder="0"src="' . $current_episode['stream_url'] . '" ></iframe></div>';
    endif;
    if ($media['type'] == "Film"):
        if (!isset($_GET['play'])): ?>
            <div class="button_cont" align="center">
                <a class="button_play" href="index.php?media=<?= $media['id']; ?>&play=true">
                    <span>Play
                </a>
            </div>
        <?php
        else:
            echo '<div class="embed-responsive embed-responsive-21by9 wrapper-buttonflix">';
            echo '<iframe class="embed-responsive-item" allowfullscreen="" frameborder="0"src="' . $media['trailer_url'] . '" ></iframe>';
        endif;
    else:
        foreach ($episodes as $episode):
            $param = $media['id'] . '&current_play=S' . $episode['season'] . 'E' . $episode['episode'];
            if (isset($_GET['current_play']) && $season_episode == $episode['season'] . $episode['episode']):
                $btn_text = 'Épisode en visionnage';
            else:
                $btn_text = 'Season ' . $episode['season'] . ' Episode ' . $episode['episode'];
            endif;
                ?>
            <div class="button_cont" align="center">
                <a class="button_play" href="index.php?media=<?= $param ?>">
                    <span><?= $btn_text ?>
            </a>

        <?php
        endforeach;

    endif; ?>

    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
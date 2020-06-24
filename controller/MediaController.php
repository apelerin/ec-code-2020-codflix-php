<?php

require_once( 'model/media.php' );

/***************************
* ----- LOAD HOME PAGE -----
***************************/

function mediaPage() {

    if (isset( $_GET['media'] )):
        detailPage($_GET['media']);
    else:
        $search = isset( $_GET['title'] ) ? $_GET['title'] : null;

        # Todo, get this filterMedias to work
        if (isset( $_GET['title'] )):
            $medias = Media::filterMedias( $search );
        else:
            $medias = Media::getAllMedia();
        endif;

        require('view/mediaListView.php');
    endif;
}

/****************************
* ----- LOAD MEDIA PAGE -----
****************************/


function detailPage( $mediaId ) {

    $media = Media::getMediaById($mediaId);
    $episodes = Media::getShowEpisodes($media['id']);
    $genre = Media::getGenreById($media['genre_id']);

    if (isset($_GET['current_play'])):
        $array_season_episode = explode('E', $_GET['current_play']);
        $current_episode = Media::getShowEpisodesBySeasonAndEpisode(ltrim($array_season_episode[0], 'S'), $array_season_episode[1]);
        $season_episode = ltrim($array_season_episode[0], 'S') . $array_season_episode[1];
    endif;

    require('view/detailMediaView.php');
}
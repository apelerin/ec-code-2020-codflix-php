<?php

require_once( 'model/media.php' );
require_once( 'model/history.php' );

/***************************
* ----- LOAD HOME PAGE -----
***************************/

function mediaPage() {
    $search = null;
    if (isset( $_GET['media'] )):
        detailPage($_GET['media']);
    else:
        # Todo, get this filterMedias to work
        if (isset( $_GET['title'] )):
            $search = $_GET['title'];
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

    # Get the episode and a string concatenation like: 'season number' + 'episode number' to compare in the view
    if (isset($_GET['current_play'])):
        $array_season_episode = explode('E', $_GET['current_play']);
        $current_episode = Media::getShowEpisodesBySeasonEpisodeAndMedia(ltrim($array_season_episode[0], 'S'), $array_season_episode[1], $media['id']);
        $season_episode = ltrim($array_season_episode[0], 'S') . $array_season_episode[1];

        # For simplicity sake, we add an entry in history when the user click to play the stream
        History::createHistory( $_SESSION['user_id'], $media['id']);
    endif;

    if (!isset($_GET['play'])):
        History::createHistory( $_SESSION['user_id'], $media['id']);
    endif;

    require('view/detailMediaView.php');
}
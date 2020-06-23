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
    require('view/detailMediaView.php');
}
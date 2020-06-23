<?php

require_once( 'model/media.php' );

/***************************
* ----- LOAD HOME PAGE -----
***************************/

function mediaPage() {

  $search = isset( $_GET['title'] ) ? $_GET['title'] : null;

# Todo, get this filterMedias to work
  if ($search != null):
      $medias = Media::filterMedias( $search );
  else:
      $medias = Media::getAllMedia();
  endif;

  require('view/mediaListView.php');

}

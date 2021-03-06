<?php

require_once( 'database.php' );

class Media {

  protected $id;
  protected $genre_id;
  protected $title;
  protected $type;
  protected $status;
  protected $release_date;
  protected $summary;
  protected $trailer_url;

  public function __construct( $media ) {

    $this->setId( isset( $media->id ) ? $media->id : null );
    $this->setGenreId( $media->genre_id );
    $this->setTitle( $media->title );
  }

  /***************************
  * -------- SETTERS ---------
  ***************************/

  public function setId( $id ) {
    $this->id = $id;
  }

  public function setGenreId( $genre_id ) {
    $this->genre_id = $genre_id;
  }

  public function setTitle( $title ) {
    $this->title = $title;
  }

  public function setType( $type ) {
    $this->type = $type;
  }

  public function setStatus( $status ) {
    $this->status = $status;
  }

  public function setReleaseDate( $release_date ) {
    $this->release_date = $release_date;
  }

  /***************************
  * -------- GETTERS ---------
  ***************************/

  public function getId() {
    return $this->id;
  }

  public function getGenreId() {
    return $this->genre_id;
  }

  public function getTitle() {
    return $this->title;
  }

  public function getType() {
    return $this->type;
  }

  public function getStatus() {
    return $this->status;
  }

  public function getReleaseDate() {
    return $this->release_date;
  }

  public function getSummary() {
    return $this->summary;
  }

  public function getTrailerUrl() {
    return $this->trailer_url;
  }

  /**************************************
  * -------- GET FILTERED MEDIAS --------
  ***************************************/

  public static function filterMedias( $regex ) {

    // Open database connection
    $db   = init_db();

    # Put the regex in capitalized form to ignore case.
    $req  = $db->prepare( "SELECT * FROM media WHERE UPPER(title) like UPPER('" . $regex . "') ORDER BY release_date DESC" );
    $req->execute();

    // Close database connection
    $db   = null;

    return $req->fetchAll();

  }

    /**********************************
     * -------- GET ALL MEDIAS --------
     **********************************/

    public static function getAllMedia() {

        // Open database connection
        $db   = init_db();

        $req  = $db->prepare( "SELECT * FROM media ORDER BY release_date DESC" );
        $req->execute();

        // Close database connection
        $db   = null;

        return $req->fetchAll();

    }

    /************************************
     * -------- GET MEDIAS BY ID --------
     ************************************/

    public static function getMediaById( $id ) {

        // Open database connection
        $db   = init_db();

        $req  = $db->prepare( "SELECT * FROM media WHERE id = ". $id );
        $req->execute();

        // Close database connection
        $db   = null;

        return $req->fetch();

    }

    /*******************************************
     * -------- GET EPISODE BY MEDIA ID --------
     *******************************************/

    public static function getShowEpisodes( $media_id ) {

        // Open database connection
        $db   = init_db();

        $req  = $db->prepare( "SELECT * FROM show_episode WHERE media_id=" . $media_id );
        $req->execute();

        // Close database connection
        $db   = null;

        return $req->fetchAll();

    }

    /***************************************
     * -------- GET FILTERED MEDIAS --------
     ***************************************/

    public static function getShowEpisodesBySeasonEpisodeAndMedia( $season, $episode, $media_id ) {

        // Open database connection
        $db   = init_db();

        $req  = $db->prepare( "SELECT * FROM show_episode WHERE season=" . $season . " AND episode=" . $episode . " AND media_id=" . $media_id);
        $req->execute();

        // Close database connection
        $db   = null;

        return $req->fetch();

    }

    /***********************************
     * -------- GET GENRE BY ID --------
     ***********************************/

    public static function getGenreById( $genre_id ) {

        // Open database connection
        $db   = init_db();

        $req  = $db->prepare( "SELECT * FROM genre WHERE id=" . $genre_id);
        $req->execute();

        // Close database connection
        $db   = null;

        return $req->fetch();
    }

}

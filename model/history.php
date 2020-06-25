<?php


class History
{

    /***************************************
     * -------- CREATE NEW HISTORY ---------
     ***************************************/

    # This method create an entry in database when called. It does not handle season and episode for now, just the media in itself.

    # The start and finish time are not handle. The finish time is determined by the `time()` method, and the starting time is a random
    # number between 25 and 150 in seconds before that to get various durations.
    public static function createHistory( $user_id, $media_id ) {

        $finish_date = time();
        $starting_date = $finish_date - rand(25, 150);
        // Open database connection
        $db   = init_db();

        $req  = $db->prepare( "INSERT INTO history ( user_id, media_id, start_date, finish_date, watch_duration ) 
            VALUES ( :user_id, :media_id, FROM_UNIXTIME(:start_date), FROM_UNIXTIME(:finish_date), :watch_duration )" );
        $req->execute( array(
            'user_id'         => $user_id,
            'media_id'        => $media_id,
            'start_date'      => $starting_date,
            'finish_date'     => $finish_date,
            'watch_duration'  => $finish_date - $starting_date
        ));

        // Close database connection
        $db   = null;

    }

    /******************************************
     * -------- GET HISTORY BY USER ID --------
     ******************************************/

    public static function getHistoryByUserId( $user_id ) {

        // Open database connection
        $db   = init_db();

        $req  = $db->prepare( "SELECT * FROM history WHERE user_id=" . $user_id );
        $req->execute();

        // Close database connection
        $db   = null;

        return $req->fetchall();

    }
}
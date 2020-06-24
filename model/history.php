<?php


class history
{

    /***************************************
     * -------- CREATE NEW HISTORY ---------
     ***************************************/

    public static function createHistory( $user_id, $media_id ) {

        $finish_date = time();
        $starting_date = $finish_date - rand(25, 150);
        // Open database connection
        $db   = init_db();

        $req  = $db->prepare( "INSERT INTO history ( user_id, media_id, start_date, finish_date, watch_duration ) VALUES ( :user_id, :media_id, :start_date, :finish_date, :watch_duration )" );
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
<?php

require_once( 'model/history.php' );

/******************************
 * ----- LOAD HISTORY PAGE -----
 ******************************/

function historyPage($user_id) {

    $histories = History::getHistoryByUserId($user_id);
    require('view/history.php');

}
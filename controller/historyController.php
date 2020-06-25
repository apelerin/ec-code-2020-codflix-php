<?php

require_once( 'model/history.php' );

/******************************
 * ----- LOAD HISTORY PAGE -----
 ******************************/

function historyPage($user_id) {

    if (isset($_POST['id_array'])):
        foreach ($_POST['id_array'] as $history_id):
            History::deleteHistoryById($history_id);
        endforeach;
    elseif (isset($_POST['deleteAll'])):
        $historiesToDelete = History::getHistoryByUserId($user_id);
        foreach ($historiesToDelete as $history):
            History::deleteHistoryById($history['id']);
        endforeach;
    endif;

    $histories = History::getHistoryByUserId($user_id);
    require('view/history.php');

}
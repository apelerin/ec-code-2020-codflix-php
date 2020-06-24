<?php

/******************************
 * ----- LOAD HISTORY PAGE -----
 ******************************/

require_once( 'model/history.php' );

function historyPage($user_id) {
    require('view/history.php');
}
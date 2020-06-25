<?php

require_once( 'model/user.php' );

/****************************
* ----- LOAD SIGNUP PAGE -----
****************************/

function signupPage() {

  $user     = new stdClass();
  $user->id = isset( $_SESSION['user_id'] ) ? $_SESSION['user_id'] : false;

  if( !$user->id ):
    require('view/auth/signupView.php');
  else:
    require('view/homeView.php');
  endif;

}

/****************************
* ----- SIGNUP FUNCTION -----
*****************************/

function signup( $post ) {
    $data                   = new stdClass();
    $data->email            = $post['email'];
    $data->password         = hash('sha256', $post['password']);
    $data->password_confirm = hash('sha256',$post['password_confirm']);
    $data->key              = md5(microtime(TRUE)*100000);
    $data->activated        = 0;

    # Check if passwords are matching
    try {
        $user = new User( $data );
        $user->createUser();

        $linkToSend = 'localhost/CodFlix/index.php?action=login&confirmation=' . $user->getEmail() . ':' . $user->getKey();
        #todo put the email there

        header( 'location: index.php ');
    }
    catch (Exception $e) {
        $error_msg = $e->getMessage();
    }

    require('view/auth/signupView.php');
}

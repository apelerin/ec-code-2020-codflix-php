<?php

session_start();

require_once( 'model/user.php' );

/****************************
* ----- LOAD LOGIN PAGE -----
****************************/

function loginPage() {

  $user     = new stdClass();
  $user->id = isset( $_SESSION['user_id'] ) ? $_SESSION['user_id'] : false;

    if ( isset($_GET['confirmation'])):
        try{
            activateAccount($_GET['confirmation']);
        } catch (Exception $e) {
            $error_msg = $e->getMessage();
        }
    endif;

  if( !$user->id ):
    require('view/auth/loginView.php');
  else:
    require('view/homeView.php');
  endif;

}

/***************************
* ----- LOGIN FUNCTION -----
***************************/

function login( $post ) {

  $data           = new stdClass();
  $data->email    = $post['email'];
  $data->password = hash('sha256', ($post['password']));

  $user           = new User( $data );
  $userData       = $user->getUserByEmail();

  try {
      User::checkActivation($userData['activated']);
      $error_msg      = "Email ou mot de passe incorrect";

      if( $userData && sizeof( $userData ) != 0 ):
          if( $user->getPassword() == $userData['password'] ):

              // Set session
              $_SESSION['user_id'] = $userData['id'];

              header( 'location: index.php ');
          endif;
      endif;
  } catch (Exception $e) {
      $error_msg = $e->getMessage();

      # Comment to show the activation link TESTING PURPOSE
      #$error_msg = "Votre compte n'est pas activé, le lien devrait être localhost/CodFlix/index.php?action=login&confirmation=" . $userData['email'] . ':' . $userData['key'];
  }





  require('view/auth/loginView.php');
}

/****************************
* ----- LOGOUT FUNCTION -----
****************************/

function logout() {
  $_SESSION = array();
  session_destroy();

  header( 'location: index.php' );
}


 /********************************
  * ----- ACTIVATION FUNCTION -----
  *********************************/

function activateAccount($keymail) {
    $key = explode(':', $keymail)[1];
    $mail = explode(':', $keymail)[0];
    $user = User::getUserByEmailStatic($mail);
    if ($key ==  $user['key']) {
        USER::activateAccount($user['id']);
    }
    else {
        throw new Exception ("Le lien d'activation n'est pas correct.");
    }
}

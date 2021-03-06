<?php

require_once( 'controller/homeController.php' );
require_once( 'controller/loginController.php' );
require_once( 'controller/signupController.php' );
require_once( 'controller/mediaController.php' );
require_once( 'controller/historyController.php' );

/**************************
* ----- HANDLE ACTION -----
***************************/

if ( isset( $_GET['action'] ) ):

  switch( $_GET['action']):

    case 'login':

        if ( !empty( $_POST ) ) login( $_POST );
        else loginPage();

    break;

    case 'signup':

        if ( !empty( $_POST ) ) signup( $_POST );
        else signupPage();

    break;

    case 'logout':

      logout();

    break;

  endswitch;

else:

  $user_id = isset( $_SESSION['user_id'] ) ? $_SESSION['user_id'] : false;

  if (isset($_GET['history'])):
      historyPage($user_id);
  elseif( $user_id ):
      mediaPage();
  else:
      homePage();
  endif;

endif;

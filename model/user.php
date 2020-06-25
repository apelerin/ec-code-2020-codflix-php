<?php

require_once( 'database.php' );

class User {

  protected $id;
  protected $email;
  protected $password;
  protected $key;
  protected $activated;

  public function __construct( $user = null ) {

    if( $user != null ):
      $this->setId( isset( $user->id ) ? $user->id : null );
      $this->setEmail( $user->email );
      $this->setPassword( $user->password, isset( $user->password_confirm ) ? $user->password_confirm : false );
      $this->setActivated( isset( $user->activated ) ? $user->activated : null );
      $this->setKey( isset( $user->key ) ? $user->key : null );
    endif;
  }

  /***************************
  * -------- SETTERS ---------
  ***************************/

  public function setId( $id ) {
    $this->id = $id;
  }

  public function setEmail( $email ) {

    if ( !filter_var($email, FILTER_VALIDATE_EMAIL)):
      throw new Exception( 'Email incorrect' );
    endif;

    $this->email = $email;

  }

  public function setPassword( $password, $password_confirm = false ) {

    if( $password_confirm && $password != $password_confirm ):
      throw new Exception( 'Vos mots de passes sont différents' );
    endif;

    $this->password = $password;
  }

    /**
     * @param mixed $activated
     */
    public function setActivated($activated)
    {
        $this->activated = $activated;
    }

    /**
     * @param mixed $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

  /***************************
  * -------- GETTERS ---------
  ***************************/

  public function getId() {
    return $this->id;
  }

  public function getEmail() {
    return $this->email;
  }

  public function getPassword() {
    return $this->password;
  }

    /**
     * @return mixed
     */
    public function getActivated()
    {
        return $this->activated;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }
  /***********************************
  * -------- CREATE NEW USER ---------
  ************************************/

    public function createUser() {

        // Open database connection
        $db   = init_db();


        // Check if email already exist
        $req  = $db->prepare( "SELECT * FROM user WHERE email = ?" );
        $req->execute( array( $this->getEmail() ) );

        if( $req->rowCount() > 0 ) throw new Exception( "Email ou mot de passe incorrect" );

          // Insert new user
          $req->closeCursor();

        $req  = $db->prepare( "INSERT INTO user ( `email`, `password`, `key`, `activated` ) VALUES ( :email, :password, :key, :activated )");
        $req->execute( array(
            'email'     => $this->getEmail(),
            'password'  => $this->getPassword(),
            'key'       => $this->getKey(),
            'activated' => $this->getActivated()
          ));


        // Close database connection
        $db = null;

    }

  /**************************************
  * -------- GET USER DATA BY ID --------
  ***************************************/

  public static function getUserById( $id ) {

    // Open database connection
    $db   = init_db();

    $req  = $db->prepare( "SELECT * FROM user WHERE id = ?" );
    $req->execute( array( $id ));

    // Close database connection
    $db   = null;

    return $req->fetch();
  }

  /***************************************
  * ------- GET USER DATA BY EMAIL -------
  ****************************************/

  public function getUserByEmail() {

    // Open database connection
    $db   = init_db();

    $req  = $db->prepare( "SELECT * FROM user WHERE email = ?" );
    $req->execute( array( $this->getEmail() ));

    // Close database connection
    $db   = null;

    return $req->fetch();
  }

    /***********************************************
     * ------- GET USER DATA BY EMAIL STATIC -------
     ***********************************************/

    public static function getUserByEmailStatic($mail) {

        // Open database connection
        $db   = init_db();

        $req  = $db->prepare( "SELECT * FROM user WHERE email = ?" );
        $req->execute( array( $mail ));

        // Close database connection
        $db   = null;

        return $req->fetch();
    }

    /**********************************
     * ------- ACTIVATE ACCOUNT -------
     **********************************/

    public static function activateAccount($id) {

        // Open database connection
        $db   = init_db();

        $req  = $db->prepare( "UPDATE user SET activated = 1 WHERE id = ?" );
        $req->execute( array( $id ));

        // Close database connection
        $db   = null;
    }

  /***************************************
   * ------- CHECK USER ACTIVATION -------
   ***************************************/

    public static function checkActivation($activated){
        if ($activated == 0):
            throw new Exception ("Votre compte n'est pas activé.");
        endif;
    }

}

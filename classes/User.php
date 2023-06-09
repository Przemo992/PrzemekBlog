<?php
/**
 * User
 * 
 * A person or entity than can log in to the site
 */
class User{

  /**
   * Unique identifier
   * @var integer
   */
  public $id;

  /**
   * Unique username
   * @var string
   */
  public $username;
  
  /**
   * password
   * @var string
   */
  public $password;

  /**
   * Authenticate
   * 
   * @param object $connect Connection to the database
   * @param string $username Username
   * @param string $password Password
   * 
   * @return boolean True if the credentials are correct, null otherwise
   */
  public static function authenticate($connect, $username, $password){

    $sql = "SELECT *
            FROM user
            WHERE username = :username";

    $stmt = $connect->prepare($sql);

    $stmt->bindValue(':username', $username, PDO::PARAM_STR);

    $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');

    $stmt->execute();

    

    if ($user = $stmt->fetch()){
      return password_verify($password, $user->password);
        
      }
    }


  }


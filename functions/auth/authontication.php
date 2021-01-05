<?php
// this file is used for authontication only 
// mohamed khounti
// 1/4/2021
use FFI\Exception;

session_start();
 // connect to database 
 include "../../includes/mysql_connections/connect.php";
    //check if it coming from POST request
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // check if its coming from login page 
  if($_POST['method']  == 'login'){
    // get the user from databse 
    try{
      $stm = $dbc->prepare('SELECT * FROM users  where username = :username AND password = :password');
      $stm->bindParam(':username',$_POST['username'], PDO::PARAM_STR);
      $stm->bindParam(':password',$_POST['password'], PDO::PARAM_STR);
      $stm->execute();
      //check if there is a user 
      if($stm->rowcount() > 0){
          //save id 
         $data =  $stm->fetch() ;
         $userid =  $data['id'];
         $privilege =  $data['privilege']; // get the privilege (is he/she admin or not)
         $fullname =  $data['fullname']; // get the fullname 
         $_SESSION["id"] =$userid; // save id in the session to use it later.
         $_SESSION["privilege"]  = $privilege; // save privilege in the session
         $_SESSION["fullname"]  = $fullname; // save full name in the session
          // if user id and privilege is set 
         if(isset($_SESSION["id"]) && isset($_SESSION["privilege"])){
          // redirect to welcome page
          header("Location:"."../../pages/welcomepage.php");
          exit();
         }
      }else{
        // if the request not coming from POST redirect to logic page
        header("Location:"."../../login.php");
      }
    }catch(Exception $e){
      echo $e;
    }
  

  }
  // check if its coming from signup page 
  elseif($_POST['method']  == 'signup'){
    // try to add the user to database 
    try{
      $stm = $dbc->prepare('INSERT INTO users (username,fullname,email,password) values(:username,:fullname,:email,:password)');
      $stm->bindParam(':username',$_POST['username'], PDO::PARAM_STR);
      $stm->bindParam(':fullname',$_POST['fullname'], PDO::PARAM_STR);
      $stm->bindParam(':email',$_POST['email'], PDO::PARAM_STR);
      $stm->bindParam(':password',$_POST['password'], PDO::PARAM_STR);
      $stm->execute();
      //redirect to login page  [code 1 = success]
      header("Location:"."../../login.php?statu=1");
    }catch(Exception $e){
        echo $e;
        //header("Location:"."../../login.php?code=0");
    }
  }
  
} else{
    header("Location:"."../../login.php");
}

//check if the request coming from GET
if($_SERVER['REQUEST_METHOD'] == 'GET'){
  //check if there is A get reaquest of name logout and if its equal to 1. [1 = logout]
  if(isset($_GET["logout"]) && $_GET["logout"] == 1){
    session_unset();
    session_destroy();
    header("Location:"."../../login.php");
  }
  
}

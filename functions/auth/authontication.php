<?php

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
         $_SESSION["id"] =$userid;
          // if userid is set
         if(isset($_SESSION["id"])){
          // redirect to welcome page
          header("Location:"."../../pages/welcomepage.php");
          exit();
         }
      }else{
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
      header("Location:"."../../login.php?statu=congrats login now");
    }catch(Exception $e){
        echo $e;
        //header("Location:"."../../login.php?code=0");
    }
  }
  
} else{
    header("Location:"."../../login.php");
}

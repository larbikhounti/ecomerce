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
      // check if username send in correct way
      if(isset($_POST['username'])){
        //check if username sent by user is a string and not empty
        if(validatestring($_POST['username'])){
          //if soo search for him in database by username
          $stm = $dbc->prepare('SELECT * FROM users  where username = :username');
          $stm->bindParam(':username',$_POST['username'], PDO::PARAM_STR);
          $stm->execute();   
             //if the user exist
            if($stm->rowcount() > 0){
              // we fetch the data
              $data = $stm->fetch(PDO::FETCH_ASSOC);
              // we take the password sended by the user
              $password = $data['password'];
              // we compare the password sended by the user with the one we have in our database
              if(password_verify($_POST["password"],$password)){ // if its the same 
                        //save all his data in the session to use later 
                        $userid =    $data['id'];// get the id
                        $privilege = $data['privilege']; // get the privilege (is he/she admin or not)
                        $fullname =  $data['fullname']; // get the fullname 
                        $username =  $data['username']; // get username
                        $email    =  $data['email'];
                        $password =  $data['password']; // get password
                        $_SESSION["id"] =$userid; // save id in the session to use it later.
                        $_SESSION["privilege"]  = $privilege; // save privilege in the session
                        $_SESSION["fullname"]  = $fullname; // save full name in the session
                        $_SESSION["username"]  = $username; // save username in session
                        $_SESSION["email"]  = $email; // save email in session
                        $_SESSION["password"]  = $password; // save email in session
                          // if user id and privilege is set 
                        if(isset($_SESSION["id"]) && isset($_SESSION["privilege"])){
                          // redirect to welcome page
                          header("Location:"."../../pages/welcomepage.php");
                          
                        }
        
              }else{
                // if password is wrong
                // header("Location:"."../../login.php?statu=0");
              }

         }else{
           // if there is no user
          // header("Location:"."../../login.php?statu=0");
          }

        }else{
        // if username not set back to login page
        //header("Location:"."../../login.php?statu=0");
        }
      }else{ // if username not set back to login page
       // header("Location:"."../../login.php?statu=0");
      }
     
    
    }catch(Exception $e){
      echo $e;
    }
    

  }
  // check if its coming from signup page 
  elseif($_POST['method']  == 'signup'){
   // check if all data sent by the user are exist 
    if(isset($_POST['username']) && isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['password'])){
      //  check if all the data sent by the user is in the correct format expected 
      if(validatestring($_POST['username']) && validatestring($_POST['fullname']) && validatestring($_POST['password']) &&
      filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        // if all ok  try to add the user to database 
        try{
         $stm = $dbc->prepare('INSERT INTO users (username,fullname,email,password) values(:username,:fullname,:email,:password)');
         $stm->bindParam(':username',$_POST['username'], PDO::PARAM_STR);
         $stm->bindParam(':fullname',$_POST['fullname'], PDO::PARAM_STR);
         $stm->bindParam(':email',$_POST['email'], PDO::PARAM_STR);
         $stm->bindParam(':password',password_hash($_POST['password'],PASSWORD_BCRYPT), PDO::PARAM_STR);
         $stm->execute();
         //redirect to login page  [code 1 = success]
         header("Location:"."../../login.php?statu=1");
       }catch(Exception $e){
           echo $e;
           header("Location:"."../../login.php?code=0");
       }
      }else{
        header("Location:"."../../login.php?code=0");
      }
    }else {
      header("Location:"."../../login.php?code=0");
    }
   
  }
  //check if its comming from iupdate profile page
  elseif(($_POST['method']  == 'update')){
    // and if the user is already log in 
    if(isset($_SESSION["id"]) && isset($_SESSION["privilege"])) {
      // if he/she and admin
      if($_SESSION["privilege"] == 1){
  // try to update the user info
  try{
    $stm = $dbc->prepare('UPDATE users set username = :username,fullname = :fullname ,email =:email,password = :password where id=:id ');
    $stm->bindParam(':username',$_POST['username'], PDO::PARAM_STR);
    $stm->bindParam(':fullname',$_POST['fullname'], PDO::PARAM_STR);
    $stm->bindParam(':email',$_POST['email'], PDO::PARAM_STR);
    $stm->bindParam(':password',$_POST['password'], PDO::PARAM_STR);
    $stm->bindParam(':id',$_SESSION['id'], PDO::PARAM_STR);
    $stm->execute();
    
    //redirect to login page  [code 1 = success]
    header("Location:"."../../pages/profile.php?statu=1");
  }catch(Exception $e){
      echo $e;
      header("Location:"."../../profile.php?statu=0");
  }

      }
    }
  }
} else{
    header("Location:"."../../login.php");
}

//check if the request coming from GET
if($_SERVER['REQUEST_METHOD'] == 'GET'){
  //check if there is A get reaquest of name logout and if its equal to 1. [1 = logout]
  if(isset($_GET["logout"]) && $_GET["logout"] == 1){
    session_destroy();
    header("Location:"."../../login.php");
  }
  
}

// callback validate filter
function validatestring($value)
{
    // Expected format: string
    $notstrings = (!is_string($value));
    if (empty($value) || $notstrings) {
        return false;
    } else {
        return true;
    }
}



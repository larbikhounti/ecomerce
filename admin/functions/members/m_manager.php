<?php
// this file is used for managing memebers only 
// mohamed khounti
// 1/4/2021
session_start();
// connect to database 
include "../../includes/mysql_connections/connect.php";
  // delete or aprove user to an admin
  //check if its coming from Get request
  if($_SERVER['REQUEST_METHOD'] == 'GET'){
    //check if the user is an admin
    if(isset($_SESSION["privilege"])){
      if($_SESSION["privilege"] == 1){
        // IS action variable and id variable are set ?
          if(isset($_GET["action"]) && isset($_GET["id"])){
              // what kind of action is it delete or aprove?
              if($_GET["action"] == 1 ){ // 1 = aprove 
                try{
                  $stm = $dbc->prepare('update users set privilege = 1 where id = :id'); // aprove an admin
                  $stm->bindParam(":id",$_GET["id"]);
                  $stm->execute();
                 // $data = $stm ->fetchAll(PDO::FETCH_ASSOC);
                 if($stm->rowcount()> 0){
                  header("Location:"."../../pages/members.php?statu=1");
                 }
                }catch(Exception $e){
                    echo $e;
                    header("Location:"."../../pages/members.php?statu=0");
                }  

              }
              elseif($_GET["action"] == 0 ){ // 0 = delete
                try{
                  $stm = $dbc->prepare('delete from users where id = :id'); // delete the request to be an admin
                  $stm->bindParam(":id",$_GET["id"]);
                  $stm->execute();
                 // $data = $stm ->fetchAll(PDO::FETCH_ASSOC);
                 if($stm->rowcount()> 0){
                  header("Location:"."../../pages/members.php?statu=user deleted successfuly");
                 }
                 
              
                }catch(Exception $e){
                    echo $e;
                    header("Location:"."../../pages/members.php?statu=0");
                }  

              }



          }

      }else {
        header("Location:"."../../members.php?statu=you dont have permissions to do this action");
      }

    }
    // get the id of the user 
    // delete or update a user 

    
  }

  // update a member
  // check if its coming from Post request
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
      //check if the user is an admin
    if(isset($_SESSION["privilege"])){
      if($_SESSION["privilege"] == 1){
        try{
          $stm = $dbc->prepare('UPDATE users set username = :username,fullname = :fullname ,email =:email,password = :password where id=:id ');
          $stm->bindParam(':username',$_POST['username'], PDO::PARAM_STR);
          $stm->bindParam(':fullname',$_POST['fullname'], PDO::PARAM_STR);
          $stm->bindParam(':email',$_POST['email'], PDO::PARAM_STR);
          $stm->bindParam(':password',$_POST['password'], PDO::PARAM_STR);
          $stm->bindParam(':id',$_POST['id'], PDO::PARAM_STR);
          $stm->execute();
          
          //redirect to login page  [code 1 = success]
          header("Location:"."./m_updatePage.php?id=".$_POST['id']."&statu=1");
        }catch(Exception $e){
           //redirect to login page  [code 0 = failed]
           header("Location:"."./m_updatePage.php?id=".$_POST['id']."&statu=0");
        }
      }
    }
  }


<?php
// this file is used for managing memebers only 
// mohamed khounti
// 1/4/2021
session_start();
// connect to database 
include "../../includes/mysql_connections/connect.php";

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
                  $stm = $dbc->prepare('update users set privilege = 1 where id = :id');
                  $stm->bindParam(":id",$_GET["id"]);
                  $stm->execute();
                 // $data = $stm ->fetchAll(PDO::FETCH_ASSOC);
                 if($stm->rowcount()> 0){
                  header("Location:"."../../pages/members.php?statu=user aproved successfuly");
                 }

              
                }catch(Exception $e){
                    echo $e;
                    header("Location:"."../../pages/members.php?statu=0");
                }  

              }
              elseif($_GET["action"] == 0 ){ // 0 = delete
                try{
                  $stm = $dbc->prepare('delete from users where id = :id');
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



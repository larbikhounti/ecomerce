<?php 
//this page is for updating members data only
// 1/9/2021
// mohamed khounti 
session_start();
 // connect to database 
 include "../../includes/mysql_connections/connect.php";
 include "../../const/bootstrap.php";
 if(!isset($_SESSION["id"]) || $_SESSION["privilege"] != 1 ){
    header("Location:"."../login.php");
}elseif(isset($_GET['statu'])){

    $state = $_GET['statu'];
    $success = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Greet!</strong> profile updated.
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
    </button>";

    $faild = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
    <strong>opps!</strong> Something wrong try again.
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
    </button>";
}
  //check if its coming from Get request
  if($_SERVER['REQUEST_METHOD'] == 'GET'){
    //check if the user is an admin
    if(isset($_SESSION["privilege"]) && isset($_GET["id"])){
        if($_SESSION["privilege"] == 1){
              // get the user from databse 
                try{
                    $stm = $dbc->prepare('SELECT username,fullname,email,password FROM users  where id = :id');
                    $stm->bindParam(':id',$_GET['id'], PDO::PARAM_STR);
                    $stm->execute();
                    //check if there is a user 
                    if($stm->rowcount() > 0){
                    //save id 
                    $data =      $stm->fetch() ;
                    $fullname =  $data['fullname']; // get the fullname 
                    $username =  $data['username']; // get username
                    $email    =  $data['email']; // get email
                    $password =  $data['password']; // get password
                    if($password != null){
                        ?> 
                        <!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <?php echo  $bootstrapCSS; ?>
    <link rel='stylesheet' type='text/css' href='../../styles/custom.css'>
    <link rel='stylesheet' type='text/css' href='../styles/nav.css'>
   

    <title>profile</title>
</head>

<body>


 <div id='login'>
        <div class='container'>
            <div id='login-row' class='row justify-content-center align-items-center'>
                <div id='login-column' class='col-md-6'>
                    <div id='login-box' class='col-md-12'>
                        <form id='login-form' class='form' action='../../functions/members/m_manager.php' method='post'>
                            <h3 class='text-center text-info'>update member</h3>
                            <div class='form-group'>
                            <?php  echo  isset($_GET['statu'])?isset($success) && $state == 1?$success:$faild :''  ?> 
                            </div>
                            <div class='form-group'>
                                <label for='username'  class='text-info'>Username:</label><br>
                                <input type='text'  name='username'  value='<?php echo $username; ?>' id='username' class='form-control bg-light' >
                            </div>
                            <div class='form-group'>
                                <label for='password' class='text-info'>full name:</label><br>
                                <input type='text'  name='fullname' value='<?php echo $fullname ; ?>'  class='form-control' >
                            </div>
                            <div class='form-group'>
                                <label for='password' class='text-info'>email:</label><br>
                                <input type='email'  name='email' value='<?php echo $email; ?>'  id='email' class='form-control' >
                            </div>
                            <div class='form-group'>
                                <label for='password' class='text-info'>Password:</label><br>
                                <input type='password'  value='<?php echo $password; ?>' name='password'  id='password' class='form-control' >
                            </div>

                                <input type='number' name='id' value='<?php  echo $_GET["id"]; ?>' class='form-control' hidden>
                                
                            
                            <div class='form-group buttom'>
                                <input type='submit' name='submit' class='btn btn-info btn-lg' value='Update'>
                                
                            </div>
                           
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php echo  $bootstrapJQ; ?>
<?php echo  $bootstrapjS; ?>
</body>

</html>
                        
                        
                        <?php
                    }
                    }else{
                    // if there is no user
                    header("Location:"."../../pages/welcomepage.php");
                    }
                    // if something goes wrong back to welcome page
                }catch(Exception $e){
                    // back to dashboard
                   header("Location:"."../../pages/welcomepage.php");
                }
                


        }
    }
}

?>


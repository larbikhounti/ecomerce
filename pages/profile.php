<?php
session_start();
if(!isset($_SESSION["id"]) || $_SESSION["privilege"] != 1 ){
    header("Location:"."../login.php");
}elseif(isset($_GET['statu'])){

    $state = $_GET['statu'];
    $success = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Greet!</strong> your profile have being updated.
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
    </button>";

    $faild = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
    <strong>opps!</strong> Something wrong try again.
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
    </button>";
}
include "../const/bootstrap.php";
include "../const/navbar.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo  $bootstrapCSS; ?>
    <link rel='stylesheet' type='text/css' href='../styles/custom.css'>
    <link rel='stylesheet' type='text/css' href='../styles/nav.css'>
   

    <title>profile</title>
</head>

<body class="bg-light">
 <?php echo $navbar; ?>

 <div id="login">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="../functions/auth/authontication.php" method="post">
                            <h3 class="text-center text-info">Profile</h3>
                            <div class="form-group">
                            <?php  echo  isset($_GET['statu'])?isset($success) && $state == 1?$success:$faild :''  ?> 
                                <label for="username"  class="text-info">Username:</label><br>
                                <input type="text"  name="username"  value="<?php echo $_SESSION["username"]; ?>" id="username" class="form-control bg-light" >
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">full name:</label><br>
                                <input type="text"  name="fullname" value="<?php echo $_SESSION["fullname"]; ?>"  class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">email:</label><br>
                                <input type="email"  name="email" value="<?php echo $_SESSION["email"]; ?>"  id="email" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="password"  value="<?php echo $_SESSION["password"]; ?>" name="password"  id="password" class="form-control" >
                            </div>
                            
                                <input type="text" name="method" value="update" class="form-control" hidden>
                                
                            
                            <div class="form-group buttom">
                                <input type="submit" name="submit" class="btn btn-info btn-lg" value="Update">
                                
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


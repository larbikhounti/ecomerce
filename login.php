<?php
session_start();
include "./const/bootstrap.php";

if(isset($_GET['statu'])){
    $state = $_GET['statu'];
    $success = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Greet!</strong> You should be able to Log in now.
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
    </button>";
    $faild = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
    <strong>opps!</strong> Something wrong try again.
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
    </button>";
}

?>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <?php echo  $bootstrapCSS; ?>
    <link rel='stylesheet' type='text/css' href='./styles/custom.css'>
    <title>log in page</title>

</head>

<body>


<div id="login">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center ">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12 bg-dark">
                        <form id="login-form" class="form" action="./functions/auth/authontication.php" method="post">
                        
                            <h3 class="text-center text-info">Login</h3>
                            <div class="form-group">
                            <?php  echo  isset($_GET['statu'])?isset($success) && $state == 1?$success:$faild :''  ?> 
                            </div>
                            <div class="form-group">
                                <label for="username"  class="text-info">Username:</label><br>
                                <input type="text"  name="username" id="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="password"  name="password" id="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="method" value="login" class="form-control" hidden>
                            </div>
                            <div class="form-group buttom">
                                <a href="./signup.php" class="text-info bold">Register here</a>
                                <input type="submit" name="submit" class="btn btn-info btn-md bold" value="Log in" >
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


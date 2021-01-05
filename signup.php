<?php
session_start();
include "./const/bootstrap.php";
include "./const/navbar.php";

?>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <?php echo  $bootstrapCSS; ?>
    <link rel='stylesheet' type='text/css' href='./styles/custom.css'>

    <title>signup  page</title>
</head>

<body>


<div id="login">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="./functions/auth/authontication.php" method="post">
                            <h3 class="text-center text-info">Sign Up</h3>
                            <div class="form-group">
                                <label for="username"  class="text-info">Username:</label><br>
                                <input type="text"  name="username" id="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">full name:</label><br>
                                <input type="text"  name="fullname"  class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">email:</label><br>
                                <input type="email"  name="email" id="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="password"  name="password" id="password" class="form-control" required>
                            </div>
                            
                                <input type="text" name="method" value="signup" class="form-control" hidden>
                            
                            <div class="form-group buttom">
                                <input type="submit" name="submit" class="btn btn-info btn-lg" value="sign up">
                                <a href="./login.php" class="text-info bold">Log in </a>
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

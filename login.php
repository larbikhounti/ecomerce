<?php
session_start();
if(isset($_GET['statu'])){
    $state = $_GET['statu'];
}
?>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>log in page</title>
</head>

<body>

<h1> log in</h1>
<p><?php echo isset($state)?$state:"";?></p>

 <form method= 'POST' action = './functions/auth/authontication.php'>
 <input type= 'text' placeholder="username" name = 'username' required/>
 <input type= 'password' placeholder="password" name = 'password' required />
 <input type= 'text' name ='method' value = 'login'  hidden/>
  <input type= 'submit'  />
 </form> 
 <p><a href="./signup.php">signup</a></p>
</body>

</html>


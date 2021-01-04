<?php
session_start();
?>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>signup in page</title>
</head>

<body>

<h1> signup page</h1>
 <form method= 'POST' action = './functions/auth/authontication.php'>
 <input type= 'text' placeholder="username" name = 'username' required />
 <input type= 'text' placeholder="fullname" name = 'fullname' required/>
 <input type= 'email'  placeholder="email" name = 'email' required />
 <input type= 'password' placeholder="password" name = 'password' required />
 <input type= 'text' name ='method' value = 'signup'  hidden/>
  <input type= 'submit'  />
 </form> 
 <p><a href="./login.php">login</a></p>
</body>

</html>

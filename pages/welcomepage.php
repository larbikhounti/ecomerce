<?php
session_start();
if(!isset($_SESSION["id"]) || $_SESSION["privilege"] != 1 ){
    header("Location:"."../login.php");
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
    <link rel='stylesheet' type='text/css' href='../styles/nav.css'>
    <title>welcomepage</title>
</head>

<body>
 <?php echo $navbar; ?>

<p> welcome  your id is <?php echo $_SESSION["id"] ?> are you an admin ? <?php echo $_SESSION["privilege"] ?>  </p>


<?php echo  $bootstrapJQ; ?>
<?php echo  $bootstrapjS; ?>
</body>

</html>


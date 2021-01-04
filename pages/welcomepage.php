<?php
session_start();
if(!isset($_SESSION["id"])){
    header("Location:"."../login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>welcomepage</title>
</head>

<body>
<p> welcome  your id is <?php echo $_SESSION["id"] ?> </p>
</body>

</html>


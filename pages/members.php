<?php
session_start();
include "../const/bootstrap.php";
include "../const/navbar.php";
include "../includes/mysql_connections/connect.php";

// get all the users who are not admin
try{
    $stm = $dbc->prepare('SELECT id,username,email,fullname FROM users where privilege != 1 ');
    $stm->execute();
    $data = $stm ->fetchAll(PDO::FETCH_ASSOC);

  }catch(Exception $e){
      echo $e;
      header("Location:"."../../members.php?statu=0");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo  $bootstrapCSS; ?>
    <link rel='stylesheet' type='text/css' href='../styles/mambers.css'>
    <link rel='stylesheet' type='text/css' href='../styles/nav.css'>
    <title>Document</title>
</head>
<body>
<?php echo $navbar; ?>


<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Full name</th>
      <th scope="col">Email</th>
      <th scope="col">Username</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
      <?php 
         foreach ($data as $key ) {
            # code...
            echo "  <tr>
            <th scope='row'>". $key["id"] ."</th>
            <td>". $key["fullname"] ."</td>
            <td>". $key["email"] ."</td>
            <td>". $key["username"] ."</td>
            <td><a href='../functions/members/m_manager.php?id=". $key["id"] ."&action=0'><Button class='btn btn-danger'>delete</Button></a>
            <a href='#'". $key["id"] ."&action=1'><Button class='btn btn-success'>edite</Button></a>
            <a href='../functions/members/m_manager.php?id=". $key["id"] ."&action=1'><Button class='btn btn-warning'>make admin</Button></a>
            </td>
          </tr>";
        }
      ?>
 
  </tbody>
</table>

<?php echo  $bootstrapJQ; ?>
<?php echo  $bootstrapjS; ?>
</body>
</html>

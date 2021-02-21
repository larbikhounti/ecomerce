<?php   
session_start();
include "../const/bootstrap.php";
include "../const/navbar.php";
include "../includes/mysql_connections/connect.php";
if(!isset($_SESSION["id"]) || $_SESSION["privilege"] != 1 ){
  header("Location:"."../login.php");
}

// get all the users who are not admin
try{
    $stm = $dbc->prepare('SELECT * from category ');
    $stm->execute();
    $data = $stm ->fetchAll(PDO::FETCH_ASSOC);
    

  }catch(Exception $e){
      echo $e;
      header("Location:"."./categories.php?statu=0");
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <title>Document</title>
</head>
<body>
<?php echo $navbar; ?>

<div class="table-responsive-sm p-5 ">

<table class="table w-50 center m-auto  ">
  <thead class="thead-dark ">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">category </th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col">
      <form class="column row" action="../functions/categories/c_manager.php?action=3" method="post">
        <input class=" input-group-sm" type="text" name="category" required>
        <button class="btn btn-success ml-2" type="submit">Add Category</button>
      </form>
      </th>
      
    </tr>
  </thead>
  <tbody>
      <?php 
      
         foreach ($data as $key ) {
                # code...
                echo "  <tr>
                <th scope='row'>". $key["id"] ."</th>
                <td>". $key["name"] ."</td>
                <td>
                <a href='../functions/categories/c_manager.php?id=". $key["id"] ."&action=2'><Button class='btn btn-danger'>delete</Button></a>
                </td>
                <td>
                </td>
                <td>
                <form class='column row' action='../functions/categories/c_manager.php?id=". $key["id"] ."&action=1' method='POST'>
                <input class=' input-group-sm' type='text' name='category' required>
                <button class='btn btn-primary ml-2' type='submit'>Update <i class='bi bi-pencil-square'></i></button>
              </form>
                </td>
                
              </tr>";
        
         }
      ?>
 
  </tbody>
</table>

</div>

<?php echo  $bootstrapJQ; ?>
<?php echo  $bootstrapjS; ?>
</body>
</html>

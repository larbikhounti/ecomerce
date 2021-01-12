<?php 
// this page is for adding new products only
//1/12/2021
// mohamed khounti

// [3333333333333333, $_file[''],i,in_array(),]
session_start();
include "../const/bootstrap.php";
include "../const/navbar.php";
include "../includes/mysql_connections/connect.php";
if(!isset($_SESSION["id"]) || $_SESSION["privilege"] != 1 ){
    header("Location:"."../login.php");
}
// get all the products from database
try{
    $stm = $dbc->prepare('select * from items');
    $stm->execute();
    $data = $stm ->fetchAll(PDO::FETCH_ASSOC);

  }catch(Exception $e){
      echo $e;
      header("Location:"."../../welcomepage.php?statu=0");
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
    <title>products</title>
</head>
<body>
<?php echo $navbar; ?>

<div class="table-responsive-sm">

<table class="table ">
  <thead class="thead-dark ">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Primary Image</th>
      <th scope="col">Title</th>
      <th scope="col">Descreption</th>
      <th scope="col">Price</th>
      <th scope="col">Quantity</th>
      <th scope="col">Date Added</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
      <?php 
         foreach ($data as $key ) {
            # code...
            echo "  <tr>
            <th scope='row'>". $key["id"] ."</th>
            <td><img src=".$key["primary_image"]." width ='50px' height ='50px /></td>
            <td>".$key["title"]."</td>
            <td>".$key["descreption"]."</td>
            <td>".$key["price"]."</td>
            <td>".$key["quantity"]."</td>
            <td>".$key["date_added"]."</td>
            <td>
            <a href='../functions/members/m_manager.php?id=". $key["id"] ."&action=0'><Button class='btn btn-danger'>delete</Button></a>
            </td>
            <td>
            <a href='../functions/members/m_updatePage.php?id=". $key["id"] ."'><Button class='btn btn-success'>Edit</Button></a>
            </td>

          </tr>";
        }+6
      ?>
 
  </tbody>
</table>

</div>

<?php echo  $bootstrapJQ; ?>
<?php echo  $bootstrapjS; ?>
</body>
</html>
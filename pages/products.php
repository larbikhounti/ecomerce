<?php
// this page is for adding new products only
//1/12/2021
// mohamed khounti

// [$_file[''],i,in_array(),]
session_start();
include "../const/bootstrap.php";
include "../const/navbar.php";
include "../includes/mysql_connections/connect.php";
if (!isset($_SESSION["id"]) || $_SESSION["privilege"] != 1) {
  header("Location:" . "../login.php");
} elseif (isset($_GET['statu'])) {

  $state = $_GET['statu'];
  $success = "<div class=' alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Greet!</strong> product with id = " . $_GET['id'] . " has been deleted 
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
  <span aria-hidden='true'>&times;</span>
  </button>";

  $faild = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
  <strong>opps!</strong> Something wrong try again.
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
  <span aria-hidden='true'>&times;</span>
  </button>";
}

// get all the products from database
try {
  //print_r($_GET);
   if(isset($_GET["color"]) && isset($_GET["category"])) {
    $stm = $dbc->prepare('SELECT items.*,colors.id,category.id from items,colors,item_color,category,item_category where 
    items.id = item_color.item_id and item_color.color_id = colors.id
    AND items.id = item_category.items_id and item_category.category_id = category.id HAVING colors.id = :color_id and category.id = :category_id
    ');
    $stm->bindParam("color_id",$_GET["color"]);
    $stm->bindParam("category_id",$_GET["category"]);
    $stm->execute();
    $products = $stm->fetchAll(PDO::FETCH_ASSOC);
   }else{
    $stm = $dbc->prepare('select * from items');
    $stm->execute();
    $products = $stm->fetchAll(PDO::FETCH_ASSOC);
   }
  
  $stm = $dbc->prepare('select * from category');
  $stm->execute();
  $categories = $stm->fetchAll(PDO::FETCH_ASSOC);
  $stm = $dbc->prepare('select * from colors');
  $stm->execute();
  $colors = $stm->fetchAll(PDO::FETCH_ASSOC);
  //print_r($categories);

} catch (Exception $e) {
  echo $e;
  // header("Location:"."../../welcomepage.php?statu=0");
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
  <link rel='stylesheet' type='text/css' href='../styles/products.css'>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <link href="https://unpkg.com/bootstrap-table@1.18.2/dist/bootstrap-table.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../styles/jquery.jqZoom.css" />

  <title>products</title>
</head>

<body>
  <?php echo $navbar; ?>



  <div class="container">

    <div class="row">
      <?php echo  isset($_GET['statu']) ? isset($success) && $state == 1 ? $success : $faild : ''  ?>
    </div>
    <div class="table-responsive-sm mt-5 ">
      <div class="row ml-5">
        <form action="./products.php" method="GET" class="row ">
        <select class="form-select form-select-lg mr-4" name ="category" aria-label=".form-select-lg ">
        <option selected>Category</option>
            <?php
              foreach ($categories as $category) {
                # code...
                echo "<option value='".$category["id"]."'>".$category["name"]."</option>";
                
              }

              ?>
        </select>
          
        <select class="form-select form-select-lg mr-4"  name ="color"  aria-label=".form-select-lg ">
        <option selected>Colors</option>
            <?php
              foreach ($colors as $color) {
                # code...
                echo "<option value='".$color["id"]."'>".$color["name"]."</option>";
                
              }

              ?>
        </select>

            <button type="submit" class="btn btn-primary w-20" ><i class="bi bi-search"></i> Filter</button>
        </form>


      </div>


      <table id="table" 
      class="table table-sm mt-1"
      data-filter-control="true"
      data-show-multi-sort="false"
      
  >
        <thead class="thead-dark ">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Primary Image</th>
            <th scope="col" data-field="title" data-filter-control="input" >Title</th>
            <th scope="col" data-field="Descreption" data-filter-control="input">Descreption</th>
            <th scope="col" data-field="Price" data-filter-control="input" data-sortable="true">Price</th>
            <th scope="col" data-field="Quantity" data-filter-control="input" data-sortable="true" >Quantity</th>
            <th scope="col" data-field="Date Added" data-filter-control="input" data-sortable="true">Date Added</th>
            <th scope="col"><a href="../functions/products/addProductPage.php"><button class="btn btn-success">Add Product <i class="bi bi-pencil-square"></i></button></a></th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($products as $product) {
            # code...
            echo "<tr>
                            <th scope='row'>" . $product["id"] . "</th>
                            <td class ='p-0 m-0 w-0'><div class='zoom-box p-0 w-5'>
                            <img class='image' src=" . $product["primary_image"] . " width='50px' height='50px' /></div></td>
                            <td>" . substr($product["title"], 0, 30) . "...</td>
                            <td>" . substr($product["descreption"], 0, 35) . "...</td>
                            <td>" . $product["price"] . "</td>
                            <td>" . $product["quantity"] . "</td>
                            <td>" . $product["date_added"] . "</td>
                            <td>
                            <a href='../functions/products/p_manager.php?id=" . $product["id"] . "&method=delete'><Button class='btn btn-danger'>delete <i class='bi bi-file-earmark-x'></i></Button></a>
                            </td>
                            <td>
                            <a href='../functions/products/p_updatepage.php?id=" . $product["id"]  . "&method=update'><Button class='btn bg-dark text-white '>Edit <i class='bi bi-pencil-fill'></i></Button></a>
                            </td>

                          </tr>";
          }
          ?>

        </tbody>
      </table>
    </div>


  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <?php echo  $bootstrapJQ; ?>
  <?php echo  $bootstrapjS; ?>


  <script src="https://unpkg.com/bootstrap-table@1.18.2/dist/bootstrap-table.min.js"></script>
  <script src="https://unpkg.com/bootstrap-table@1.18.2/dist/extensions/filter-control/bootstrap-table-filter-control.min.js"></script>
  <script src="https://unpkg.com/bootstrap-table@1.18.2/dist/extensions/multiple-sort/bootstrap-table-multiple-sort.js"></script>

  <script>
  $(function() {
    $('#table').bootstrapTable()
  })
</script>
  <script src="../scriptsjs/jquery.jqZoom.js">


  </script>
  <script>
    $(function() {
      $(".image").jqZoom({
        selectorWidth: 20,
        selectorHeight: 20,
        viewerWidth: 300,
        viewerHeight: 400


      });
    })
    
  </script>
</body>

</html>
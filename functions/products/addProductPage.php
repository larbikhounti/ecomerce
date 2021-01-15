<?php  
session_start();
// this page is for adding product only
// 1/15/2021
// mohamed khounti
include "../../const/bootstrap.php";
include "../../includes/mysql_connections/connect.php";

if(!isset($_SESSION["id"]) || $_SESSION["privilege"] != 1 ){
    header("Location:"."../login.php");
}elseif(isset($_GET['statu'])){

    $state = $_GET['statu'];
    $success = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Greet!</strong> profile updated.
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
try{
    $stm = $dbc->prepare('SELECT category.name as category_name,category.id as category_id,colors.id as colors_id,colors.name as colors_id FROM category,colors');
    $stm->execute();
    $data = $stm ->fetchAll(PDO::FETCH_ASSOC);

   // print_r($data);
  }catch(Exception $e){
      echo $e;
      header("Location:"."../../welcomepage.php?statu=0");
  }


?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <?php echo  $bootstrapCSS; ?>
    <link rel='stylesheet' type='text/css' href='../../styles/custom.css'>

    <title>profile</title>
</head>

<body>

 <div id='login'>
        <div class='container'>
            <div id='login-row' class='row justify-content-center align-items-center'>
                <div id='login-column' class='col-md-6'>
                    <div id='login-box' class='col-md-12 bg-dark'>
                        <form id='login-form' class='form' action='../../functions/members/m_manager.php' method='post'>
                            <h3 class='text-center text-info'>Add Product</h3>
                            <div class='form-group'>
                            <?php  echo  isset($_GET['statu'])?isset($success) && $state == 1?$success:$faild :''  ?> 
                            </div>
                            <div class='form-group'>
                                <label for='primary_image' class='text-info font-weight-bold'>primary image:</label><br>
                                <input type='file'  name='primary_image'  id='primary_image'  accept="image/*" class="form-control-file bg-light" >
                            </div>
                            <div class='form-group'>
                                <label for='title'  class='text-info font-weight-bold'>title</label><br>
                                <input type='text'  name='title'  id='title' class='form-control bg-light' >
                            </div>
                            <div class='form-group' >
                                <label for='description' class='text-info font-weight-bold'>description:</label><br>
                                <textarea type='text'  name='description'    class='form-control' aria-multiline="true" ></textarea>
                            </div>
                            <div class='form-group'>
                                <label for='price' class='text-info font-weight-bold'>price:</label><br>
                                <input type='number'  name='price'  id='price' class='form-control' >
                            </div>
                            <div class='form-group'>
                                <label for='quantity' class='text-info font-weight-bold'>quantity:</label><br>
                                <input type='number'   name='quantity'  id='quantity' class='form-control' >
                            </div>
                            <label for='Category' class='text-info font-weight-bold'>Categories:</label><br>
                            <div class='input-group  form-group buttom' id="Category">
                                    <div class="input-group-prepend">
                                            <label class="input-group-text" for="inputGroupSelect01">Category</label>
                                     </div>
                                            <select multiple class="custom-select" id="inputGroupSelect01">
                                            <?php 
                                           foreach ($data as $category ) {
                                                echo "
                                                <option value=".$category["category_id"].">".$category["category_name"] ."</option>";
                                            }
                                            ?>
                                            </select>    
                            </div>
                            <label for='Category' class='text-info font-weight-bold'>Colors:</label><br>
                            <div class='input-group  form-group buttom'>
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">color</label>
                                </div>
                                     <select  multiple class='custom-select' id='inputGroupSelect01'>
                                            <?php 
                                           foreach ($data as $color ) {
                                                echo "
                                                <option value=".$color["color_id"].">".$color["color_name"] ."</option>";
                                            }
                                            ?>
                                    </select>
  
                            </div>
                            
                            <div class='form-group buttom'>
                                <input type='submit' name='submit' class='btn btn-info btn-lg' value='Update'> 
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
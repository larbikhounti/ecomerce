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
    <strong>Greet!</strong> product added updated.
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
    </button>";

    $faild = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
    <strong>opps!</strong> Something went wrong try again.
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
    </button>";
}
// get all the products from database
try{
    $stm = $dbc->prepare('SELECT id as color_id,name as color_name from colors ');
    $stm->execute();
    $colors = $stm ->fetchAll(PDO::FETCH_ASSOC);
    //print_r($colors);
    $stm2 = $dbc->prepare('SELECT id as category_id , name as category_name from category');
    $stm2->execute();
    $categories = $stm2 ->fetchAll(PDO::FETCH_ASSOC);

  //print_r($categories);

   // print_r($data);
  }catch(Exception $e){
      echo $e;
     // header("Location:"."../../welcomepage.php?statu=0");
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

                        <form id='login-form'enctype="multipart/form-data" class='form' action='../../functions/products/p_manager.php' method='post'>
                            <h3 class='text-center text-info'>Add Product</h3>
                            <div class='form-group'>
                            <?php  echo  isset($_GET['statu'])?isset($success) && $state == 1?$success:$faild :''  ?> 
                            </div>
                            <div class='form-group column'>
                            <input type="hidden" name="MAX_FILE_SIZE" value="800000" />
                                <div>
                                    <label for='primary_image' class='text-info font-weight-bold'>primary image: </label><br>
                                   
                                    <input type='file'  name='primary_image'  id='file'  accept="image/png,image/jpg,image/jpeg" class="form-control-file bg-light" >
                                </div>
                                <div>
                                    <label for='secondary_image' class='text-info font-weight-bold'>secondary image:</label><br>
                                    
                                    <input type='file'  name='secondary_image'  id='file'  accept="image/png,image/jpg,image/jpeg" class="form-control-file bg-light" >
                                </div>
                                <div>
                                    <label for='third_image' class='text-info font-weight-bold'>third image:</label><br>
                                   
                                    <input type='file'  name='third_image'  id='file'  accept="image/png,image/jpg,image/jpeg" class="form-control-file bg-light" >
                                </div>                                                               
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
                                <input type='number' step='0.01' name='price'  id='price' class='form-control' >
                            </div>
                            <div class='form-group'>
                                <label for='quantity' class='text-info font-weight-bold'>quantity:</label><br>
                                <input type='number'   name='quantity'  id='quantity' class='form-control' >
                            </div>
                            <label for='Category' class='text-info font-weight-bold'>Categories:</label><br>
                            <div class='input-group  form-group buttom' id="Category">
                                    <div class="input-group-prepend">
                                            <label class="input-group-text" for="inputGroupSelect01">Categories</label>
                                     </div>
                                            <select  name="categories[]" multiple class="custom-select" id="inputGroupSelect01">
                                            <?php 
                                           foreach ($categories as $category ) {
                                                echo "
                                                <option value=".$category["category_id"].">".$category["category_name"] ."</option>";
                                            }
                                            ?>
                                            </select>    
                            </div>
                            <label for='Category' class='text-info font-weight-bold'>Colors:</label><br>
                            <div class='input-group  form-group buttom'>
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">colors</label>
                                </div>
                                     <select name="colors[]"  multiple class='custom-select' id='inputGroupSelect01'>
                                            <?php 
                                           foreach ($colors as $color ) {
                                                echo "
                                                <option value=".$color["color_id"].">".$color["color_name"] ."</option>";
                                            }
                                            ?>
                                    </select>
  
                            </div>
                            
                            <div class='form-group buttom'>
                                <input type='submit' name='submit' class='btn btn-success btn-lg' value='Add Product'> 
                            </div>
                           
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>




<?php echo  $bootstrapJQ; ?>
<?php echo  $bootstrapjS; ?>
<script type="text/javascript">
//checking if its the accpeted format 
var regEx = /(?:png|jpeg|jpg)/g;
let files= document.querySelectorAll("#file")
 $(files).each(function (index, element) {
    $(element).change((event)=>{
        let text = $(event.target).val()
        let splited = text.split(".",2); 
        if(regEx.test(splited[1].toLowerCase())){
            console.log(true)

        }
    })
    });
   

   
    </script>


</body>

</html>
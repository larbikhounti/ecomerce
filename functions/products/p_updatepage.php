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
    <strong>Greet!</strong> product added succesfully.
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
        //create empty array 
        
    $stm = $dbc->prepare('SELECT items.*,colors.name as  color from items,colors,item_color
    WHERE items.id = item_color.item_id and item_color.color_id = colors.id');
    $stm->execute();
    $colors = $stm ->fetchAll(PDO::FETCH_ASSOC);

    $stm = $dbc->prepare('SELECT items.*,category.name as  category from items,category,item_category
    WHERE items.id = item_category.items_id and item_category.category_id = category.id
    ');
    $stm->execute();
    $category = $stm ->fetchAll(PDO::FETCH_ASSOC);
    
    $stm = $dbc->prepare('SELECT DISTINCT items.*,pictures.url as image_url from items,pictures
    WHERE items.id = pictures.product_id    
    ');
    $stm->execute();
    $pictures = $stm ->fetchAll(PDO::FETCH_ASSOC);

    //print_r($colors);
    $reuslta = regroup_color($colors,$category,$pictures);
    echo json_encode($reuslta);
    //print_r($colors);
    /*
    $stm2 = $dbc->prepare('SELECT id as category_id , name as category_name from category');
    $stm2->execute();
    $categories = $stm2 ->fetchAll(PDO::FETCH_ASSOC);
    */
//print_r($colors);
/*
    $stm3 = $dbc->prepare('SELECT *  from items where id= :id');
    $stm3->bindParam(':id',$_GET['id'], PDO::PARAM_STR);
    $stm3->execute();
    $item = $stm2 ->fetchAll(PDO::FETCH_ASSOC);
*/
  //print_r($categories);

   // print_r($data);
  }catch(Exception $e){
      echo $e;
     // header("Location:"."../../welcomepage.php?statu=0");
  }
  function regroup_color($colors = array(),$catagories = array(),$pictures = array()){
      // array that will hold our data and we will return it later
    $ret = array();
    // fetch the data as d
    foreach($colors as $d){
      //save the id 
      $id = $d['id'];
      //make sure no id was set
      if(!isset($ret[$id])){
        // save the name of the color
        $color = $d['color'];
        unset($d['color']);
        //save all the item data
        $ret[$id] = $d;
        // add color to color array
        $ret[$id]['colors'][] = $color;
      }else{
          // if wa alredy did all the above things just keep adding colors to color array
        $ret[$id]['colors'][] = $d['color'];
      }
    }
      
      
    foreach($catagories as $d){
        //save the id 
          $id = $d['id'];
          //make sure no id was set
          if(!isset($ret[$id])){
            // save the name of the color
            $category = $d['categories'];
            unset($d['category']);
            $ret[$id] = $d;
            $ret[$id]['categories'][] = $category;
          }else{
            $ret[$id]['categories'][] = $d['category'];
          }
        }

        foreach($pictures as $d){
            //save the id 
              $id = $d['id'];
              //make sure no id was set
              if(!isset($ret[$id])){
                // save the name of the color
                $image_url = $d['image_urls'];
                unset($d['image_url']);
                $ret[$id] = $d;
                $ret[$id]['image_urls'][] = $image_url;
              }else{
                $ret[$id]['image_urls'][] = $d['image_url'];
              }
            }
    
    
  return $ret;
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
                        <input type="hidden" name="MAX_FILE_SIZE" value="800000" />
                            <h3 class='text-center text-info'>Add Product</h3>
                                <div class='form-group'>
                                <div class='alert alert-danger  primary alert-dismissible fade show' role='alert'>
                                        <strong>opps!</strong> image type not supported.
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                        </button> 
                                </div>
                            <div class='form-group'>
                            <?php  echo  isset($_GET['statu'])?isset($success) && $state == 1?$success:$faild :''  ?> 
                            </div>
                            <div class='form-group column'>                            
                                <div>
                                    <label for='primary_image' class='text-info font-weight-bold'>primary image: </label><br>
                                    <input type='file'  name='primary_image'  id='file'  accept="image/png,image/jpg,image/jpeg" class="form-control-file bg-light" required>
                                </div>
                                <div>
                                    <label for='secondary_image' class='text-info font-weight-bold'>secondary image:</label><br>
                                    
                                    <input type='file'  name='secondary_image'  id='file'  accept="image/png,image/jpg,image/jpeg" class="form-control-file bg-light" required >
                                </div>
                                <div>
                                    <label for='third_image' class='text-info font-weight-bold'>third image:</label><br>
                                   
                                    <input type='file'  name='third_image'  id='file'  accept="image/png,image/jpg,image/jpeg" class="form-control-file bg-light" required >
                                </div>                                                               
                            </div>
                            <div class='form-group'>
                                <label for='title'  class='text-info font-weight-bold'>title</label><br>
                                <input type='text'  name='title'  id='title' class='form-control bg-light' required>
                            </div>
                            <div class='form-group' >
                                <label for='description' class='text-info font-weight-bold'>description:</label><br>
                                <textarea type='text'  name='description'    class='form-control' aria-multiline="true" required ></textarea>
                            </div>
                            <div class='form-group'>
                                <label for='price' class='text-info font-weight-bold'>price:</label><br>
                                <input type='number' step='0.01' name='price'  id='price' class='form-control' required >
                            </div>
                            <div class='form-group'>
                                <label for='quantity' class='text-info font-weight-bold'>quantity:</label><br>
                                <input type='number'   name='quantity'  id='quantity' class='form-control'  required>
                            </div>
                            <label for='Category' class='text-info font-weight-bold'>Categories:</label><br>
                            <div class='input-group  form-group buttom' id="Category">
                                    <div class="input-group-prepend">
                                            <label class="input-group-text" for="inputGroupSelect01">Categories</label>
                                     </div>
                                            <select  name="categories[]" multiple class="custom-select" id="inputGroupSelect01" required>
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
                                     <select name="colors[]"  multiple class='custom-select' id='inputGroupSelect01' required>
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
 let types =[ "png","jpeg","jpg","PNG","JPEG","JPG"]
let files= document.querySelectorAll("#file")
$(".primary").css("display","none")
 $(files).each(function (index, element) {
     
    $(element).change((event)=>{
        
        let text = $(event.target).val()
        let splited = text.split(".",2); 
        console.log(this.files[0].size)
        for (let i = 0; i < types.length; i++) {
            if (this.files[0].size > 8000000){
                $(".primary").text("image size  is bigger than 8M")
                $(".primary").css("display","unset")
                $(element).val("");
                break
            }
            else if(splited[1] === types[i]){
                $(".primary").css("display","none")
            break
            }
            if(i === 5){
            console.log("false")
            $(".primary").css("display","unset")
            $(element).val("");
            }
            
        }
     
       
    })
    });
   

   
    </script>


</body>

</html>
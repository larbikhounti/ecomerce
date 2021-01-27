<?php  
// this page is for managing products only
// 1/15/2021
// mohamed khounti
session_start();
if(!isset($_SESSION["id"]) || $_SESSION["privilege"] != 1 ){
    header("Location:"."../login.php");
}
include "../../includes/mysql_connections/connect.php";
//accepted image types
define("ACCEPTED_TYPES",array("png","jpg","jpeg"));
//max image size
define("IMAGE_MAX_SIZE",800000); // 8MB
// how many images
$images_name = array("primary_image","secondary_image","third_image");
// array of images  returned by uploadimage() function
$image_links = array();
//store errors happened while uploading images
$errors_uploading = array();
 //check if its coming from Get request
 if($_SERVER['REQUEST_METHOD'] == 'POST'){
     
    if(isset($_FILES) && isset($_POST)){
        
        // upload multiimages
        for ($i=0; $i < sizeof($_FILES)  ; $i++) { 
            // upload multi images and  save there path in array
            $image_links[$i] = uploadimage($_FILES,$images_name[$i],$i);
        }
        try{
            $stm = $dbc->prepare('INSERT INTO items (title,descreption,price,quantity,primary_image) values (:title,:desc,:price,:quantity,:primary)');
            $stm->bindParam(':title',$_POST['title'], PDO::PARAM_STR);
            $stm->bindParam(':desc',$_POST['description'], PDO::PARAM_STR);
            $stm->bindParam(':price',$_POST['price'], PDO::PARAM_STR);
            $stm->bindParam(':quantity',$_POST['quantity'], PDO::PARAM_STR);
            $stm->bindParam(':primary',$image_links[0], PDO::PARAM_STR);
            $stm->execute();
            //getting the id of the last instert
            $mylastinsertid =  $dbc->lastInsertId();
            if(!empty($mylastinsertid)){
                //adding images with the id we got from lastInsertId()
                for ($i=1; $i < sizeof($image_links); $i++) { 
                    $stm = $dbc->prepare('INSERT INTO pictures (url,product_id) values (:url,:id)');
                    $stm->bindParam(':url',$image_links[$i], PDO::PARAM_STR);
                    $stm->bindParam(':id',$mylastinsertid, PDO::PARAM_STR);
                    $stm->execute();
                }
                if(!empty($mylastinsertid)){
                    //adding colors
                    for ($i=0; $i < sizeof($_POST["colors"]); $i++) { 
                        $stm = $dbc->prepare('INSERT INTO item_color (item_id,color_id) values (:item_id,:color_id)');
                        $stm->bindParam(':item_id',$mylastinsertid, PDO::PARAM_STR);
                        $stm->bindParam(':color_id',$_POST["colors"][$i], PDO::PARAM_STR);
                        $stm->execute();
                    }
                }
                if(!empty($mylastinsertid)){
                    //adding category
                    for ($i=0; $i < sizeof($_POST["categories"]); $i++) { 
                        $stm = $dbc->prepare('INSERT INTO item_category (items_id,category_id) values (:item_id,:category_id)');
                        $stm->bindParam(':item_id',$mylastinsertid, PDO::PARAM_STR);
                        $stm->bindParam(':category_id',$_POST["categories"][$i], PDO::PARAM_STR);
                        $stm->execute();
                    }
                }
             
            }
        }catch(Exception $e){
            // back to dashboard
           // header("location:"."../products/addProductPage.php?statu=0");
           echo $e;
        }
        //print_r($image_links);
    }
 }
//upload image
function uploadimage($file,$image,$i){
    // upload directory
    $uploaddir = $_SERVER['DOCUMENT_ROOT'] . "/ecomerce/uploads/";
    //get type of the file
    $type = $file[$image]['type'];
    $image_type = explode('/',$type,2);
    //($image_type[1]);
    // check if image size is accepted 
    if($file[$image]['size'] > constant("IMAGE_MAX_SIZE") ){
       // return "image size is too big ".$file[$image]['name'];
       header("location:"."../products/addProductPage.php?statu=0");
       return 0;
    }
    // loop throw types and compare them with uploaded image type
    foreach(constant("ACCEPTED_TYPES") as $type){
       if(strtolower($image_type[1]) == $type ) {
            // set upload imes path
            $uploadfile = $uploaddir . basename($_FILES[$image]['name']);
            // save image name
            $filename = $_FILES[$image]['name'];
            // upload the image if success  and return image directory. if not return say what the problem.
            try{
                if (move_uploaded_file($_FILES[$image]['tmp_name'],$uploadfile)) {
                    $mytime = time(); 
                   // rename image

                  if(rename($_SERVER['DOCUMENT_ROOT'] . "/ecomerce/uploads/".$filename,$uploaddir.$mytime . $filename)){
                         //get protocol
                         $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://';
                        //return image url
                        return $protocol.$_SERVER['SERVER_NAME']. "/ecomerce/uploads/".$mytime.$filename ; // 1 = success
                    }
                  
                } else {
                    // return false
                   // return "failed to upload the image  ".$file[$image]['name']; // 0 = failed
                   $errors_uploading[$i] = "failed to upload the image  ".$file[$image]['name'];
                    "failed to upload the image  ".$file[$image]['name'];
                    header("location:"."../products/addProductPage.php?statu=0");
                }
                break; // break the loop
            }catch(Exception $ex){
                echo $ex;
            }
       }
    }
    header("location:"."../products/addProductPage.php?statu=0");
   // return  ;
   
  
}

?>



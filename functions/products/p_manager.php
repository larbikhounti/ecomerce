<?php  
// this page is for managing products only
// 1/15/2021
// mohamed khounti
session_start();
//accepted image types
define("ACCEPTED_TYPES",array("png","jpg","jpej"));
//max image size
define("IMAGE_MAX_SIZE",800000); // 8MB
// how many images
$images_name = array("primary_image","secondary_image","third_image");
$image_links = array();
//upload file


for ($i=0; $i < 3 ; $i++) { 
    # code...
  $image_links[$i] = uploadimage($_FILES,$images_name[$i]);
}
print_r($image_links);

//upload image
function uploadimage($file,$image){
    // upload directory
    $uploaddir = '../../uploads/';
    //get type of the file
    $type = $file[$image]['type'];
    $image_type = explode('/',$type,2);
    // check if image size is accepted 
    if($file[$image]['size'] > constant("IMAGE_MAX_SIZE") ){
        return array("image size is too big",0,$file[$image]['name']);
    }
    // loop throw types and compare them with uploaded image type
    foreach(constant("ACCEPTED_TYPES") as $type){
       if($image_type[1] == $type ) {
            // get the name of the image
            $uploadfile = $uploaddir . basename($_FILES[$image]['name']);
            // save image name
            $filename = $_FILES[$image]['name'];
            // upload the image if success  and return image directory. if not return false.
            try{
                if (move_uploaded_file($_FILES[$image]['tmp_name'], $uploadfile)) {
                    //return image directory
                    return $_SERVER['DOCUMENT_ROOT'] . "/uploads/". $filename; // 1 = success
                } else {
                    // return false
                    return "failed to upload the image  ".$file[$image]['name']; // 0 = failed
                }
                break; // break the loop
            }catch(Exception $ex){
                echo $ex;
            }
       }
    }
    return   "image type is not supported of ".$file[$image]['type'] . "if image ". $file[$image]['name'];
  
}

?>



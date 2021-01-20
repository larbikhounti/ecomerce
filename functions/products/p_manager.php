<?php  
// this page is for managing products only
// 1/15/2021
// mohamed khounti
session_start();
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

// upload multiimages
for ($i=0; $i < 3 ; $i++) { 
    // upload multi images and  save there path in array
  $image_links[$i] = uploadimage($_FILES,$images_name[$i],$i);
}
print_r($image_links);
print_r($errors_uploading);





//upload image
function uploadimage($file,$image,$i){
    // upload directory
    $uploaddir = '../../uploads/';
    //get type of the file
    $type = $file[$image]['type'];
    $image_type = explode('/',$type,2);
    // check if image size is accepted 
    if($file[$image]['size'] > constant("IMAGE_MAX_SIZE") ){
       // return "image size is too big ".$file[$image]['name'];
       $errors_uploading[$i] = "image size is too big ".$file[$image]['name'];
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
                if (move_uploaded_file($_FILES[$image]['tmp_name'], $uploadfile)) {
                    //return image directory
                    return $_SERVER['DOCUMENT_ROOT'] . "/uploads/". $filename; // 1 = success
                } else {
                    // return false
                   // return "failed to upload the image  ".$file[$image]['name']; // 0 = failed
                   $errors_uploading[$i] = "failed to upload the image  ".$file[$image]['name'];
                }
                break; // break the loop
            }catch(Exception $ex){
                echo $ex;
            }
       }
    }
    $errors_uploading[$i] = "image type is not supported of ".$file[$image]['type'] . " image name ". $file[$image]['name'];
   // return  ;
   
  
}

?>



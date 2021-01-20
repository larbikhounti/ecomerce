<?php  
// this page is for managing products only
// 1/15/2021
// mohamed khounti
session_start();
//accepted image types
define("ACCEPTED_TYPES",array("png","jpg","jpej"));
//max image size
define("IMAGE_MAX_SIZE",800000); // 8MB
//upload file
print_r(uploadimage($_FILES));

//upload image
function uploadimage($file){
    // upload directory
    $uploaddir = '../../uploads/';
    //get type of the file
    $type = $file['primary_image']['type'];
    $image_type = explode('/',$type,2);
    // check if image size is accepted 
    if($file['primary_image']['size'] > constant("IMAGE_MAX_SIZE") ){
        return array("image size is too big",0);
    }
    // loop throw types and compare them with uploaded image type
    foreach(constant("ACCEPTED_TYPES") as $type){
       if($image_type[1] == $type ) {
            // get the name of the image
            $uploadfile = $uploaddir . basename($_FILES['primary_image']['name']);
            // save image name
            $filename = $_FILES['primary_image']['name'];
            // upload the image if success  and return image directory. if not return false.
            try{
                if (move_uploaded_file($_FILES['primary_image']['tmp_name'], $uploadfile)) {
                    //return image directory
                    return array($_SERVER['DOCUMENT_ROOT'] . "/uploads/". $filename,1); // 1 = success
                } else {
                    // return false
                    return array("failed to upload the file",0); // 0 = failed
                }
                break; // break the loop
            }catch(Exception $ex){
                echo $ex;
            }
       }
    }
    return  array("image type is not supported",0);
  
}

?>



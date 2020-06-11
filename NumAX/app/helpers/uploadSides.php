<?php
    function upload(){
    global $sides;
    $sides= array();
    $fileName = $_FILES['side1']['name'];
    $fileTmpName = $_FILES['side1']['tmp_name'];
    $fileSize = $_FILES['side1']['size'];
    $fileError = $_FILES['side1']['error'];
    $fileName = $_FILES['side1']['type'];
    $path = $_FILES['side1']['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $allowed = array('jpg','png','jpeg');
    $path_parts = pathinfo($path);
    $name1=$path_parts['filename'];
    if (in_array($ext,$allowed)){
        if($fileError === 0){
            if($fileSize<1000000){
                $fileNameNew = $_SESSION['id']."_".$name1."_".$_POST['name']."_side1.".$ext;
                $fileDestination ='assets/img/uploads/'.$fileNameNew;
                $sides[]=$fileDestination;
                move_uploaded_file($fileTmpName, $fileDestination);
                
            }else{
                echo "File is too big, limit is 10 MB!";
            }
        }
        else{
            echo "Error uploading the file!";
        }
    } else {
        echo "Wrong file type! Only .jpg, .jpeg, .png are allowed!";
    }


       $fileName2 = $_FILES['side2']['name'];
       $fileTmpName2 = $_FILES['side2']['tmp_name'];
       $fileSize2 = $_FILES['side2']['size'];
       $fileError2 = $_FILES['side2']['error'];
       $fileName2 = $_FILES['side2']['type'];
       $path2 = $_FILES['side2']['name'];
       $ext2 = pathinfo($path2, PATHINFO_EXTENSION);
       $path_parts2 = pathinfo($path2);
       $name2=$path_parts2['filename'];
       //$allowed = array('jpg','png','jpeg');
       if (in_array($ext2,$allowed)){
           if($fileError === 0){
               if($fileSize2<100000000){
                   $fileNameNew2 = $_SESSION['id']."_".$name2."_".$_POST['name']."_side2.".$ext2;
                   $fileDestination2 ='assets/img/uploads/'.$fileNameNew2;
                   $sides[]=$fileDestination2;
                   move_uploaded_file($fileTmpName2, $fileDestination2);
                   
               }else{
                   echo "File is too big, limit is 10 MB!";
               }
           }
           else{
               echo "Error uploading the file!";
           }
       } else {
           echo "Wrong file type! Only .jpg, .jpeg, .png are allowed!";
       }
   return $sides;
   }

?> 
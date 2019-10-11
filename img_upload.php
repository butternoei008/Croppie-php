<?php
    if(isset($_POST['image'])){
        $img_data = explode(",", $_POST['image']);
        $img_encode = base64_decode($img_data[1]);
        $img_rename = "upload/".time().'.png';
        file_put_contents($img_rename, $img_encode);
        echo  '<img src="'.$img_rename.'" class="rounded-circle thumbnail">';
    }
?>
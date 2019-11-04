<?php

include 'connectDB.php';

$json = file_get_contents('php://input');
$obj = json_decode($json,true);

$user_Name = $obj['name_db'];
$user_Id = $obj['userId_db'];
$user_Password = $obj['password_db'];
$user_Image = $obj['userImage_db'];

$CheckSQL = "SELECT * FROM user_account WHERE user_Id = '$user_Id' ";

$check = mysqli_fetch_array(mysqli_query($conn,$CheckSQL));

if(isset($check)){

    $InvalidMSG = 0 ;
    $InvalidMSGJSon = json_encode($InvalidMSG);
    echo $InvalidMSGJSon ;
    
}else{

    mysqli_query($conn,"INSERT INTO user_account (user_Id,user_Name,user_Password,user_Image) 
                                          VALUES ('$user_Id','$user_Name','$user_Password','$user_Image')");
    echo json_decode(1);
}

mysqli_close($conn);

?>
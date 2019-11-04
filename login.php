<?php

include 'connectDB.php';

$json = file_get_contents('php://input');
$obj = json_decode($json,true);

$user_Id = $obj['user_id'];
$user_Password = $obj['user_password'];

$checkSQL = "SELECT * FROM user_account WHERE user_Id = '$user_Id' and user_Password = '$user_Password'";

$check = mysqli_fetch_array(mysqli_query($conn,$checkSQL));

if(isset($check)){
    $id_SQL = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM user_account WHERE user_Id = '$user_Id' and user_Password = '$user_Password'"));
    $id = $id_SQL;//['user_Id'];
    echo json_encode($id);
}
else{
    echo json_decode(0);
}

 mysqli_close($conn);

?>
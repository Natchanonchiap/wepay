<?php

include 'connectDB.php';

$json = file_get_contents('php://input');
$obj = json_decode($json,true);

$user_Id = $obj['user_Id'];
$group_Id = $obj['group_Id'];

    
    mysqli_query($conn,"DELETE FROM group_detail WHERE user_Id = '$user_Id' AND group_Id = '$group_Id'");

    mysqli_query($conn,"UPDATE group_master SET group_Total = (SELECT COUNT(user_Id) FROM group_detail WHERE group_Id = '$group_Id') WHERE group_Id = '$group_Id' ");

mysqli_close($conn);

?>
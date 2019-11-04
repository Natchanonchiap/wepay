<?php

include 'connectDB.php';

$json = file_get_contents('php://input');
$obj = json_decode($json,true);

$group_Id = $obj['group_Id'];

    mysqli_query($conn,"DELETE FROM group_master WHERE group_Id = '$group_Id' ");

    mysqli_query($conn,"DELETE FROM group_detail WHERE group_Id = '$group_Id' ");


mysqli_close($conn);

?>
<?php

include 'connectDB.php';

$json = file_get_contents('php://input');
$obj = json_decode($json,true);

$topic_Id = $obj['topic_Id'];
$group_Id = $obj['group_Id'];

    mysqli_query($conn,"DELETE FROM topic_detail WHERE topic_Id = '$topic_Id' AND group_Id = '$group_Id'");
    mysqli_query($conn,"DELETE FROM activities WHERE group_Id = '$group_Id' AND topic_Id = '$topic_Id'");


mysqli_close($conn);

?>
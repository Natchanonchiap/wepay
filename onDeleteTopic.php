<?php

include 'connectDB.php';

$json = file_get_contents('php://input');
$obj = json_decode($json,true);

$topic_Id = $obj['topic_Id'];

    mysqli_query($conn,"DELETE FROM topic_master WHERE topic_Id = '$topic_Id' ");

    mysqli_query($conn,"DELETE FROM topic_detail WHERE topic_Id = '$topic_Id' ");

    mysqli_query($conn,"DELETE FROM activity WHERE topic_Id = '$topic_Id' ");

mysqli_close($conn);
?>
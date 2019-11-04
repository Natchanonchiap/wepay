<?php

include 'connectDB.php';

$json = file_get_contents('php://input');
$obj = json_decode($json,true);

$topic_Payment = $obj['topic_Payment'];
$topic_Id = $obj['topic_Id'];

    mysqli_query($conn,"UPDATE topic_master SET topic_Payment = '$topic_Payment' WHERE topic_Id = '$topic_Id' ");


mysqli_close($conn);

?>
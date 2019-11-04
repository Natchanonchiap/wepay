<?php

include 'connectDB.php';

$json = file_get_contents('php://input');
$obj = json_decode($json,true);

$check = $obj['check'];
$topic_Id = $obj['topic_Id'];
$topic_Name = $obj['topicName_db'];
$topic_Description = $obj['topicDetail_db'];
$topic_DateDeadline = $obj['dateDeadline_db'];

$group_Id = $obj['group_Id'];
$group_Name = $obj['groupName_db'];

/*$tem = $dateDeadline;
$json = json_encode($tem);
echo $json;*/

    if($check = 'topic'){
        mysqli_query($conn,"UPDATE topic_master SET topic_Name = '$topic_Name', topic_Description = '$topic_Description', topic_DateDeadline = DATE_FORMAT('$topic_DateDeadline','%Y-%m-%d') WHERE topic_Id = '$topic_Id' ");
    }
    
    if($check = 'group'){
        mysqli_query($conn,"UPDATE group_master SET group_Name = '$group_Name' WHERE group_Id = '$group_Id' ");
    }
    
mysqli_close($conn);

?>
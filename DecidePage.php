<?php

include 'connectDB.php';

$json = file_get_contents('php://input');
$obj = json_decode($json,true);

$user_Id = $obj['user_Id'];
$topic_Id = $obj['topic_Id'];

$result = mysqli_query($conn,"SELECT a.topic_id,
                                     a.topic_Name,
                                     a.topic_MasterId,
                                     a.topic_Description
                              FROM   topic_master a,
                                     group_master b,
                                     topic_detail c,
                                     group_detail d
                              WHERE  d.user_Id = '$user_Id'
                                AND  a.topic_Id = '$topic_Id'
                                AND  a.topic_Id = c.topic_Id
                                AND  c.group_Id = d.group_Id
                                AND  b.group_Id = d.group_Id");

    if ($result->num_rows >0) {

        while($row[] = $result->fetch_assoc()) {
            $tem = $row;
            $json = json_encode($tem);
        }
    } 
    echo $json;

mysqli_close($conn);

?>
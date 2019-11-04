<?php

include 'connectDB.php';

$json = file_get_contents('php://input');
$obj = json_decode($json,true);

$topic_Id = $obj['topic_Id'];

$result = mysqli_query($conn,"SELECT a.group_Id,a.group_Name, a.group_MasterId, c.user_Name, a.group_Total
                                    FROM
                                     group_master a,
                                     topic_detail b,
                                     user_account c
                                    WHERE
                                     b.topic_Id = '$topic_Id' 
                                     AND a.group_Id = b.group_Id 
                                     AND c.user_Id = a.group_MasterId");

if ($result->num_rows >0) {

    while($row[] = $result->fetch_assoc()) {
        $tem = $row;
        $json = json_encode($tem);
    }
   } 
   echo $json;


mysqli_close($conn);

?>
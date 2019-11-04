<?php

include 'connectDB.php';

$json = file_get_contents('php://input');
$obj = json_decode($json,true);

// $user_Id = $obj['user_Id'];
// $topic_Id = $obj['topic_Id'];

/*$result = mysqli_query($conn,"SELECT a.topic_id,
                                     a.topic_Name,
                                     a.topic_MasterId,
                                     a.topic_Description,
                                     a.topic_Amount,
                                     b.group_Name,
                                     b.group_MasterId,
                                     b.group_Id
                              FROM   topic_master a,
                                     group_master b,
                                     topic_detail c,
                                     group_detail d
                              WHERE d.user_Id = '$user_Id'
                                AND a.topic_Id = '$topic_Id'
                                AND a.topic_Id = c.topic_Id
                                AND c.group_Id = d.group_Id
                                AND b.group_Id = d.group_Id");

    if ($result->num_rows >0) {

        while($row[] = $result->fetch_assoc()) {
            $tem = $row;
            $json = json_encode($tem);
        }
    } 
    echo $json;*/


//$topic_MasterId = $obj['topic_MasterId'];
//$group_Id = $obj['group_Id'];
$topic_Id = $obj['topic_Id'];
$user_Id = $obj['user_Id'];

/*$result = mysqli_fetch_assoc(mysqli_query($conn,"SELECT a.user_Name
                                FROM user_account a , topic_master b , topic_detail c
                                WHERE b.topic_MasterId = '$topic_MasterId'
                                AND a.user_Id = b.topic_MasterId
                                AND b.topic_Id = '$topic_Id'
                                AND c.group_Id = '$group_Id'
                                AND b.topic_Id = c.topic_Id "));*/

$result = mysqli_query($conn,"SELECT
                                                   a.group_Id,
                                                   b.group_Name,
                                                   b.group_MasterId,
                                                   c.user_Name
                                                 FROM
                                                   activities a,
                                                   group_master b,
                                                   user_account c
                                                 WHERE
                                                   a.group_Id = b.group_Id AND b.group_MasterId = c.user_Id AND a.topic_Id = '$topic_Id' AND a.user_Id = '$user_Id'
                                                    ");

/*$json = $result;
echo json_encode($json);*/

if ($result->num_rows >0) {

    while($row[] = $result->fetch_assoc()) {
        $tem = $row;
        $json = json_encode($tem);
    }
} 
echo $json;

mysqli_close($conn);

?>
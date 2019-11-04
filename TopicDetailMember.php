<?php

include 'connectDB.php';

$json = file_get_contents('php://input');
$obj = json_decode($json,true);

$topic_Id = $obj['topic_Id'];
$group_Id = $obj['group_Id'];

$result = mysqli_query($conn,"SELECT
                                a.user_Id,
                                a.user_Name,
                                b.status
                              FROM
                                user_account a,
                                activities b
                              WHERE
                                a.user_Id = b.user_Id AND b.group_Id = '$group_Id' AND b.topic_Id = '$topic_Id'");

    if ($result->num_rows >0) {

        while($row[] = $result->fetch_assoc()) {
            $tem = $row;
            $json = json_encode($tem);
        }
    } 
    echo $json;

mysqli_close($conn);

?>
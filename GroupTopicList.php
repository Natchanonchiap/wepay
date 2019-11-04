<?php

include 'connectDB.php';

$json = file_get_contents('php://input');
$obj = json_decode($json,true);

$group_Id = $obj['group_Id'];

$result = mysqli_query($conn,"SELECT
                                a.topic_Id,
                                a.topic_Name,
                                a.topic_Description,
                                a.topic_Amount,
                                a.topic_DateDeadline,
                                a.topic_MasterId,
                                b.user_Name
                            FROM
                                topic_master a,
                                user_account b,
                                topic_detail c
                            WHERE
                                a.topic_MasterId = b.user_Id AND c.group_Id = '$group_Id' AND c.topic_Id = a.topic_Id");

    if ($result->num_rows >0) {

        while($row[] = $result->fetch_assoc()) {
            $tem = $row;
            $json = json_encode($tem);
        }
    } 
    echo $json;

mysqli_close($conn);

?>
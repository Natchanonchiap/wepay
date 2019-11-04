<?php

include 'connectDB.php';

$json = file_get_contents('php://input');
$obj = json_decode($json,true);

$group_Id = $obj['group_Id'];
$topic_Id = $obj['topic_Id'];

$result = mysqli_query($conn,"SELECT
                                b.topic_Name,
                                b.topic_MasterId,
                                b.topic_Description,
                                b.topic_Amount,
                                a.user_Id,
                                c.user_Name,
                                c.user_Image,
                                a.status
                            FROM
                                activities a,
                                topic_master b,
                                user_account c
                            WHERE
                                a.group_Id = '$group_Id' AND a.topic_Id = '$topic_Id' AND a.topic_Id = b.topic_Id AND a.user_Id = c.user_Id");

    if ($result->num_rows >0) {

        while($row[] = $result->fetch_assoc()) {
            $tem = $row;
            $json = json_encode($tem);
        }
    } 
    echo $json;

mysqli_close($conn);

?>
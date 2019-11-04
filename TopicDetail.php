<?php

include 'connectDB.php';

$json = file_get_contents('php://input');
$obj = json_decode($json,true);

$topic_Id = $obj['topic_Id'];

$result = mysqli_query($conn,"SELECT
                            a.group_Id,
                            a.group_Name,
                            a.group_MasterId,
                            b.user_Name,
                            b.user_Id,
                            (SELECT COUNT(user_Id) FROM activities WHERE topic_Id = '$topic_Id' AND group_Id = a.group_Id AND status = 'FINISH' ) AS 'topic_Total_Finish',
                            (SELECT COUNT(user_Id) FROM activities WHERE topic_Id = '$topic_Id' AND group_Id = a.group_Id  AND status NOT IN ('QUIT') ) AS 'topic_Total_NoQuit'
                            FROM
                            group_master a,
                            user_account b,
                            topic_detail c
                            WHERE
                            a.group_MasterId = b.user_Id AND a.group_Id = c.group_Id AND c.topic_Id = '$topic_Id'
                            ");

    if ($result->num_rows >0) {

        while($row[] = $result->fetch_assoc()) {
            $tem = $row;
            $json = json_encode($tem);
        }
    } 
    echo $json;

mysqli_close($conn);

?>
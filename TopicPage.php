<?php

include 'connectDB.php';

$json = file_get_contents('php://input');
$obj = json_decode($json,true);

$user_Id = $obj['user_Id'];

$result = mysqli_query($conn,"SELECT
                                DISTINCT(a.topic_Id),
                                a.topic_Name,
                                a.topic_Description,
                                a.topic_Amount,
                                a.topic_DateDeadline,
                                (SELECT COUNT(user_Id) FROM activities WHERE topic_Id = a.topic_Id AND status = 'FINISH' ) AS 'topic_Total_Finish',
                                (SELECT COUNT(user_Id) FROM activities WHERE topic_Id = a.topic_Id AND status NOT IN ('QUIT') ) AS 'topic_Total_NoQuit'
                                FROM
                                topic_master a
                                WHERE
                                a.topic_MasterId = '$user_Id'");

    if ($result->num_rows >0) {

        while($row[] = $result->fetch_assoc()) {
            $tem = $row;
            $json = json_encode($tem);
        }
    } 
    echo $json;

mysqli_close($conn);

?>
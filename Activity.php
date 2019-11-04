<?php

include 'connectDB.php';

$json = file_get_contents('php://input');
$obj = json_decode($json,true);

$user_Id = $obj['user_Id'];

    $result = mysqli_query($conn,"SELECT
                                    a.topic_Id,
                                    a.topic_Name,
                                    a.topic_Description,
                                    a.topic_Amount,
                                    b.status,
                                    d.group_Id,
                                    f.group_Name,
                                    a.topic_MasterId,
                                    e.user_Name                                    
                                FROM
                                    topic_master a,
                                    topic_detail c,
                                    group_detail d,
                                    activities b,
                                    user_account e,
                                    group_master f
                                WHERE
                                    d.user_Id = '$user_Id' 
                                    AND e.user_Id = a.topic_MasterId
                                    AND a.topic_Id = c.topic_Id 
                                    AND c.group_Id = d.group_Id 
                                    AND b.user_Id = '$user_Id' 
                                    AND b.group_Id = c.group_Id 
                                    AND b.group_Id = d.group_Id 
                                    AND b.topic_Id = c.topic_Id 
                                    AND b.user_Id = d.user_Id 
                                    AND e.user_Id = d.user_Id 
                                    AND e.user_Id = b.user_Id 
                                    AND f.group_Id = d.group_Id ");

    /*$result = mysqli_query($conn,"SELECT
                                    DISTINCT(a.topic_Id),
                                    a.topic_Name,
                                    a.topic_Description,
                                    a.topic_Amount,
                                    b.STATUS,
                                    a.topic_MasterId
                                FROM
                                    topic_master a,
                                    activities b
                                WHERE
                                    b.user_Id = (SELECT user_Id FROM user_account WHERE user_Id = '$user_Id') AND a.topic_Id = b.topic_Id ");*/

    if ($result->num_rows >0) {

        while($row[] = $result->fetch_assoc()) {
            $tem = $row;
            $json = json_encode($tem);
        }
    } 
    echo $json;

mysqli_close($conn);

?>
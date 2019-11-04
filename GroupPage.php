<?php

include 'connectDB.php';

$json = file_get_contents('php://input');
$obj = json_decode($json,true);

$user_Id = $obj['user_Id'];

$result = mysqli_query($conn,"SELECT
                                a.group_Id,
                                a.group_Name,
                                a.group_Total
                                FROM
                                group_master a,
                                group_detail b
                                WHERE
                                a.group_Id = b.group_Id AND b.user_Id = '$user_Id' AND a.group_MasterId = '$user_Id'");

    if ($result->num_rows >0) {
        while($row[] = $result->fetch_assoc()) {
            $tem = $row;
            $json = json_encode($tem);
        }
    } 
    echo $json;

mysqli_close($conn);

?>
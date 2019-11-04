<?php

include 'connectDB.php';

$json = file_get_contents('php://input');
$obj = json_decode($json,true);

$group_Id = $obj['group_Id'];

$result = mysqli_query($conn,"SELECT a.user_Name , a.user_Id
                              FROM user_account a , group_detail b
                              WHERE b.group_Id = '$group_Id' 
                               AND a.user_Id = b.user_Id");
 
 if ($result->num_rows >0) {

    while($row[] = $result->fetch_assoc()) {
        $tem = $row;
        $json = json_encode($tem);
        }
   } 
   echo $json;

mysqli_close($conn);

?>
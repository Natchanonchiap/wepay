<?php

include 'connectDB.php';

$json = file_get_contents('php://input');
$obj = json_decode($json,true);

$group_Name = $obj['groupName_db'];
$group_MasterId = $obj['group_MasterId_db'];

    $CheckSQL = "SELECT * FROM group_master WHERE group_Name = '$group_Name'";
    $check = mysqli_fetch_array(mysqli_query($conn,$CheckSQL));

    if(isset($check)){
        $InvalidMSG = 0 ;
        $InvalidMSGJSon = json_encode($InvalidMSG);
        echo $InvalidMSGJSon ; 
        }else{
            mysqli_query($conn,"insert into group_master (group_Name,group_MasterId,group_Total) values ('$group_Name','$group_MasterId',1)");
            // insert คนสร้างลงกลุ่มรอ ส่ง id มา
            //mysqli_query($conn,"INSERT INTO group_detail ()")

            $id_SQL = mysqli_fetch_assoc(mysqli_query($conn,"SELECT group_Id FROM group_master WHERE group_MasterId = '$group_MasterId' AND group_Name = '$group_Name'"));
            $group_Id = $id_SQL['group_Id'];
            mysqli_query($conn,"INSERT into group_detail 
                                        (group_Id,
                                         user_Id) 
                                    values 
                                        ($group_Id,
                                        '$group_MasterId')"); //insert คนสร้างลงกลุ่ม(detail)
            echo json_encode($group_Id);
    }

mysqli_close($conn);

?>
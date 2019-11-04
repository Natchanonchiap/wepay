<?php

include 'connectDB.php';

$json = file_get_contents('php://input');
$obj = json_decode($json,true);

$user_Id = $obj['idUser'];
$group_Id = $obj['group_Id'];

    $Check_User = mysqli_fetch_array(mysqli_query($conn,"SELECT user_Id FROM user_account WHERE user_Id = '$user_Id'"));
    
    if(isset($Check_User)){

        $CheckSQL = "SELECT * FROM group_detail WHERE user_Id ='$user_Id' AND group_Id = '$group_Id'";
        $check = mysqli_fetch_array(mysqli_query($conn,$CheckSQL));
    
    if(isset($check)){
        $groupNameExistMSG = 0;
        $groupNameExistJson = json_encode($groupNameExistMSG);
        echo $groupNameExistJson ; 
        }else{
            mysqli_query($conn,"INSERT into group_detail 
                                        (group_Id,
                                        user_Id) 
                                    values 
                                        ($group_Id,
                                        '$user_Id')");
                                        
            mysqli_query($conn,"UPDATE group_master SET group_Total = (SELECT COUNT(user_Id) FROM group_detail WHERE group_Id = '$group_Id') WHERE group_Id = '$group_Id' ");                          
                                        $groupNameExistMSG = 1;
                                        $groupNameExistJson = json_encode($groupNameExistMSG);
                                        echo $groupNameExistJson ; 
            }
        }else{
            $groupNameExistMSG = 1;
            $groupNameExistJson = json_encode($groupNameExistMSG);
            echo $groupNameExistJson ; 
        }


mysqli_close($conn);

?>
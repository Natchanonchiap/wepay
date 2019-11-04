<?php

include 'connectDB.php';

$json = file_get_contents('php://input');
$obj = json_decode($json,true);

$group_Name = $obj['group_Name'];
$topic_Id = $obj['topic_Id'];
//$topic_Payment = $obj['topic_Payment'];

    $Check_User = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM group_master WHERE group_Name = '$group_Name'"));
    $group_Id = $Check_User['group_Id'];
    if(isset($Check_User)){
    
        $CheckSQL = "SELECT * FROM topic_detail WHERE topic_Id ='$topic_Id' AND group_Id = '$group_Id'";
        $check = mysqli_fetch_array(mysqli_query($conn,$CheckSQL));

    if(isset($check)){
        $groupNameExistMSG = 0;
        $groupNameExistJson = json_encode($groupNameExistMSG);
        echo $groupNameExistJson ; 
        }else{
            mysqli_query($conn,"INSERT into topic_detail 
                                        (topic_Id,
                                        group_Id) 
                                    values 
                                        ($topic_Id,
                                        '$group_Id  ')");


            mysqli_query($conn,"INSERT INTO activities(user_Id, group_Id, topic_Id ,status)
                                                                        SELECT
                                                                            a.user_Id,
                                                                            b.group_Id,
                                                                            c.topic_Id,
                                                                            d.topic_HaveTo
                                                                        FROM
                                                                            user_account a,
                                                                            group_detail b,
                                                                            topic_detail c,
                                                                            topic_master d
                                                                        WHERE
                                                                            c.topic_Id = '$topic_Id' 
                                                                        AND b.group_Id = '$group_Id'
                                                                        AND a.user_Id = b.user_Id 
                                                                        AND b.group_Id = c.group_Id 
                                                                        AND c.topic_Id = d.topic_Id 
                                                                        AND d.topic_Id = '$topic_Id'");

            //mysqli_query($conn,"UPDATE topic_master SET topic_Payment = $topic_Payment WHERE group_Id = '$group_Id'")


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
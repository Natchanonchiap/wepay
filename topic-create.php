<?php

include 'connectDB.php';

$json = file_get_contents('php://input');
$obj = json_decode($json,true);

$topic_MasterId = $obj['topic_MasterId_db'];
$topic_Name = $obj['topicName_db'];
$topic_Description = $obj['topicDetail_db'];
$topic_Amount = $obj['amount_db'];
$topic_DateDeadline = $obj['dateDeadline_db'];
$topic_Type = $obj['topicType_db'];
$topic_HaveTo = $obj['havetoPay_db'];

$CheckSQL = "SELECT * FROM topic_master WHERE topic_Name = '$topic_Name' AND topic_MasterId ='$topic_MasterId'";
$check = mysqli_fetch_array(mysqli_query($conn,$CheckSQL));
    if(isset($check)){
        $InvalidMSG = 0 ;
        $InvalidMSGJSon = json_encode($InvalidMSG);
        echo $InvalidMSGJSon ; 
        }else{
            $insert_SQL = "insert into topic_master 
                                        (topic_Name,
                                        topic_MasterId,
                                        topic_Description,
                                        topic_Amount,
                                        topic_Type,
                                        topic_HaveTo,
                                        topic_DateDeadline
                                        ) 
                                    values
                                        ('$topic_Name',
                                        '$topic_MasterId',
                                        '$topic_Description',
                                        '$topic_Amount',
                                        '$topic_Type',
                                        '$topic_HaveTo',
                                        DATE_FORMAT('$topic_DateDeadline','%Y-%m-%d')
                                        )";

                        mysqli_query($conn,$insert_SQL);

                  $id_SQL = mysqli_fetch_assoc(mysqli_query($conn,"SELECT topic_Id FROM topic_master WHERE topic_MasterId ='$topic_MasterId' AND topic_Name = '$topic_Name'"));
                  $id = $id_SQL['topic_Id'];
                  echo json_encode($id);

            }           
mysqli_close($conn);




?>
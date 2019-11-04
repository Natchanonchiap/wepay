<?php

include 'connectDB.php';

$json = file_get_contents('php://input');
$obj = json_decode($json,true);

$check = $obj['check'];
$user_Id = $obj['user_Id'];
$topic_Id = $obj['topic_Id'];
$group_Id = $obj['group_Id'];


switch ($check) {
    case "request":
        mysqli_query($conn,"UPDATE
        activities
    SET
    STATUS
        = 'REQUEST'
    WHERE
        topic_Id = '$topic_Id' AND group_Id = '$group_Id' AND user_Id = '$user_Id'");        
        break;
    case "process":
        mysqli_query($conn,"UPDATE
        activities
    SET
    STATUS
        = 'PROCESS'
    WHERE
        topic_Id = '$topic_Id'  AND user_Id = '$user_Id'");
        break;
    case "quit":
        mysqli_query($conn,"UPDATE
        activities
    SET
    STATUS
        = 'QUIT'
    WHERE
        topic_Id = '$topic_Id'  AND user_Id = '$user_Id'");
        break;
    case "finish":
        mysqli_query($conn,"UPDATE
        activities
    SET
    STATUS
        = 'FINISH'
    WHERE
        topic_Id = '$topic_Id'   AND user_Id = '$user_Id'");
        break;
    default:
        echo json_decode('Zzz');
}

    

mysqli_close($conn);

?>
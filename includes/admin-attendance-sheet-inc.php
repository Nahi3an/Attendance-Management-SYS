<?php

if(isset($_POST['createattendancesheet'])){

   
    $courseCode = $_POST['courseCode'];
    $assignedDate = $_POST['assingedDate'];


    $courseCode = explode(" - ", $courseCode);
   // echo  $assignedDate." ".$courseCode[0];
    //$assignedDate = explode("-",$assignedDate);

    if($assignedDate==""){
        
        header("location: ../admin-attendance-sheet.php?value=nodateselected");

    }else{
        echo "ok";

        require_once 'dbh-inc.php';
        require_once 'function-inc.php';

        $courseInfo = showSingleCourseInfo($conn,$courseCode[0]);
        
        $sameattendanceExists = checkForSameAttendace($conn, $courseInfo['courseId'], $assignedDate);

        if($sameattendanceExists){

            header("location: ../admin-attendance-sheet.php?value=sameattendanceexists");
        }else{

            $adminInfo = getAdminInfo($conn);
            createAttendanceSheet($conn,$adminInfo['userId'],  $courseInfo['courseId'], $assignedDate);


        }

    }

    

    
  

   


}else{

        header("location: ../admin-attendance-sheet.php");
    
}


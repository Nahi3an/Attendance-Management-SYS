<?php

    
if(isset($_POST['addstudentcourse'])){

    $studentId = $_POST['studentId'];
    $courseCode = $_POST['courseCode'];

   
    $courseCode = explode(" - ", $courseCode);
    echo $studentId." ".$courseCode[0];

    require_once 'dbh-inc.php';
    require_once 'function-inc.php';

    $alreadyAdded = checkForStudentInCourse($conn,$studentId,$courseCode[0]);
    $courseNumber = checkNumberOfCourseEnrolled($conn,$studentId);

    

    if($courseNumber<4){

        if($alreadyAdded){
            header("location: ../admin-student.php?value=studentalreadyadded");
        }
    
        if(!$alreadyAdded ){
    
            $output =  addStudentToaCourse($conn,$studentId,$courseCode[0]);
    
            if($output){
    
                header("location: ../admin-student.php?value=studentadded");
    
            }
    
        }

    }else{
        
        header("location: ../admin-student.php?value=maximumcourselimit");

    }

}else {
    
      header("location: ../admin-student.php");

}
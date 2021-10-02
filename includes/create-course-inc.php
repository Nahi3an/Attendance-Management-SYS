<?php


if(isset($_POST["createnewcourse"])){


    $courseCode = $_POST['courseCode'];
    $courseTitle = $_POST['courseTitle'];

    //echo  $courseTitle." ".$courseCode;

    require_once 'dbh-inc.php';
    require_once 'function-inc.php';

    
    $courseExists = showSingleCourseInfo($conn,$courseCode);
   


    // $courseExists =  courseExists($conn,$courseCode);

    

  
    if($courseExists!=0){

        header("location: ../admin-course.php?value=coursexists");

    }else{
        $newCourseCreated = createCourse($conn, $courseCode,$courseTitle);

        if($newCourseCreated){

            header("location: ../admin-course.php?value=coursecreated");
        }
        
    }
    
 
}else{

    header("location: ../admin-course.php");
}
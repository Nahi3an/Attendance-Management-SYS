<?php

    
if(isset($_POST['updatecourseinfo'])){

   
    $courseId = $_POST['courseId'];
    $courseCode = $_POST['courseCode'];
    $courseTitle = $_POST['courseTitle'];

    $courseTitle = explode('-', $courseTitle);
    echo $courseTitle[0];

    require_once 'dbh-inc.php';
    require_once 'function-inc.php';

   
    $output = updateSingleCourseInfo($conn, $courseId,$courseTitle);
    
    if($output!=0){
        header("location: ../admin-course.php?value=courseinfosaved");
    }else{

        header("location: ../admin-course.php?value=nocoursetochange");
    }

  
}else {

      header("location: ../admin-course.php");

}
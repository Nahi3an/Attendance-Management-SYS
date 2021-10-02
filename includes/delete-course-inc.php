<?php

    if(isset($_POST["deletecourse"])){


        $courseCode = $_POST['courseCode'];


        $courseCode = explode(" - ",$courseCode);
       
    
        require_once 'dbh-inc.php';
        require_once 'function-inc.php';
    
        
        $courseInfo = showSingleCourseInfo($conn,$courseCode[0]);

       if($courseInfo!=0){

        $courseDeleted = deleteCourse($conn,$courseInfo['courseId']);

      
        if($courseDeleted){
    
            header("location: ../admin-course.php?value=coursedeleted");
    
        }else{
         
           
    
                header("location: ../admin-course.php?value=coursedeletingwentwrong");
            
            
        }

       }else{

                header("location: ../admin-course.php?value=deletingcoursenotfoud");

       }
        
       
        
     
    }else{
    
        header("location: ../admin-course.php");
    }

?>
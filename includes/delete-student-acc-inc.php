<?php

    if(isset($_POST["deletestudent"])){


        $studentId = $_POST['studentId'];
    
    
        require_once 'dbh-inc.php';
        require_once 'function-inc.php';
    
        
        $studnentInfo = showSingleStudetInfo($conn,$studentId);

       if($studnentInfo!=0){

        $userInfo = showAllStudents($conn);
        $userId = "";

        foreach($userInfo as $user){
            
            if($user['studentId']==$studentId){

                $userId = $user['userId'];
            }
          
        }

        $studentDeleted = deleteStudentInfo($conn,$studentId,$userId);

        if($studentDeleted){
    
            header("location: ../admin-student.php?value=studentdeleted");
    
        }else{
         
           
    
                header("location: ../admin-student.php?value=studentdeletingwentwrong");
            
            
        }

       }else{

                header("location: ../admin-student.php?value=deletingstudentnotfoud");

       }
        
       
        
     
    }else{
    
        header("location: ../admin-course.php");
    }

?>
<?php

include_once './dbh-inc.php';
include_once './function-inc.php';
//echo 'ok';
if(isset($_POST['updateStudentInfo'])){


    //echo   $userId;


  

    $updated = updateOwnStudentInfo($conn,$newUsername,$newEmail,$newFullName,$studentId,$userId);

    

    if($updated==1){
        
        header("location: ../student-info.php?value=owninfoupdated");

    }else{

        header("location: ../student-info.php?value=owninfoupdatederror");
        
    }
    
    
}else if($_POST['updateStudentPass']){

    $oldPass = $_POST['pwdOld'];
    $newPass = $_POST['pwdNew'];
    $userId = $_POST['userId'];


  

    $pwdChanged = changeStudentPass($conn,$oldPass,$newPass,$userId);

   
    
    if($pwdChanged==1){
        
        header("location: ../student-info.php?value=passChanged");

    }else{
        header("location: ../student-info.php?value=somethingwentwrong");
    }


}
else{

    header("location: ../student-info.php");

}
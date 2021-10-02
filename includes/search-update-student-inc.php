<?php


include_once './dbh-inc.php';
include_once './function-inc.php';

if(isset($_POST['updateStudentInfo'])){

    $newUsername = $_POST['newUsername'];
    $newEmail= $_POST['newEmail'];
    $newFullName= $_POST['newFullName'];
    $studentId= $_POST['studentId'];
    $userId= $_POST['userId'];

    $updated = updateOwnStudentInfo($conn,$newUsername,$newEmail,$newFullName,$studentId,$userId);

    if($updated==1){
        
        header("location: ../admin-student.php?value=owninfoupdated");

    }else{

        header("location: ../admin-student.php?value=owninfoupdatederror");
        
    }
  
}else {
    header("location: ../admin-student.php?");
}
<?php


if(isset($_POST["createnewuser"])){

    $studentId = $_POST['stdid'];
    $uniEmail = $_POST['uniemail'];
    $pwd= $_POST['pwd'];
    $pwdRepeat = $_POST['repeatpwd'];
 
    require_once 'dbh-inc.php';
    require_once 'function-inc.php';

    $userInfo =  showSingleStudetInfo($conn,$studentId);
    $userExists = checkUserExists($conn,$userInfo['userId']);

   
    // //cehck in student table 
    
    if($userExists){
        header("location: ../admin-student.php?value=userexists");
    }

    if(!$userExists){
       
        $newUserCreated = createUser($conn, $studentId, $userName, $fullName,$uniEmail, $personalEmail, $pwd,$pwdRepeat);

        if($newUserCreated){

            header("location: ../admin-student.php?value=usercreated");
        }
        
    }
    
    
 
}else{

    header("location: ../admin-student.php");
}
<?php

if(isset($_POST['giveattandence'])){
   
    $studentId = $_POST['studentId'];
    $attnId = $_POST['attnId'];
    $todaysDate = $_POST['todaysDate'];


    include_once './dbh-inc.php';
    include_once './function-inc.php';

    $sameAttnInstance = checkForAttnInstance($conn,$studentId,$attnId,$todaysDate);

    

    if($sameAttnInstance==0){
        
        $output = giveAttendance($conn,$studentId,$attnId);

    }else{

        header("location: ../student.php?value=sameAttnExist");
    }
    
    

}
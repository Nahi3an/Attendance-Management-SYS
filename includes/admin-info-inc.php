<?php

include_once './dbh-inc.php';
include_once './function-inc.php';

if(isset($_POST['updateInfo'])){
   
    $newUsername = $_POST['newUsername'];
    $newEmail= $_POST['newEmail'];
    $oldEmail= $_POST['oldEmail'];

    $updated = updateAdminInfo($conn,$newUsername,$newEmail,$oldEmail);

    

    if($updated==1){
        
        header("location: ../admin-info.php?value=infoUpdated");

    }else{

        header("location: ../admin-info.php?value=infoUpdatedError");
        
    }
    
    

}elseif($_POST['updateAdminPass']){

    $oldPass = $_POST['pwdOld'];
    $newPass = $_POST['pwdNew'];
    $uniEmail = $_POST['uniEmail'];


    echo $oldPass." ".$newPass." ".$uniEmail;

    $pwdChanged = changeAdminPass($conn,$oldPass,$newPass,$uniEmail);

    
    if($pwdChanged==1){
        
        header("location: ../admin-info.php?value=passChanged");

    }


}
else{

    header("location: ../admin-info.php");

}
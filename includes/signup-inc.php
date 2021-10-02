<?php

if(isset($_POST["submit"])){

    
    $id = $_POST['stdid'];
    $userName = $_POST['username'];
    $fullName = $_POST['fullname'];
    $uniEmail = $_POST['uniemail'];
    $personalEmail = $_POST['personalemail'];
    $pwd=$_POST['pwd'];
    $pwdRepeat = $_POST['repeatpwd'];

    if($id=="" or $uniEmail=="" or $pwd==""){

        header("location: ../signup.php?value=fieldcannotbeempty");
    }else{
        
        if($pwd==$pwdRepeat){
            require_once 'dbh-inc.php';
            require_once 'function-inc.php';
    
            
            $userInfo =  showSingleStudetInfo($conn,$id);
            if($userInfo!=0){

                header("location: ../signup.php?value=userexists");
                exit();
            }
         
                $userCreated = createUser($conn, $id, $userName, $fullName,$uniEmail, $personalEmail, $pwd,$pwdRepeat);
    
                if($userCreated){
    
                    header("location: ../signup.php?value=signedup");
                }
                
            
        }else{
                
                header("location: ../signup.php?value=passdontmatch");
        }
        
    }

    


    }
    else{


    header("location: ../signup.php");
}


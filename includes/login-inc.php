<?php


if(isset($_POST["login"])){
    
    $uniEmail = $_POST['email'];
    $pwd= $_POST['pwd'];

    require_once 'dbh-inc.php';
    require_once 'function-inc.php';

  
    validateLogin($conn, $uniEmail, $pwd);
 
}else{


    header("location: ../login.php");
}
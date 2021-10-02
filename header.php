<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <title>Student Attendance Management System</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">S.A.M.S</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="./index.php">Home</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="./signup.php">Signup</a>
                </li>
                <li class="nav-item">
                    <?php
                        session_start();
                        
                        if(isset($_SESSION['username'])){
                            if($_SESSION['username']=='admin'){
                                echo "<a class='nav-link' href='./admin.php'>".$_SESSION['username']."</a>";
                            }else if($_SESSION['username']=='Not set'){

                                echo "<a class='nav-link' href='./student.php'>".$_SESSION['username']."</a>";
                                
                            }
                           
                        }else{
                            echo "<a class='nav-link' href='./login.php'>Login</a>";
                        }
                       
                    ?>
                </li>
                <li class="nav-item">
                    <?php
                        
                        if(isset($_SESSION['username'])){
                            echo "<a class='nav-link' href='./includes/logout-inc.php'>Logout</a>";
                        }
                       
                    ?>
                </li>
            </ul>
        </div>
    </nav>
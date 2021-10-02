
<?php

    // if(!defined('ACCESS')){

    //     header('location:./login.php');
    //     die();
    // }
    
    include './header.php';

    if(!isset($_SESSION['loggedIn'])){

        header('location:./login.php');
    }
?>



<section class="container admin-page">

<h1 class="text-center mt-2">Welcome 
        <?php
            if(isset($_SESSION['username'])){
                echo $_SESSION['username'];
            }
?></h1>

    
  <div class="row">
  <div class="col-sm-6  mt-5">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Manage Student Info</h5>
        <p class="card-text">Add Delete Update Student Information & Assign Students To Courses.</p>
        <a href="./admin-student.php" class="btn btn-primary">GO</a>
      </div>
    </div>
  </div>
  <div class="col-sm-6 mt-5">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Manage Course Info</h5>
        <p class="card-text">Delete Course, Create New Course & Assign Courses To Students According to their Id.</p>
        <a href="./admin-course.php" class="btn btn-primary">GO</a>
      </div>
    </div>
  </div>
</div>


<div class="row">
  <div class="col-sm-6 mt-5">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Attendance Sheet</h5>
        <p class="card-text">Generate Attendance Sheet For A Course of Any Day So That Students Can Give Attendace </p>
        <a href="./admin-attendance-sheet.php" class="btn btn-primary">GO</a>
      </div>
    </div>
  </div>
  <div class="col-sm-6 mt-5">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Attendance Report</h5>
        <p class="card-text">Generate Attendance Report Of A Student Daily, Range Of Days (Weekly/Monthly)</p>
        <a href="./admin-attendance-report.php" class="btn btn-primary">GO</a>
      </div>
    </div>
  </div>
</div>


<div class="row">
  <div class="col-sm-6 mt-5">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Edit Admin Info</h5>
        <p class="card-text">Edit and Update Admin Information & Change Password</p>
        <a href="./admin-info.php" class="btn btn-primary">GO</a>
      </div>
    </div>
  </div>
</div>

</section>
<?php
    include_once './footer.php';
?>

<h5>Delete Student Account</h5>

<?php

        include_once "./includes/dbh-inc.php";
        include_once "./includes/function-inc.php";

?>

<form action='./includes/delete-student-acc-inc.php' method='POST'>
  <div class="form-row">
    <div class="col">
    <select name="studentId" class="form-control">
          
          <?php 

                $outputs = showAllStudents($conn);


                for($i=0;$i<sizeof($outputs);$i=$i+1)
                echo "<option>".$outputs[$i]['studentId']."</option>";


          ?>
          </select>     
    </div>
    <div class="col">
    <input type='submit' name='deletestudent' class="btn btn-danger" value ='deletestudent'> 
    </div>
  </div>
</form>



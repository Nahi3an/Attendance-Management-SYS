<h5>Delete Course</h5>

<?php

            include_once "./includes/dbh-inc.php";
           include_once "./includes/function-inc.php";

?>


<form action='./includes/delete-course-inc.php' method='POST'>
  <div class="form-row">
    <div class="col">
        <select name="courseCode" class="form-control">
            
                <?php 

                $res= showAllCoursesInfo($conn);


                for($i=0;$i<sizeof($res);$i=$i+1)
                echo "<option>".$res[$i]['courseCode']." - ".$res[$i]['courseTitle']."</option>";


                ?>  
        </select>     
    </div>
    <div class="col">
        <input  type='submit' name='deletecourse' value ='deletecourse' class="btn btn-danger"> 
    </div>
  </div>
</form>
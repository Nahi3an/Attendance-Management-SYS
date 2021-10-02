
<h5>Assign Student To Course</h5>

        
<form action="./includes/add-student-to-course-inc.php" method="POST">
     <div class="form-row">
        <div class="col">
            <select name="studentId" class="form-control" >
                
                <?php 
                    include_once "./includes/dbh-inc.php";
                    include_once "./includes/function-inc.php";
                    $outputs = showAllStudents($conn);
                
                    //echo $outputs[0]['studentId'];

                    
                    
                    for($i=0;$i<sizeof($outputs);$i=$i+1)
                    echo "<option>".$outputs[$i]['studentId']."</option>";

                ?>
            </select>
        </div>
        <div class="col">
            <select name="courseCode" class="form-control" >
        
            <?php 
                $outputs = showAllCoursesInfo($conn);
                
                for($i=0;$i<sizeof($outputs);$i=$i+1)
                echo "<option>".$outputs[$i]['courseCode']." - ".$outputs[$i]['courseTitle']."</option>";

            ?>
        </select>
        </div>
        <div class="col">
            
            <button type="submit" name="addstudenttocouse" class="btn btn-info">Add Student to Course</button>
        </div>
    </div>

</form>
   
    
    
   
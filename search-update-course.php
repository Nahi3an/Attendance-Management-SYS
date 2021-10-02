<h5>Search Course Info</h5>
  
    <form action="#" method="GET">
    <div class="form-row">
        <div class="col">
        <input type="text" name="courseCode" class="form-control"  placeholder="Enter Course Code">
        
    </div>
        <div class="col">
        <button type="submit" class=" btn btn-info" name="searchcourseinfo">Search</button>
    </div>
    </div>
    </form>
        <br>
        <?php 
        
        if(isset($_GET["searchcourseinfo"])){


            
            $courseCode = $_GET['courseCode'];

            include_once "./includes/dbh-inc.php";
            include_once "./includes/function-inc.php";

            $output = showSingleCourseInfo($conn,$courseCode);
          



            if($output!=0){

                echo "<table class='table table-hover'>";
                echo "<tr class='table-primary'>";
                foreach(array_keys($output) as $keys){
                        if($keys!='studentId'){
                            echo "<th>".$keys."</th>";
                        }
                        
                    }
                echo "</tr>";
                echo "<tr class='table-primary'>";
                echo "<td>".$output['courseId']."</td>";
                echo "<td>".$output['courseCode']."</td>";
                echo "<td>".$output['courseTitle']."</td>";
                echo "<td>".$output['numberOfStudents']."</td>";

                echo "</tr>";
                echo "</table>";

                echo "<br>";

                echo "<table class='table table-hover'>";
                echo "<tr class='table-primary'>";
               
                    echo "<th>Enrolled Students ID</th>";
                
                echo "</tr>";
                if(sizeof($output['studentId'])>0){
                    foreach($output['studentId'] as $studentId){
                        echo "<tr class='table-primary'>";
                        echo "<td>".$studentId."</td>";
                        echo "</tr>";
                    }
                }else{
                    echo "<tr class='table-primary'><td>No Students Enrolled</td></tr>";
                }
               
               
                echo "</table>";

                echo "<br>";

              


            }else{

               echo "<h5>No Course found</h5>";

            }
            

 
            
        
        }
        ?>
        
    
   

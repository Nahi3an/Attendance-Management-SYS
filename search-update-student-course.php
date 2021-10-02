
<div class="border p-2">
<h5>Search Student Course Info</h5>
<?php $courseNotFound = false ;
     $studentId = "" ?>
 
    <form action="#" method="post">
      <div class="form-row">
        <div class="col">
        <input type="text" name="studentId" class="form-control" placeholder="Enter Student ID">
        </div>
        <div class="col">
        <button type="submit" name="searchstudentcourse" class="btn btn-info">Search</button>
        </div>
      </div>
    </form>
    <br>
        <?php 
           include_once "./includes/dbh-inc.php";
           include_once "./includes/function-inc.php";

        if(isset($_POST["searchstudentcourse"])){
          
            
          $studentId = $_POST['studentId'];
            
          if($studentId != ""){
        
          
            $outputs = showSingleStudetCourseInfo($conn,$studentId);
              
            if(sizeof($outputs)>0){

              echo "<table class='table table-hover'>";
              echo "<tr class='table-primary'>";
                  echo "<th>StudentID</th>";
                  echo "<th>FullName</th>";
            echo "</tr>";
            echo "<tr class='table-primary'>";
                  echo "<td>".$outputs[0]['studentId']."</td>";
                  //echo "<td>{$outputs[0]['fullName']}</td>";

                  if($outputs[0]['fullName']==""){
                  echo "<td>Not Given</td>";
                  }else{
                    echo "<td>{$outputs[0]['fullName']}</td>";
                  }
                  echo "</tr>";
            echo "</table>";

            echo "<br>";
          
          

        
              echo "<table class='table table-hover'>";
              echo "<tr class='table-primary'>";
              echo "<th>Course Code</th>";
              echo "<th>Course Title</th>";
              echo "</tr>";
              for($i=0;$i<sizeof($outputs);$i=$i+1){
                echo "<tr class='table-primary'>";
                if($outputs[$i]['courseCode']=="" or $outputs[$i]['title']==""){
                  echo "<td>No Course Assgined</td>";
                  echo "<td>No Course Assigned</td>";
                  break;
                }
                echo "<td>".$outputs[$i]['courseCode']."</td>";
                echo "<td>".$outputs[$i]['title']."</td>";;
               
                echo "</tr>";
              }
              echo "</table>";

              echo "<br>";
             

            }
          }else{
            echo "<h5>Enter a Student Id</h5>";
          }
           
        }
      
      ?>
    
</div>

<div class="border p-2">
          
    <h5>Assign Course to Student</h5>
       
      <form action='./includes/update-student-course-inc.php' method='POST'>
          <div class="form-row">
            <div class="col">
            <input type="text" name="studentId" class="form-control" value="<?php echo  $studentId;?>">
          
          </div>
          <div class="col">
          <select name="courseCode" class="form-control">
                
                <?php 

                    $res= showAllCoursesInfo($conn);
                  

                    for($i=0;$i<sizeof($res);$i=$i+1)
                    echo "<option>".$res[$i]['courseCode']." - ".$res[$i]['courseTitle']."</option>";


                ?>
                </select>
          </div>
        <div>
          <input type='submit' class="btn btn-info" name='addstudentcourse' value ='save'> 
        </div>
        </div>
      </form>


</div>
      
   

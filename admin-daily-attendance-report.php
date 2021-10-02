<?php 
    $onDate = "";?>
  <form action="#" method="POST">
        <div class="form-row">
            <div class="col">
                <select name="studentId" class="form-control">

                    <?php 

                        for($i=0;$i<sizeof($outputs);$i=$i+1)
                        echo "<option>".$outputs[$i]['studentId']."</option>";

                    ?>

                </select>
            </div>
        
            <div class="col">
                 <input type="date" name="onDate" class="form-control"> 
            </div>
            <div class="col">
           
            <input type="submit" name="showreportdaily" class="btn btn-info"value="Show Report">
            </div>
        </div>

    </form>
    <?php

     
if(isset($_POST['showreportdaily'])){

  
    $studentId = $_POST['studentId'];
   

    $onDate = $_POST['onDate'];

    echo "<br>";

    if($onDate==""){   
        
        
      
        echo "<h5>No Date Selected</h5>";
    }else {
    
        
        echo "<br><h6>Attendance Report of : {$onDate} </h6><br>";
        $reports = getAttendanceReportDaily($conn,$studentId,$onDate);
        if(sizeof($reports)>0){
            
            $numberOfPresentDays = sizeof($reports);
            echo "<table class='table table-hover'>";
            echo "<tr class='table-primary'>
                <th>Attended Course Id</th>
                <th>Attended Course Title</th>
                <th>Date</th>

                </tr>";
            foreach($reports as $report){

                $attendedCourseInfo = getAttendedCourses($conn,$report['attendanceId']);

                if($attendedCourseInfo!=0){
                    //echo $attendedCourseInfo['courseCode']." ".$attendedCourseInfo['courseTitle'];
                    echo "<tr class='table-primary'>
                    <td>{$attendedCourseInfo['courseCode']}</td>
                    <td>{$attendedCourseInfo['courseTitle']}</td>
                    <td>{$report['createdDate']}</td>

                    </tr>";
                }
            

            }
            echo"</table>";
        


        }


    }
}


?>


   



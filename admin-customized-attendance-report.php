<h5>See Customizied Date Attandance Report</h5>
  <br>
  <form action="#" method="post">
        <label for="studentId"><h6>Student ID:</h6></label>   
        <select name="studentId" class='form-control'>
        
            <?php 

                for($i=0;$i<sizeof($outputs);$i=$i+1)
                echo "<option>".$outputs[$i]['studentId']."</option>";

            ?>
        </select><br>
        <label for="fromDate bold"><h6>From Date:</h6></label>
        <input type="date" name="fromDate"  class='form-control'><br> 
        <label for="toDate"><h6>To Date:</h6></label>
        <input type="date" name="toDate"  class='form-control'> <br>
        <input type="submit" name="showreport" class="btn btn-info" value="Show Report">

  </form>
        <?php
                $attendedCourses = "";
                $numberOfPresentDays = "";
                if(isset($_POST['showreport'])){


                    $studentId = $_POST['studentId'];
                    //$attnId = $_POST['attnId'];

                    $fromDate= $_POST['fromDate'];
                    $toDate = $_POST['toDate'];
                    

                    if($fromDate=="" or $toDate==""){
                    
                        //header("location: ../admin-attendance-report.php?value=nodateselected");
                        echo "<h5>No Date Selected</h5>";
                        
                    }else {
                    
                        //get attnfrom attninstance tabel : 
                        echo "<br><h6>Attendance Report From : {$fromDate} to {$toDate}</h6><br>";
                        $reports = getAttendanceReport($conn,$studentId,$fromDate,$toDate);
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
                                    
                                    echo "<tr class='table-primary'>
                                            <td>{$attendedCourseInfo['courseCode']}</td>
                                            <td>{$attendedCourseInfo['courseTitle']}</td>
                                            <td>{$report['createdDate']}</td>
                                          </tr>";
                                }
                            

                            }
                            echo"</table>";
                           


                        }else {
                            echo "<h5>No Report Found On this Date Interval</h5>";
                        }



                    }
                }
            
        ?>
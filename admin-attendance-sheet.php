<?php
    include './header.php';
?>

 <div class="container">
     <br>
    <h2>Generate Attendence Sheet</h2><br>
    <form action="./includes/admin-attendance-sheet-inc.php" method="POST">
        <div class="form-row">
            <div class="col">
                <select name="courseCode" class="form-control" >
                
                    <?php 

                        include_once "./includes/dbh-inc.php";
                        include_once "./includes/function-inc.php";


                        $outputs = showAllCoursesInfo($conn);
                        
                        for($i=0;$i<sizeof($outputs);$i=$i+1)
                        echo "<option>".$outputs[$i]['courseCode']." - ".$outputs[$i]['courseTitle']."</option>";

                    ?>

                </select>
            </div>
            <div class="col">
            <!-- <label for="assignedDate">Select Date:</label> -->
                <input type="date" name="assingedDate" class="form-control"> 
            </div>
            <div class="col">
                
                <button type="submit" name="createattendancesheet" class="btn btn-info">Generate Attendance Sheet</button>
            </div>
        </div>

    </form>
 


<?php
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')  {
            $url = "https://";   
        }
        else {
            $url = "http://";   
        }
          
        $url.= $_SERVER['HTTP_HOST'];   
         
        $url.= $_SERVER['REQUEST_URI'];   

        $url_components = parse_url($url);
        
        if(sizeof($url_components)>3){

            if(isset($_GET['value'])){
                
                if($_GET['value'] =='attendancecreated'){
                    echo "<br>";
                    echo "<h5>Attendance Sheet Created For This Course</h5>";
                }
                if($_GET['value'] =='nodateselected'){
                    echo "<br>";
                    echo "<h5>No Date Selected</h5>";
                }

                if($_GET['value'] =='sameattendanceexists'){
                    echo "<br>";
                    echo "<h5>Attendance Already Exists</h5>";
                }

                
            }
              
           
        }

    ?>
</div>
   
<?php
    include_once './footer.php';
?>

<?php
   
    include_once './header.php';

    if(!isset($_SESSION['loggedIn'])){

        header('location:./login.php');
    }

    
    

    date_default_timezone_set('Asia/Kolkata');
    $todaysDate = date("Y-m-d");
   
  

    include_once './includes/dbh-inc.php';
    include_once './includes/function-inc.php';
    $allStudents = showAllStudents($conn);
    $studentId="";
    foreach($allStudents as $student){

        if($student['userId']==$_SESSION['userId']){

            $studentId = $student['studentId'];
        }
    }



    $courseInfo = showSingleStudetCourseInfo($conn,$studentId);
    $enrolledCourseId = array();
    $attendanceResult = "";
    $enrolledCourseInfo= array();

?>



<div class="container">
    <br>
     <h2>Welcome 
          <?php if($_SESSION['username'] =='Not Set' ){
                            echo "User";
                 }else{
                        echo $_SESSION['username'];
                 }
     ?></h2>
      <h3>Date: <?php echo $todaysDate?></h3>
     <br>
    <?php

   
    
    
    if(sizeof($courseInfo)>0){

     
        echo "<h5>Your Enrolled Courses:</h5>";
        echo "<table class='table table-hover'>";
            echo "<tr class='table-info'>";
            echo "<th>Course Code</th>";
            echo "<th>Course Title</th>";
            echo "</tr>";
        
        $res;
        for($i=0;$i<sizeof($courseInfo);$i=$i+1){
            echo "<tr class='table-info'>";
            echo "<td>".$courseInfo[$i]['courseCode']."</td>";
            echo "<td>".$courseInfo[$i]['title']."</td>";
            echo "</tr>";
            $res = array('courseId'=>$courseInfo[$i]['courseId'],'courseCode'=>$courseInfo[$i]['courseCode'],'courseTitle'=>$courseInfo[$i]['title']);
            array_push($enrolledCourseId,$courseInfo[$i]['courseId']);
            array_push($enrolledCourseInfo,$res);

        }
        echo "<table>";

       
        
        if(sizeof($enrolledCourseId)>0){

            $attendanceResult= checkCourseInAttendance($conn,$todaysDate);

       }
        
       
    
    }else {

        echo "<h4>You are not enrolled in any course</h4>";
       
    }
   

   
    

    ?>

    <br>
    <section class="attandance-courses">
        
    <?php
        
        $showTitle = 1;
        echo "<h5>Todays Attendence Sheet</h5>";
        echo "<table class='table table-hover'>";
        echo "<tr class='table-primary'>
                                <th>Course Code</th>
                                <th>Course Title</th>
                                <th>Present</th>

                              </tr>";
        for($i=0; $i<sizeof($enrolledCourseInfo); $i++){
           
      
          
            foreach($attendanceResult as $attnRes){

                    
                    if($enrolledCourseInfo[$i]['courseId']==$attnRes['courseId']){
                     
                       echo "<tr class='table-primary'>
                              <td>{$enrolledCourseInfo[$i]['courseCode']}</td>
                              <td>{$enrolledCourseInfo[$i]['courseTitle']}</td>
                              <td>
                              <form action='./includes/student-inc.php' method='post'>
                                <input type='hidden' name='todaysDate' class='form-control' value ='{$todaysDate}'>
                                <input type='hidden' name='studentId' class='form-control' value ='{$studentId}'>
                                <input type='hidden' name='attnId' value ='{$attnRes['attnId']}'>
                                <button type='submit' name='giveattandence' class='btn btn-info'>Present</button>
                              </form>
                              </td>
                              </tr>";
                    }

                   
                       
                    
                
                     
                }
               
        }
        echo "</table>";



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

            //parse_str($url_components['query'], $params);
            if(isset($_GET['value'])){
                
                if($_GET['value']=='attendancegiven'){
    
                    echo "<h5>Attendance Submitted</h5>";
                }
                
    
                 
                if($_GET['value']=='sameAttnExist'){
    
                    echo "<h5>Cannot Give Attendance  Twice</h5>";
                }
            }
              
           
        }
      

        ?>
    </section>

    <a href="./student-info.php" class="btn btn-info">Edit Student Info</a>

    
    
</div>



<?php
    include './footer.php';
?>

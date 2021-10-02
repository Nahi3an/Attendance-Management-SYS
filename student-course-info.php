<h5>Student & Course Info</h5>
<form action="#" method="post">
    <button type="submit" name="courseinfo"  class="btn btn-info">Student Course Enronlment</button>
</form>
<br>

<?php 
    if(isset($_POST["courseinfo"])){

        include_once "./includes/dbh-inc.php";
        include_once "./includes/function-inc.php";

        $outputs = showStudentCourses($conn);
     
        echo "<table class='table table-hover'>";
            echo "<tr class='table-primary'>";
            foreach(array_keys($outputs[0]) as $keys){
                
                    echo "<th>".$keys."</th>";
                 }
            echo "</tr>";
        

        for($i=0;$i<sizeof($outputs);$i=$i+1){

            echo "<tr class='table-primary'>";
            echo "<td>".$outputs[$i]['studentId']."</td>";
            echo "<td>".$outputs[$i]['fullName']."</td>";
            echo "<td>".$outputs[$i]['courseCode']."</td>";
            echo "<td>".$outputs[$i]['title']."</td>";
          
            echo "</tr>";

                     
        }
        echo "<table>";
        
    }
?>
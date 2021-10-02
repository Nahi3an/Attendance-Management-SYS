
<h5>See All Course Info</h5>
<form action="#" method="get">
<button type="submit" name="courseinfo" class="btn btn-info">See All Course Info</button>
</form>

<?php 
    if(isset($_GET["courseinfo"])){

       
        include_once "./includes/dbh-inc.php";
        include_once "./includes/function-inc.php";
        
        $outputs = showAllCoursesInfo($conn);

        if(sizeof($outputs)>0){

            echo "<table class='table table-hover'>";
            echo "<tr class='table-primary'>";
                foreach(array_keys($outputs[0]) as $keys){
                    
                        echo "<th>".$keys."</th>";
                    }
                echo "</tr>";
        
            for($i=0;$i<sizeof($outputs);$i=$i+1){
                echo "<tr class='table-primary'>";
                echo "<td>".$outputs[$i]['courseCode']."</td>";
                echo "<td>".$outputs[$i]['courseTitle']."</td>";
                echo "<td>".$outputs[$i]['numberOfStudents']."</td>";
                echo "</tr>";

            }
       
            echo "</table>";

        }
        
        
       
    }
?>
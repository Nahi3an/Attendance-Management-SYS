
<form action="#" method="post">
<button type="submit" name="studentinfo" class="btn btn-info">See All Student Info</button>
</form>
<br>


<?php 
    if(isset($_POST["studentinfo"])){

        include_once "./includes/dbh-inc.php";
        include_once "./includes/function-inc.php";
       
        $outputs = showAllStudents($conn);
        
        echo "<table class='table table-hover'>";
            echo "<tr class='table-primary'>";
            foreach(array_keys($outputs[0]) as $keys){

                if($keys!='pwd'){
                    echo "<th>".$keys."</th>";
                }
                    
                    
                 }
            echo "</tr>";
        
        
        
        for($i=0;$i<sizeof($outputs);$i=$i+1){
            echo "<tr class='table-primary'>";
            echo "<td>".$outputs[$i]['userId']."</td>";
            echo "<td>".$outputs[$i]['studentId']."</td>";
            if($outputs[$i]['userName']==""){
                echo "<td>Not Given</td>";
            }else{
                echo "<td>".$outputs[$i]['userName']."</td>";
            }
            if($outputs[$i]['fullName']=="" ){
                echo "<td>Not Given</td>";
            }else{
                echo "<td>".$outputs[$i]['fullName']."</td>";
            }
            echo "<td>".$outputs[$i]['email']."</td>";
            if($outputs[$i]['personalEmail']=="" ){
                echo "<td>Not Given</td>";
            }else{
                echo "<td>".$outputs[$i]['personalEmail']."</td>";
            }
            echo "</tr>";

            //'studentId'=>$row['studentId'],'userName'=>$row['userName'],'fullName'=>$row['fullName'],'email'=>$row['email'],'personalEmail'=>$row['personalEmail'],'pwd'=>$row['pass']
        }
       
        echo "</table>";
       
    }
?>
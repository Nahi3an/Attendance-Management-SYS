<h5>Search Student Info !</h5>
    <form action="#" method="POST">
        <input type="text" name="stdid" placeholder="Enter Student ID"><br>
       
        <button type="submit" name="searchstudentinfo">Search</button>
        </form>
        <?php 

      
        
        if(isset($_POST["searchstudentinfo"])){

            
            $studentId = $_POST['stdid'];

            include_once "./includes/dbh-inc.php";
            include_once "./includes/function-inc.php";

           

            $output = showSingleStudetInfo($conn,$studentId);
            $userId = $output['userId'];
            $studentId = $output['studentId'];

            
            if($output!=0){
                echo "<table border=1>";
                echo "<tr>";
                foreach(array_keys($output) as $keys){
    
                    if($keys!='pwd'){
                        echo "<th>".$keys."</th>";
                    }
                        
                        
                     }
                echo "</tr>";
                
                echo "<tr>";
                echo "<td>".$output['userId']."</td>";
                echo "<td>".$output['studentId']."</td>";
                if($output['userName']==""){
                    echo "<td>Not Given</td>";
                }else{
                    echo "<td>".$output['userName']."</td>";
                }
                if($output['fullName']=="" ){
                    echo "<td>Not Given</td>";
                }else{
                    echo "<td>".$output['fullName']."</td>";
                }
                echo "<td>".$output['uniEmail']."</td>";
                if($output['personalEmail']=="" ){
                    echo "<td>Not Given</td>";
                }else{
                    echo "<td>".$output['personalEmail']."</td>";
                }
                echo "</tr>";
                echo "</table>";
                

                echo "<button name ='editstudentinfo'>Edit</button>";
        
                
            }else{
                echo "<p>No User found</p>";
            }

        }
        ?>

        <!-- <form action="./includes/search-update-student.php" method="post">
                <h5>Update Student Info </h5>
                <input type="hidden" name="studentId" value="<?php echo $studentId?>">
                <input type="hidden" name="userId" value="<?php echo  $userId ?>">
                <input type="text" name="newUsername" placeholder="Enter New UserName"><br>
                <input type="text" name="newFullName" placeholder="Edit Full Name"><br>
                <input type="email" name="newEmail" placeholder="Enter New Personal Email"> <br>
                <input type="password" name="pwd" placeholder="Enter Password"> <br>
                <input type="password" name="repeatpwd" placeholder="Repeat Password"> <br>
                <input type="submit" name="updateStudentInfo" value="save">
        </form> -->
        
    
   

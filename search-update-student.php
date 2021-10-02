<div class="border border p-2">
    <?php $studentId = "(Search For A Student First) "?>
<h5>Search Student Info</h5>
        <br>

        <form action="#" method="POST" class="">
            <div class="form-row">
                <div class="col">
                <input type="text" name="stdid" class="form-control" placeholder="Enter Student ID">
                </div>
                <div class="col">
                <button type="submit" name="searchstudentinfo" class="btn btn-info">Search</button>
                </div>
            </div>
        </form>
        <br>
        <?php 

      
        
        if(isset($_POST["searchstudentinfo"])){

            
            $studentId = $_POST['stdid'];

            include_once "./includes/dbh-inc.php";
            include_once "./includes/function-inc.php";

           

            $output = showSingleStudetInfo($conn,$studentId);
      
            
            if($output!=0){

                $userId = $output['userId'];
                $studentId = $output['studentId'];
    
                echo "<table class='table table-hover'>";
                echo  "<tr class='table-primary'>";;
                foreach(array_keys($output) as $keys){
    
                    if($keys!='pwd'){
                        echo "<th>".$keys."</th>";
                    }
                        
                        
                     }
                echo "</tr>";
                
                echo  "<tr class='table-primary'>";;
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
                      
            }else{
                echo "<h5>No User found</h5>";
            }

        }
        ?>
</div>
<div class="border p-2 mt-1">
        <form action="./includes/search-update-student-inc.php" method="post">
                <br>
                <h5>Update Student Info : <?php echo $studentId?> </h5>
                <input type="hidden" name="studentId" value="<?php echo $studentId?>">
                <input type="hidden" name="userId" value="<?php echo  $userId ?>">
                <input type="text" name="newUsername" class="form-control" placeholder="Enter New UserName"><br>
                <input type="text" name="newFullName" class="form-control" placeholder="Edit Full Name"><br>
                <input type="email" name="newEmail" class="form-control" placeholder="Enter New Personal Email"> <br>
                <input type="submit" name="updateStudentInfo" class="btn btn-info" value="save">
        </form>

        
</div>
    
   

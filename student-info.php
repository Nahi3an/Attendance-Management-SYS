<?php
    include_once './header.php';
?>


<div class="edit-student-info container">   
        <br>     
        <h2>Edit Your Information</h2>
        </br>
        <div class="border p-3">
        <h5>General Informations</h5>
        <?php

            include_once "./includes/dbh-inc.php";
            include_once "./includes/function-inc.php";

  
            $userId =  $_SESSION['userId'];
            $allStudents = showAllStudents($conn);
            $studentId = "";

            foreach($allStudents as $student){
                
                if( $userId == $student['userId'] ){
                        
                        $studentId = $student['studentId'];

                }
                   
        }

        $output = showSingleStudetInfo($conn,$studentId);

        if($output !=0){
                echo "<table class='table table-hover'>
                        <tr class='table-primary'>";
            foreach(array_keys($output) as $keys){

                if($keys!='pwd'){
                echo "<th>".$keys."</th>";
                }
                            
                            
                }
                echo "</tr>";
                echo "<tr class='table-primary'>";
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


        }
               
        ?>

        </div>

        <br>

        <div class="border p-3 editinfo">
        <form action="./includes/student-info-inc.php" method="post">
                <h5>Update  Info</h5>
                <input type="text" name="newUsername" class="form-control" placeholder="Enter New UserName"><br>
                <input type="text" name="newFullName" class="form-control" placeholder="Edit Full Name"><br>
                <input type="hidden" name="studentId" class="form-control" value="<?php echo $studentId?>">
                <input type="hidden" name="userId" class="form-control" value="<?php echo  $userId ?>">
                <input type="email" name="newEmail" class="form-control"  placeholder="Enter New Personal Email"> <br>
                <input type="password" name="pwd" class="form-control" placeholder="Enter Password"> <br>
                <input type="password" name="repeatpwd" class="form-control" placeholder="Repeat Password"> <br>
                <input type="submit" name="updateStudentInfo" class="btn btn-primary" value="save">

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
                    
                    if($_GET['value']=='owninfoupdated'){
    
                        echo "<h5>Your Info Updated</h5>";
                    }
                    
                    if($_GET['value'] =='owninfoupdaterror'){
    
                        echo "<h5>Some thing went worng</h5>";
                    }
                   
    
                }
                
            
            }

        ?>

        </div>
            
        <br>

        <div class="border border-danger p-3 changepass">

        <h5>Change Your Password</h5>
        <form action="./includes/student-info-inc.php" method="post">
                <input type="hidden" name="userId" value="<?php echo $userId?>">
                <input type="password" name="pwdOld" class="form-control" placeholder="Enter Old Password"> <br>
                <input type="password" name="pwdNew" class="form-control"  placeholder="Enter New Password"> <br>
                <input type="submit" name="updateStudentPass" class="btn btn-danger" value="save">
        </form>
        <?php
                if(sizeof($url_components)>3){
    
                        if(isset($_GET['value'])){
                            
                            if($_GET['value']=='incorrectPass'){
            
                                echo "<h5>Your Password Is Incorrect</h5>";
                            }
                            
                            if($_GET['value'] =='passChanged'){
            
                                echo "<h5>Pass Word Changed Successfully</h5>";
                            }
                           
            
                        }
                        
                    
                    }

        ?>
        </div>

     
</div>
<?php
    include './footer.php';
?>

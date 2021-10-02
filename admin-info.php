<?php
    include './header.php';
?>

<div class="edit-admin-info container"> 

            <br>  
            <h2>Edit Admin Info</h2>
            <br>
            <div class="border p-3">
            <?php

            include_once "./includes/dbh-inc.php";
            include_once "./includes/function-inc.php";

            $output = allAdminInfo($conn);
            echo "<h5> Admin Info</h5>";
            if($output !=0){
            echo "<table class='table table-hover'>
                <tr class='table-primary'>
                  <th>User Name</th>
                  <th>Email</th>
                  </tr>";
            
            echo "</tr>
            <tr class='table-primary'>";
            echo "<td>".$output['userName']."</td>";
            echo "<td>".$output['uniEmail']."</td>";
            echo "</tr>";
            echo "</table>";


            }

        ?>
        </div>
        <br>
        <div class="border p-3">
        <form action="./includes/admin-info-inc.php" method="post">
                <h5>Update Admin Info</h5>
                <input type="text" name="newUsername" class="form-control" placeholder="Enter New UserName"><br>
                <input type="hidden" name="oldEmail" class="form-control" value="<?php echo $output['uniEmail']?>">
                <input type="email" name="newEmail" class="form-control"  placeholder="Enter New Email"> <br>
                <input type="password" name="pwd" class="form-control" placeholder="Enter Password"> <br>
                <input type="password" name="repeatpwd" class="form-control" placeholder="Enter Password"> <br>
                <input type="submit" name="updateInfo" class="btn btn-info" value="save">

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
                    
                    if($_GET['value']=='infoUpdated'){
    
                        echo "<h5>Admin Info Updated</h5>";
                    }
                    
                    if($_GET['value'] =='infoUpdatedError'){
    
                        echo "<h5>Some thing went worng</h5>";
                    }
                   
    
                }
                
            
            }

        ?>
        </div>
        <br>
        <div class="border border-danger p-3">
            <h5>Change Admin Pass</h5>
            <form action="./includes/admin-info-inc.php" method="post">
                    <input type="hidden" name="uniEmail" class="form-control" value="<?php echo $output['uniEmail']?>">
                    <input type="password" name="pwdOld" class="form-control" placeholder="Enter Old Password"> <br>
                    <input type="password" name="pwdNew" class="form-control" placeholder="Enter New Password"> <br>
                    <input type="submit" name="updateAdminPass" class="btn btn-info" value="save">
            </form>
        </div>
        
            
</div>
    

<?php
    include_once './footer.php';
?>

<?php

    include_once './header.php';
     
?>

<div class="login-form container">

    <h1 class="text-center">Login</h1><br>

    <form  action="./includes/login-inc.php" method="POST">
        <div class="form-group">
            <label for="email"><h5>University Email: </h5></label>
            <input type="email" class="form-control" name="email" placeholder="Enter University Email">
        </div>
        <div class="form-group">
            <label for="pwd"><h5>User Password:</h5></label>
            <input type="password" class="form-control" name="pwd" placeholder="Enter Password">
        </div>
        <button type="submit" name="login" class="btn btn-primary">Login</button>
    </form>
    <br>
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
                
                if($_GET['value']=='inccoreectinfo'){
    
                    echo "<h5>Incorrect Credential</h5>";
                }
                if($_GET['value']=='loggedout'){
    
                    echo "<h5>You Have been loged out</h5>";
                }
              
                if($_GET['value']=='nouserfound'){
    
                    echo "<h5>No user found</h5>";
                }
            }
              
           
        }
    ?>
</div> 
<?php
    include_once './footer.php';
?>
<?php

    include_once './header.php';
?>

<div class="signup-form container">
    <h2 class="text-center mt-5">Sign Up</h2>
    <form action="./includes/signup-inc.php" method="POST">
        <input type="text" name="stdid" class="form-control" placeholder="Enter Student ID"><br>
        <input type="text" name="username"  class="form-control" placeholder="Enter Username"><br>
        <input type="text" name="fullname"  class="form-control" placeholder="Enter Full Name"> <br>
        <input type="email" name="uniemail"  class="form-control" placeholder="Enter University Email"> <br>
        <input type="email" name="personalemail"  class="form-control"  placeholder="Enter Personal Email"> <br>
        <input type="password" name="pwd"  class="form-control" placeholder="Enter Password"> <br>
        <input type="password" name="repeatpwd"  class="form-control" placeholder="Repeat Password"> <br>
        <button type="submit" name="submit" class="btn btn-info">Sign Up</button>
    </form>

    <!-- URL CHECKING FOR ERROR -->
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

            //parse_str($url_components['query'], $params);

            if($_GET['value']){
                echo "<br>";
                
                if($_GET['value'] == 'fieldcannotbeempty'){

                    echo "<h5>Stdent Id , University Email or Password Field is empty. </h5>";

                }
                if($_GET['value']=='userexists'){
    
                    echo "<h5> User Exist</h5>";
                }
                
                if($_GET['value']=='signedup'){

                    echo "<h5> User Created</h5>";
                }

              

                if($_GET['value']=='passdontmatch'){
                    
                    echo "<h5>Password Don't Match</h5>";
                }
            }   
                
        }
       
    ?>
</div>

<?php
    include_once './footer.php';
?>
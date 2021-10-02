    <br>
    <h5>Create Student Account</h5>
    <form action="./includes/admin-create-student-acc-inc.php" method="POST">
        <input type="text" name="stdid" class="form-control" placeholder="Enter Student ID"><br>
        <input type="email" name="uniemail" class="form-control"  placeholder="Enter University Email"> <br>
        <input type="password" name="pwd" class="form-control"  placeholder="Enter Default Password"> <br>
        <input type="password" name="repeatpwd" class="form-control"  placeholder="Repeat Password"> <br>
        <button type="submit" class="btn btn-info"  name="createnewuser">Create New User</button>
    </form>
    <br>
    <?php
        // if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')  {
        //     $url = "https://";   
        // }
        // else {
        //     $url = "http://";   
        // }
          
        // $url.= $_SERVER['HTTP_HOST'];   
         
        // $url.= $_SERVER['REQUEST_URI'];   

        // $url_components = parse_url($url);
        
        // if(sizeof($url_components)>3){

        //     if(isset($_GET['value'])){
                
        //         if($_GET['value']=='userexists'){
    
        //             echo "<h1>Account Already Exist</h1>";
        //         }
                
        //         if($_GET['value'] =='usercreated'){

        //             echo "<h1>Account Created</h1>";
        //         }
        //     }
              
           
        // }

    ?>


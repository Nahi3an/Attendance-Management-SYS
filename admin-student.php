<?php
    include './header.php';

    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')  {
        $url = "https://";   
    }
    else {
        $url = "http://";   
    }
    
    $url.= $_SERVER['HTTP_HOST'];   
    
    $url.= $_SERVER['REQUEST_URI'];   

    $url_components = parse_url($url);

?>

<h2 class="container">Manage Student Info</h2>
<div class="admin-student-page container">
    
    <!-- <a type="button" href="./admin-student.php" class="btn btn-info">Back</a>
 -->

    <section class="student-info border p-3">
        <?php 
            include_once './admin-student-info.php';
        ?>
    </section> 
    <br>
    <section class="search-update-student-info  border p-3">
        <?php 
           include_once './search-update-student.php';

           if(sizeof($url_components)>3){
                echo "<br>";
               if(isset($_GET['value'])){
                   
                   if($_GET['value']=='owninfoupdated'){
   
                       echo "<h5>Student Info Updated</h5>";
                   }
                   
                   if($_GET['value'] =='owninfoupdaterror'){
   
                       echo "<h5>Some thing went worng</h5>";
                   }
                  
   
               }
               
           
           }

    
        ?>
    </section>

    <br>
    <section class="student-course-info  border p-3">
        <?php 
            include_once './student-course-info.php';
        ?>
    </section> <br>

    
    <section class="search-student-course-info  border p-3">
        <?php 
            include_once './search-update-student-course.php';

            if(sizeof($url_components)>3){
                echo "<br>";
                if(isset($_GET['value'])){
                    
                    if($_GET['value']=='studentalreadyadded'){

                        echo "<h5>Student is Already Enrolled</h5>";
                    }
                    
                    if($_GET['value'] =='studentadded'){

                        echo "<h5>Student Added to the course</h5>";
                    }
                
                    if($_GET['value'] =='maximumcourselimit'){

                        echo "<h5>Course Limit Reached</h5>";
                    }

                }
                
            
            }

      
        ?>
    </section> <br>
 
    <section class="create-student-account  border p-3">
        <?php 
            include_once './admin-create-student-acc.php';

            if(sizeof($url_components)>3){
                echo "<br>";
                if(isset($_GET['value'])){
                    
                    if($_GET['value']=='userexists'){
        
                        echo "<h5>Account Already Exist</h5>";
                    }
                    
                    if($_GET['value'] =='usercreated'){
    
                        echo "<h5>Account Created</h5>";
                    }
                }
                  
               
            }
        ?>
    </section> <br>

    <section class="delete-student-account  border border-danger p-3">
        <?php 
            include_once './delete-student-acc.php';
            
            if(sizeof($url_components)>3){
                          echo "<br>";
                if(isset($_GET['value'])){
                    
                    if($_GET['value']=='studentdeleted'){
        
                        echo "<h5>Student Account Deleted</h5>";
                    }
                    
                    if($_GET['value'] =='studentdeletingerror'){
    
                        echo "<h5>Student Deleting Went Wrong</h5>";
                    }

                    if($_GET['value']=='deletingcoursenotfoud'){
        
                        echo "<h5>Student Account Not Found</h5>";
                    }
                    

                   
                }
                  
               
            }
        ?>
    </section> <br>
</div>

<?php


?>

<?php
    include_once './footer.php';
?>

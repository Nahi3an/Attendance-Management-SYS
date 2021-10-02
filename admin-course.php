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

<div class="admin-course container">
    <br>
    <h2>Manage Course Info </h2>
    <br>
   <section class="all-course-info border p-3">
        <?php 
            include_once './all-course-info.php';
        ?>
    </section> 

    <br>
    <section class="update-course-info border p-3">

        <?php 
            include_once './search-update-course.php';
        ?>

    </section>
    <br>
    <section class="add-student-to-course border p-3">

        <?php 
            include_once './add-student-to-course.php';

            
            if(sizeof($url_components)>3){
    
                if(isset($_GET['value'])){
                    echo "<br>";
                    if($_GET['value']=='studentalreadyadded'){
                        
                        echo "<h5>Student is Already Enrolled In this Course</h5>";
                    }
                    else if($_GET['value'] =='studentadded'){
    
                        echo "<h5>Student Added to the course</h5>";
                    }
                    else if($_GET['value'] =='maximumcourselimit'){
    
                        echo "<h5>Course Limit Reached For This Student</h5>";
                    }
    
                }
                
            
            }
        ?>

    </section>

    <br>
    <section class="create-course border p-3">

        <?php 
            include_once './create-course.php';

              
            if(sizeof($url_components)>3){
                echo "<br>";
                if(isset($_GET['value'])){
                    
                    if($_GET['value']=='coursexists'){
        
                        echo "<h5>Course with same code Already Exist</h5>";
                    }
                    
                    if($_GET['value'] =='coursecreated'){

                        echo "<h5>Course Added</h5>";
                    }
                }
                
            
            }
        ?>

    </section>
    <br>
    <section class="delete-course-account border border-danger p-3">
        <?php 
            include_once './delete-course.php';
            
            if(sizeof($url_components)>3){
                echo "<br>";
                if(isset($_GET['value'])){
                    
                    if($_GET['value']=='coursedeleted'){
        
                        echo "<h5>Course Deleted</h5>";
                    }
                    
                    if($_GET['value'] =='coursedeletingwentwrong'){
    
                        echo "<h5>Course Deleting Went Wrong</h5>";
                        
                    }

                    if($_GET['value'] =='coursedeletingwentwrong'){
    
                        echo "<h5>Course Deleting Went Wrong</h5>";
                        
                    }

                    if($_GET['value'] =='deletingcoursenotfoud'){
    
                        echo "<h5>Select A Course First </h5>";
                        
                    }

                    
                }
                  
               
            }
        ?>
    </section> <br>
   

</div>

<?php
    include './footer.php';
?>
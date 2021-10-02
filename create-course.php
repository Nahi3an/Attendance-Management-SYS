
<h5>Add New Course</h5>
    
    <form action="./includes/create-course-inc.php" method="POST">
       
        <div  div class="form-row">
            <div class="col">
            
                <input type="text" name="courseCode" placeholder="Enter New Course Code"  class="form-control" ><br>
        
            </div>
            <div class="col">
                <input type="text" name="courseTitle" placeholder="Enter Course Title"  class="form-control"> <br>

            </div>
            <div class="col">
                
                <button type="submit" name="createnewcourse"  class="btn btn-info">Add Course</button>
            </div>
        </div>
    </form>

<?php

function  checkUserExists($conn,$userId){

    $userId = (int)$userId;

    $sql = "SELECT * FROM users WHERE id = '$userId'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        return true;
     
    }else{
       
        return false;
    }

}

function createUser($conn, $id, $userName, $fullName,$uniEmail, $personalEmail, $pwd,$pwdRepeat){

    $sql = "INSERT INTO users (username,email,is_admin,pass)
            VALUES (?,?,?,?);";

    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){

        header("location: ../signup.php?value=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    $flag = 0;
    mysqli_stmt_bind_param($stmt,"ssis", $userName,$uniEmail,$flag,$hashedPwd);
    mysqli_stmt_execute($stmt);
    

    $sql = "SELECT id FROM users WHERE email = '$uniEmail'";
    $result = mysqli_query($conn, $sql);
   

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $userid = $row["id"];
            
            $sql = "INSERT INTO student (studentId,userId,fullName,personalEmail)
            VALUES (?,?,?,?);";
    
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)){

                header("location: ../signup.php?value=stmtfailed");
                exit();
            }


            mysqli_stmt_bind_param($stmt,"siss", $id,$userid ,$fullName, $personalEmail);
            mysqli_stmt_execute($stmt);
        }
    }

    mysqli_stmt_close($stmt);
    

    return true;

        
    exit();

}		




function validateLogin($conn, $uniEmail, $pwd){

  
    $sql = "SELECT * FROM users WHERE email ='$uniEmail'";

    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
        

                if(password_verify($pwd,$row['pass'])){


                    session_start();
                    
                    $_SESSION['userId'] = $row['id'];
                    $_SESSION['loggedIn'] = true;
    
                    if($row['is_admin']==1){
                        $_SESSION['username'] = 'admin';
                        header("location: ../admin.php");

                    }else{
                        if($row['username']==""){
                            $_SESSION['username'] = "Not Set";
                        }else{

                            $_SESSION['username'] = $row['username'];
                        }
                          
                        header("location: ../student.php");
                    }
                    
        
                }else{
        
                     header("location: ../login.php?value=inccoreectinfo");
        
                }
        }
           

        

     
    }else{

        header("location: ../login.php?value=nouserfound");
        
    }


}

function showAllStudents($conn){


    $sql = 'SELECT id, studentId, userName,fullName, email, personalEmail , pass 
            FROM users,student where users.id = student.userId;';

    $result = mysqli_query($conn, $sql);
    $outputs = array();
    if ($result->num_rows > 0){

      
        while($row = $result->fetch_assoc()) {

       
            $output = array('userId'=>$row['id'],'studentId'=>$row['studentId'],'userName'=>$row['userName'],'fullName'=>$row['fullName'],'email'=>$row['email'],'personalEmail'=>$row['personalEmail'],'pwd'=>$row['pass']);
           
           array_push($outputs,$output);

        }

    }

   
    return $outputs;

}

function showStudentCourses($conn){

    $sql = 'SELECT student.studentId as studentId , student.fullName as fullName, DS2.courseCode as courseCode ,DS2.title as coursetitle
            FROM student 
            LEFT JOIN 
            (SELECT * 
            FROM (SELECT studentsenrolled.studentId, course.courseCode, course.title 
            FROM studentsenrolled 
            RIGHT JOIN course 
            ON studentsenrolled.courseId = course.id) as DS) as DS2 
            ON student.studentId = DS2.studentId
            ORDER BY student.studentId ASC';

            $result = mysqli_query($conn, $sql);
            $outputs = array();
            if ($result->num_rows > 0){

                $res;
                while($row = $result->fetch_assoc()) {


                    $output = array('studentId'=>$row['studentId'],'fullName'=>$row['fullName'],'courseCode'=>$row['courseCode'],'title'=>$row['coursetitle']);
                    //echo sizeof($res);
                    array_push($outputs,$output);

                }

            }

            return $outputs;

}


function showSingleStudetInfo($conn,$studentId){
      
    $sql = "SELECT users.id as userId,studentId, userName,fullName, email, personalEmail , pass  
            FROM users,student
            WHERE (users.id = student.userId AND student.studentId = '$studentId')";

    
    $result = mysqli_query($conn, $sql);
    $output = 0;
    if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()) {
          
            $output = array('userId'=>$row['userId'],'studentId'=>$row['studentId'],'userName'=>$row['userName'],'fullName'=>$row['fullName'],'uniEmail'=>$row['email'],'personalEmail'=>$row['personalEmail'],'pwd'=>$row['pass']);
            
            
            
        }

    }

    
     return $output;
}



function updateSingleStudetInfo($conn, $studentId, $userName, $fullName,$uniEmail, $personalEmail, $pwd){
      

    $sql = "UPDATE users
            SET username = '$userName', email= '$uniEmail', pass = '$pwd'
            WHERE email = '$uniEmail'
            ";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Users Table Update";
      } else {
        echo "Error updating Users Table : " . mysqli_error($conn);
    }

    $sql = "UPDATE student
    SET studentId = '$studentId', fullName = '$fullName', personalEmail= '$personalEmail'
    WHERE studentId = '$studentId'
    ";

    $result = mysqli_query($conn, $sql);

    if ($result) {
    echo "Student  Table Update";
    } else {
    echo "Error updating student Table : " . mysqli_error($conn);
    }
    
   
}

function showSingleStudetCourseInfo($conn,$studentId){
      
   
    $sql = "SELECT DS3.id as courseId, DS3.studentId as studentId , DS3.fullName as fullName, DS3.courseCode as courseCode , DS3.title as coursetitle
            FROM
            (SELECT student.studentId, student.fullName,DS2.courseCode,DS2.title,DS2.id
            FROM student 
            LEFT JOIN 
            (SELECT * 
            FROM (SELECT * 
            FROM studentsenrolled 
            RIGHT JOIN course 
            ON studentsenrolled.courseId = course.id) as DS) as DS2 
            ON student.studentId = DS2.studentId ) as DS3
            WHERE (DS3.studentId = '$studentId')";
            
   
    $result = mysqli_query($conn, $sql);
    $outputs = array();
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()) {

            $output = array('studentId'=>$row['studentId'],'fullName'=>$row['fullName'],'courseId'=>$row['courseId'],'courseCode'=>$row['courseCode'],'title'=>$row['coursetitle']);
            
            array_push($outputs,$output);

            
        }

    }

   
    
    return $outputs;
}





function updateSingleStudetCourseInfo($conn, $studentId, $courseCodes ){

    $newCourseCode = array();
    for($i=0; $i<sizeof($courseCodes); $i++){

        array_push( $newCourseCode, $courseCodes[$i]);

    }


    $sql = "SELECT DS3.studentId as studentId , DS3.fullName as fullName, DS3.courseCode as courseCode , DS3.title as coursetitle
            FROM
            (SELECT student.studentId, student.fullName,DS2.courseCode,DS2.title 
            FROM student 
            LEFT JOIN 
            (SELECT * 
            FROM (SELECT studentsenrolled.studentId, course.courseCode, course.title 
            FROM studentsenrolled 
            RIGHT JOIN course 
            ON studentsenrolled.courseId = course.id) as DS) as DS2 
            ON student.studentId = DS2.studentId ) as DS3
            WHERE (DS3.studentId = '$studentId')";
            
            $result = mysqli_query($conn, $sql);
            $oldCourseCode = array();
           
            if($result->num_rows > 0){
        
                while($row = $result->fetch_assoc()) {

                    array_push($oldCourseCode, $row['courseCode']);
                    
                    
                }
        
            } 

        for($i=0; $i<sizeof($newCourseCode); $i++){

                if(!isset($oldCourseCode[$i])){
                    array_push($oldCourseCode, 'no course');
                }
        
        }
    
    $count = 0;
    for($i =0; $i<4; $i++){

        if($oldCourseCode[$i] != $newCourseCode[$i]){

            echo $oldCourseCode[$i];
            echo $newCourseCode[$i];
            echo "<br>";

            if($oldCourseCode[$i]!='no course'){


                $sql = "SELECT id,courseCode
                        FROM course 
                        WHERE courseCode = '$oldCourseCode[$i]'";

                $result = mysqli_query($conn, $sql);
                $oldId;

                //echo "old :";
                if($result->num_rows > 0){

                    while($row = $result->fetch_assoc()) {

                        $oldId = $row['id'];
                        echo  $row['courseCode']." ";
                        echo  $oldId."<br>";

                    }


                } 

                $sql = "SELECT id, courseCode 
                FROM course 
                WHERE (courseCode = '$newCourseCode[$i]')";

                $result = mysqli_query($conn, $sql);

                $newId;

                //echo "New :";
                if($result->num_rows > 0){

                    while($row = $result->fetch_assoc()) {

                        $newId  = $row['id'];
                        echo  $row['courseCode']." ";
                        echo  gettype((int)$newId)."<br>";

                    }


                }   


                $idNew = (int)$newId;
                $idOld = (int)$oldId;

                $sql = "UPDATE studentsenrolled
                        SET courseId = $idNew
                        WHERE (studentId = '$studentId' AND courseId =  $idOld)
                        ";

                $result = mysqli_query($conn, $sql);

                if ($result) {
                    echo "studentsenrolled  Table Update <br>";
                } else {

                    echo "Error updating studentsenrolled Table : " . mysqli_error($conn);

                }






            }
           

           
               
            $count = $count+1;
        }

    }


    //return $count;

}


    
function showAllCoursesInfo($conn){

        $sql = "SELECT id, courseCode, title
                From course";

        $result = mysqli_query($conn, $sql);
        $outputs = array();
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {


                $id = (int)$row['id'];
                $sql = "SELECT studentId 
                        FROM studentsenrolled
                        Where courseId = $id";
                
                $res = mysqli_query($conn, $sql);

                $numberOfStudent = 0;
                if($res ->num_rows > 0){

                    $numberOfStudent = $res ->num_rows;

                }


                $output = array('courseCode'=>$row['courseCode'],'courseTitle'=>$row['title'],'numberOfStudents'=>$numberOfStudent);
                array_push($outputs,$output);
        }

        }

       return $outputs;
}
        


function showSingleCourseInfo($conn,$courseCode){


        $sql = "SELECT id, courseCode, title
                From course
                WHERE courseCode='$courseCode'";

        $result = mysqli_query($conn, $sql);

        $output = 0;
        $studentId=array();

        if ($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {

                   
            $id = (int)$row['id'];
            $sql = "SELECT studentId 
            FROM studentsenrolled
            Where courseId = $id";
    
            $res = mysqli_query($conn, $sql);

            $numberOfStudent = 0;
            if($res ->num_rows > 0){
                $numberOfStudent = $res ->num_rows;
                while($studentrow = $res->fetch_assoc()) {
                    
                    array_push($studentId,$studentrow['studentId']);
                }

            }


            
            $output = array('courseId'=>$row['id'],'courseCode'=>$row['courseCode'],'courseTitle'=>$row['title'],'numberOfStudents'=>$numberOfStudent,'studentId'=>$studentId);
            
            
            }

        }
        
        //echo $output['courseCode']." ".$output['courseTitle']." ".$output['numberOfStudents'];
        return $output;
       

}
    
        


function  updateSingleCourseInfo($conn, $courseId , $courseCode , $courseTitle){


    $newCourse = [$courseCode, $courseTitle];

  
    $id = (int)$courseId;
    $sql = "SELECT courseCode,title 
            FROM course
            WHERE id=$id";


    $result = mysqli_query($conn, $sql);
    $oldCourse = array();

    if($result->num_rows > 0){

        while($row = $result->fetch_assoc()) {
          array_push($oldCourse,$row['courseCode']);
          array_push($oldCourse,$row['title']);

            
        }

    }

   
    $flag = 0;
    if($newCourse[0]!=$oldCourse[0] or $newCourse[1]!=$oldCourse[1]){

        $sql = "UPDATE course
                SET courseCode = '$newCourse[0]', title = '$newCourse[1]'
                WHERE id =  $id";
        
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "course  Table Updates <br>";
            $flag = 1;
        } else {

            echo "Error updating studentsenrolled Table : " . mysqli_error($conn);

        }


    }

    return $flag;

} 


function  courseExists($conn,$courseCode){

        $sql = "SELECT * 
                FROM course 
                WHERE courseCode = '$courseCode'";

        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            return true;
         
        }else{
           
            return false;
        }


}


function createCourse($conn, $courseCode,$courseTitle){

  

        $sql = "INSERT INTO course (courseCode,title)
                VALUES (?,?);";
    
        $stmt = mysqli_stmt_init($conn);
    
        if(!mysqli_stmt_prepare($stmt, $sql)){
    
            header("location: ../admin-course?value=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt,"ss", $courseCode,$courseTitle);

        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);

        return true;
        
    
}


function checkForStudentInCourse($conn,$studentId, $courseCode){


    $sql = "SELECT id
            FROM course
            WHERE courseCode = '$courseCode'";

    $result = mysqli_query($conn, $sql);

    $id;
    if($result->num_rows > 0){

        while($row = $result->fetch_assoc()) {
        //   array_push($oldCourse,$row['courseCode']);
        //   array_push($oldCourse,$row['title']);

        $id = $row['id'];

            
        }

    }

    $id = (int)$id;

    


    $sql = "SELECT *
            FROM studentsenrolled
            WHERE (studentId = '$studentId' AND courseId=$id)";

    $result = mysqli_query($conn, $sql);

   
    if($result->num_rows > 0){

        return true;
       
    }

        return false;

}

   
function addStudentToaCourse($conn,$studentId, $courseCode){


            $sql = "SELECT id
            FROM course
            WHERE courseCode = '$courseCode'";

            $result = mysqli_query($conn, $sql);

            $id;
            if($result->num_rows > 0){

                while($row = $result->fetch_assoc()) {
                //   array_push($oldCourse,$row['courseCode']);
                //   array_push($oldCourse,$row['title']);

                $id = $row['id'];


                }

            }

        $id = (int)$id;

        $sql = "INSERT INTO studentsenrolled (studentId,courseId)
                VALUES (?,?);";

        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){

        header("location: ../admin-course?value=stmtfailed");
        exit();
        }

        mysqli_stmt_bind_param($stmt,"si",$studentId,$id);

        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);

        ///echo "Student Added To course";

        return true;



}
           

function checkNumberOfCourseEnrolled($conn,$studentId){

    $sql = "SELECT *
            FROM studentsenrolled 
            WHERE studentId='$studentId'";

    $result = mysqli_query($conn, $sql);

    return $result->num_rows;



}

function getAdminInfo($conn){

    $sql = "SELECT id, username, email, pass 
            FROM users WHERE is_admin = 1";

  

    $output ;
    $result = mysqli_query($conn, $sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()) {
            //   array_push($oldCourse,$row['courseCode']);
            //   array_push($oldCourse,$row['title']);

            $output= array('userId'=>$row['id'],'userName'=>$row['username'],'uniEmail'=>$row['email'],'pwd'=>$row['pass']);

            //id, username, email, pass 
            //array_push($output, $res);
        }
    }

    return $output;
}
        
function checkForSameAttendace($conn, $courseId, $assignedDate){

        
        $courseId = (int)$courseId;

        $sql = "SELECT *
        FROM attendance 
        WHERE courseId=$courseId AND date='$assignedDate'";

        $result = mysqli_query($conn, $sql);

        return $result->num_rows;


}

function createAttendanceSheet($conn,$userId,$courseId,$assignedDate){

    echo $userId." ".$courseId."<br>";
    echo $assignedDate;

    

    $userId = (int)$userId;
    
    $sql = "INSERT INTO attendance (userId,courseId,date)
    VALUES (?,?,?);";

    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){

    header("location: ../admin-attendance-sheet?value=stmtfailed");
    exit();
    }

    mysqli_stmt_bind_param($stmt,"iss", $userId,$courseId,$assignedDate);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

   
    header("location: ../admin-attendance-sheet.php?value=attendancecreated");
}


function checkCourseInAttendance($conn,$todaysDate){

    // echo $todaysDate."<br>";
    // $courseId = (int)$courseId;

    $sql = "SELECT * FROM attendance where date='$todaysDate'";

    $outputs=array();
    $result = mysqli_query($conn, $sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()) {

            //echo $row['id']." ".$row['userId']." ".$row['courseId']." ".$row['date']."<br>";
            
          $output = array('attnId'=>$row['id'],'adminId'=>$row['userId'],'courseId'=>$row['courseId'],'date'=>$row['date']);
          array_push($outputs,$output);
    }
    
    }

    // echo $output['attnId']." ".$output['courseId']." ".$output['date']."<br>";
    return $outputs;
}

function giveAttendance($conn,$studentId,$attnId){

   
    $attnId = (int)$attnId;
    date_default_timezone_set('Asia/Kolkata');
    $todaysDate = date("Y-m-d");
    $sql = "INSERT INTO attendanceinstance (studentId,attendanceId,createdDate)
    VALUES (?,?,?);";

    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){

    header("location: ../student.php?value=stmtfailed");
    exit();
    }

    mysqli_stmt_bind_param($stmt,"sis",$studentId,$attnId,$todaysDate);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

   
    header("location: ../student.php?value=attendancegiven");
    

}

function checkForAttnInstance($conn,$studentId,$attnId,$todaysDate){

    $attnId = (int)$attnId;
    $sql = "SELECT *
            FROM attendanceinstance
            WHERE (studentId='$studentId' AND attendanceId= $attnId AND createdDate='$todaysDate')";
    $output=0;
    $result = mysqli_query($conn, $sql);
     if($result->num_rows > 0){
         while($row = $result->fetch_assoc()) {
             
             $output = array('studentId'=>$row['studentId'],'attendanceId'=>$row['attendanceId'],'createdDate'=>$row['createdDate'],'createdTime'=>$row['createdTime']);
     }
     
     }
 
     return $output;

}

function getAttendanceReport($conn,$studentId,$fromDate,$toDate){

   

    $sql = "SELECT *
            FROM attendanceinstance
            WHERE createdDate BETWEEN '$fromDate' AND '$toDate' AND studentId='$studentId'";
    
    $outputs=array();
    $result = mysqli_query($conn, $sql);
     if($result->num_rows > 0){
         while($row = $result->fetch_assoc()) {
            //echo $row['studentId']." ".$row['attendanceId']." ".$row['createdDate']." ".$row['createdTime']."<br>";
            $output = array('studentId'=>$row['studentId'],'attendanceId'=>$row['attendanceId'],'createdDate'=>$row['createdDate'],'createdTime'=>$row['createdTime']);
            array_push($outputs, $output);
     }
     
     }
 
    return $outputs;


}

function getAttendedCourses($conn,$attnId){

    $attnId =(int)$attnId;

    $sql = "SELECT  attendance.id as attnId, userId, courseId, courseCode, title
            FROM attendance,course
            WHERE attendance.id =$attnId AND attendance.courseId = course.id";
   
    
    $output = 0;
    $result = mysqli_query($conn, $sql);
     if($result->num_rows > 0){
         while($row = $result->fetch_assoc()) {
             
             $output = array('attnId'=>$row['attnId'],'userId'=>$row['userId'],'courseId'=>$row['courseId'],'courseCode'=>$row['courseCode'],'courseTitle'=>$row['title']);
    }
     
    }

    return $output;

   
}

function getAttendanceReportDaily($conn,$studentId,$onDate){

    
    $sql = "SELECT *
            FROM attendanceinstance
            WHERE createdDate = '$onDate' AND studentId='$studentId'";
    
    $outputs=array();
    $result = mysqli_query($conn, $sql);
     if($result->num_rows > 0){
         while($row = $result->fetch_assoc()) {
            //echo $row['studentId']." ".$row['attendanceId']." ".$row['createdDate']." ".$row['createdTime']."<br>";
            $res = array('studentId'=>$row['studentId'],'attendanceId'=>$row['attendanceId'],'createdDate'=>$row['createdDate'],'createdTime'=>$row['createdTime']);
            array_push($outputs, $res);
     }
     
     }
 
    return $outputs;
}

function allAdminInfo($conn){

    $sql = "SELECT userName,email,pass FROM users WHERE is_admin=1";
    $result = mysqli_query($conn, $sql);

    $outputs=0;
    $result = mysqli_query($conn, $sql);
     if($result->num_rows > 0){
         while($row = $result->fetch_assoc()) {
            
            $outputs = array('userName'=>$row['userName'],'uniEmail'=>$row['email'],'pwd'=>$row['pass']);
            
     }
     
     }
 
    return $outputs;
    

}

function  updateAdminInfo($conn,$newUsername,$newEmail,$oldEmail){


    $sql = "UPDATE users
            SET  userName='$newUsername',email='$newEmail'
            WHERE is_admin=1 AND email='$oldEmail'";

               

    $result = mysqli_query($conn, $sql);

    $flag=0;
  

    if ($result) {
      
        $flag = 1;
        return $flag;
    } else {

        echo "Error updating studentsenrolled Table : " . mysqli_error($conn);
        
    }

}

function changeAdminPass($conn,$oldPass,$newPass,$uniEmail){

    $adminInfo = allAdminInfo($conn);
    

    if(password_verify($oldPass,$adminInfo['pwd'])){

       
        $hashedPwd = password_hash($newPass, PASSWORD_DEFAULT);

        $sql = "UPDATE users
                SET  pass='$hashedPwd'
                WHERE is_admin=1 AND email='$uniEmail'";

        $result = mysqli_query($conn, $sql);

        $flag=0;


        if ($result) {
            echo "PassWord Changed <br>";
            $flag = 1;
            return $flag;

        } else {

            echo "Error Pass Change : " . mysqli_error($conn);
            return $flag;
            
        }

    }else {

        header("location: ../admin-info.php?value=incorrectPass");

    }



}

function  updateOwnStudentInfo($conn,$newUsername,$newEmail,$newFullName,$studentId,$userId){

    $userId = (int)$userId;
    $sql = "UPDATE users
            SET  userName='$newUsername'
            WHERE  id='$userId'";
    $result = mysqli_query($conn, $sql);
    $flag1 = 0;
    $flag2 = 0;
    if ($result) {
        $flag1 = 1;
    } else {
        echo "Error updating Users Table : " . mysqli_error($conn);
    }

    if($flag1==1){

        $sql = "UPDATE student
                SET fullName = '$newFullName', personalEmail= '$newEmail'
                WHERE studentId = '$studentId'";
        
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $flag2 = 1;
        } else {
            echo "Error updating Student Table : " . mysqli_error($conn);
        }


    }

    if($flag1 == 1 AND $flag2 == 1){

        
       return 1;

    }else{

        return 0;

    }


}


function changeStudentPass($conn,$oldPass,$newPass,$userId){


    $userId = (int)$userId;
    $sql = "SELECT pass
            FROM users
            WHERE id=$userId";
    
    $result = mysqli_query($conn, $sql);
    $oldHashed = "";
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()) {
           
            //$oldHased = $row['pass'];

            
    if(password_verify($oldPass,$row['pass'])){

        

        $hashedPwd = password_hash($newPass, PASSWORD_DEFAULT);

        $sql = "UPDATE users
                SET  pass='$hashedPwd'
                WHERE id=$userId";

        $result = mysqli_query($conn, $sql);

        $flag=0;


        if ($result) {
            // echo "PassWord Changed <br>";
            $flag = 1;
            return $flag;

        } else {

            echo "Error Pass Change : " . mysqli_error($conn);
            return $flag;
            
        }

        }else {

            
            header("location: ../student-info.php?value=incorrectPass");

        }
    }

    }

}


function deleteCourse($conn,$couseId){

        $couseId = (int)$couseId;
        $sql = "DELETE FROM course WHERE id=$couseId";

        $result = mysqli_query($conn, $sql);

        if ($result) {

            
            //echo "course Delelted";

            return true;


        }else{

            echo "Error course delete : " . mysqli_error($conn);

            return false;


        }

}


function deleteStudentInfo($conn,$studentId,$userId){

    $userId = (int)$userId;

    $sql = "DELETE FROM users WHERE id=$userId";

    $result = mysqli_query($conn, $sql);
    $flag1 = 0;
    $flag2 = 0;
    if ($result) {

        $flag1 = 1;

    } else {
        echo "Error deleting from User Table : " . mysqli_error($conn);
    }

    if($flag1==1){

        $sql = "DELETE FROM student WHERE studentId='$studentId'";
        
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $flag2 = 1;

        } else {

            echo "Error deleting from Student Table : " . mysqli_error($conn);
        }


    }

    if($flag1 == 1 AND $flag2 == 1){

        
       return true;

    }else{

        return false;

    }


}
<?php

    if(isset($_POST['showreport'])){


        $studentId = $_POST['studentId'];
        //$attnId = $_POST['attnId'];

        $fromDate= $_POST['fromDate'];
        $toDate = $_POST['toDate'];
        
      
        include_once './function-inc.php';
        include_once './dbh-inc.php';

        if($fromDate=="" or $toDate==""){
        
            //header("location: ../admin-attendance-report.php?value=nodateselected");
            echo "No Date Selected";
        }else {
           
            //get attnfrom attninstance tabel : 
          
            $reports = getAttendanceReport($conn,$studentId,$fromDate,$toDate);
            if(sizeof($reports)>0){
                
                echo sizeof($reports);

            }



        }
    }
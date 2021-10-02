<?php
    include './header.php';
            include_once './includes/dbh-inc.php';
            include_once './includes/function-inc.php';
            $outputs = showAllStudents($conn);

            
?>

<div class="admin-attendance-report-page container">   
        <br>
        <h2>Attendence Report</h2>
        <br>
      
        <section class="attendance-report-daily border p-3">
           
                <?php
                     
                    include_once './admin-daily-attendance-report.php'

                ?>
        </section>
        <br>
        <section class="attendance-report-customized  border p-3">
            <?php
            
                 include_once './admin-customized-attendance-report.php'

            ?>
        </section>


</div>

<?php
    include_once './footer.php';
?>

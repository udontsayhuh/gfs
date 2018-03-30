<?php /*

session_start();
$username=  $_SESSION["username"];


 if(!$_SESSION["username"])
   
       header('location: login.php'); 


             
                        $con = mysql_connect("localhost","root","");

                        if (!$con)

                          {

                          die('Could not connect: ' . mysql_error());

                          }

                        mysql_select_db("sis", $con);


       $result2 = mysql_query("select  registrar_name from r_registrar where registrar_uid ='" . $_SESSION['username'] . "'") or die(mysql_error());

                          while($rowval = mysql_fetch_array($result2))

                           {

                                    $fname= $rowval['registrar_name'];
                                    $mname = "";
                                    $lname = "";
                                
                           }

                           */

?>

<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->            
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
            <li>
                <a href="sis_r_announcement.php">
                    <i class="fa fa-bell"></i>
                    <span><h5><b>Announcements</b></h5></span>
                </a>
            </li>
       
           
            <li class="sub-menu">
                <a href="GFSSIS_R_Profile.php">
                    <i class="fa fa-suitcase"></i>
                    <span><h5><b>Profile</b></h5></span>
                </a>
                <ul class="sub">
                    <li><a href="sis_r_studentprofile.php"><h5><b>Student Profile</b></h5></a></li>
                    <li><a href="#"><h5><b>Teacher Profile</b></h5></a></li>
                    
                </ul>
            </li>
                 <li>
                <a href="sis_r_applicationlist.php">
                    <i class="fa fa-inbox"></i>
                    <span><h5><b>Application List<b></h5></span>
                </a>
            </li>
             <li>
                <a href="#">
                    <i class="fa fa-book"></i>
                    <span><h5><b>Reports</b></h5></span>
                </a>
                 <ul class="sub">
                    <li><a href="formLearner.php"><h5><b>List of Students Sample Report</b></h5></a></li>
                    <li><a href="formTeacher.php"><h5><b>List of Teachers Sample Report</b></h5></a></li>
                    <li><a href="formGrade.php" ><h5><b>Form 138 Sample Report</b></h5></a></li>
                </ul>
            </li>
        </ul>
    </div>        
<!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
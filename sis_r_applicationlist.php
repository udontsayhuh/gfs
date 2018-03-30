<?php


error_reporting(0);
             
                        $con = mysql_connect("localhost","root","");

                        if (!$con)

                          {

                          die('Could not connect: ' . mysql_error());

                          }

                        mysql_select_db("sis_gfs", $con);


      
        $result = mysql_query("select concat(start,'-',end) as schoolyear from r_school_year where sy_status = 'Active' ")
        or die(mysql_error());

        $row = mysql_fetch_row($result);

        $schoolyear = $row[0]; 
      


                      function generatePassword ($length = 8)
                                {
                                  $genpassword = "";
                                  $possible = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
                                  $i = 0; 
                                  while ($i < $length) { 
                                    $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
                                    if (!strstr($genpassword, $char)) { 
                                      $genpassword .= $char;
                                      $i++;
                                    }
                                  }
                                  return $genpassword;
                                } 
                            



     if (isset($_POST['submit_checklist'])) {
        $req_nso = mysql_real_escape_string(htmlspecialchars( $_POST['req_nso']));
        $req_pic = mysql_real_escape_string(htmlspecialchars( $_POST['req_pic']));
        $req_exam = mysql_real_escape_string(htmlspecialchars( $_POST['req_exam']));
        $req_pass = mysql_real_escape_string(htmlspecialchars( $_POST['req_pass']));
        $req_f137 = mysql_real_escape_string(htmlspecialchars( $_POST['req_f137']));
        $req_gmc = mysql_real_escape_string(htmlspecialchars( $_POST['req_gmc']));
        $req_cert = mysql_real_escape_string(htmlspecialchars( $_POST['req_cert']));
        



         $result_checklist = mysql_query( "UPDATE T_APPLICATION SET REQ_NSO = $req_nso, REQ_PIC =$req_pic, REQ_EXAM = $req_exam, REQ_PASS = $req_exam, REQ_F137 = $req_f137, REQ_GMC = $req_gmc, REQ_CERT = $req_cert ")

                
                  or die(mysql_error());


     }
              if (isset($_POST['approve'])) {
                 $updateid = mysql_real_escape_string(htmlspecialchars( $_POST['updateid']));
                   // echo "<script>alert($updateid)</script>";
   
  
         $result_approve = mysql_query( "UPDATE T_APPLICATION SET A_STATUS = 'Approved', A_APPLY_LEVEL = prev_grade_level +1 ")
    
                  or die(mysql_error());

        $result_learnerstat = mysql_query( "INSERT INTO R_LEARNER_STATUS (LEARNER_FK, status) VALUES ($updateid, 'Inactive') ")
    
                  or die(mysql_error());

         $result_learnerstat = mysql_query( "INSERT INTO R_LEARNER (LEARNER_FK, USERNAME, PASS) VALUES ($updateid, '$lrn', generatePassword(); ) ")
    
                  or die(mysql_error());



     }       

     if (isset($_POST['revoke'])) {
                 $updateid = mysql_real_escape_string(htmlspecialchars( $_POST['updateid']));
                  //  echo "<script>alert($updateid)</script>";
   
  
         $result_revoke = mysql_query( "UPDATE T_APPLICATION SET DELETE_FLAG = 1, A_STATUS = 'Revoked' where A_ID = $updateid ")
    
                  or die(mysql_error());




     }          




?>


<!DOCTYPE html>
<html>
<title>Registrar | Application Lists</title>
<!--Core CSS -->
 <!--Core CSS -->
<?php include 'GFSSIS_G_Head.php';?>

    <!--icheck-->
    <link href="js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
    <link href="js/iCheck/skins/minimal/red.css" rel="stylesheet">
    <link href="js/iCheck/skins/minimal/green.css" rel="stylesheet">

    <link href="js/iCheck/skins/square/square.css" rel="stylesheet">
    <link href="js/iCheck/skins/square/red.css" rel="stylesheet">
    <link href="js/iCheck/skins/square/green.css" rel="stylesheet">

    <link href="js/iCheck/skins/flat/grey.css" rel="stylesheet">
    <link href="js/iCheck/skins/flat/red.css" rel="stylesheet">
    <link href="js/iCheck/skins/flat/green.css" rel="stylesheet">

    <link rel="stylesheet" href="js/data-tables/DT_bootstrap.css"/>

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />

<style type="text/css">
    th
    {
        text-align: center;
        font-weight: bolder;
    }
</style>

<section>
    <?php include 'GFSSIS_G_Header.php'; ?>
    <?php include 'sis_r_leftnav.php'; ?>
    <?php include 'GFSSIS_G_Modals.php'; ?>





    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
         <form role="form" class="form-horizontal"  action="sis_r_applicationlist.php" method="POST">
                        <div class="row" style="margin-left: 50px;">
                            <label style="font-size: 20px;">Active School Year: <?php echo $schoolyear; ?></label>
                           
                            <br>
                        </div>

                     <div class="row">
                        <div class="col-sm-12">




              <?php
                             $con = mysql_connect("localhost","root","");

                                if (!$con)

                                  {

                                  die('Could not connect: ' . mysql_error());

                                  }

                                mysql_select_db("sis_gfs", $con);
                                 $level_sort = mysql_real_escape_string(htmlspecialchars( $_POST['level_sort']));

                                                $none = "select  app.req_pic, app.req_exam, app.req_cert, app.req_gmc, app.req_f137, app.req_pass, app.req_nso, app.a_date, app.lrn, app.a_id , concat(fname,' ', MNAME, ' ',LNAME) as name, l.l_name  as level , a_status
                from t_application as app inner join r_grade_level as l on app.prev_grade_level = l.GL_ID where app.a_status ='Pending' AND app.DELETE_FLAG = 0 order by app.a_id desc";
                                                $lvl = "select app.req_pic, app.req_exam, app.req_cert, app.req_gmc, app.req_f137, app.req_pass, app.req_nso, app.a_date, app.a_id as learner, app.lrn, concat(fname,' ', MNAME, ' ',LNAME) as name, l.l_name  as level , a_status
                from t_application as app inner join r_grade_level as l on app.prev_grade_level = l.GL_ID where app.prev_grade_level = $level_sort   AND app.DELETE_FLAG = 0 order by app.a_id desc";

                                 if (!isset($_POST['level_sort'])) 
                                         $result = mysql_query($none); 
                           
                                 

                                 else $result = mysql_query($lvl); 


                                echo'    <section class="panel">
                                            <br>';
                                            $sql = "SELECT gl_id, l_name  from r_grade_level";
                                            $resulta = mysql_query($sql);

                                            echo'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<label>Sort by Previous Grade Level:</label> <select name="level_sort" onchange="this.form.submit()" style="margin-left:500px; margin-top: -22px; " class="col-md-6">
                                                <option disabled selected value>Sort</option>
                                            '

                                                  ;

                                              while ($row = mysql_fetch_array($resulta)) {
                                                echo "<option value='" . $row["gl_id"] . "'>" . $row["l_name"] . "</option>";
                                            }
                                            echo'

                </select>';


                

                                     


                                            

                                            echo'
                <br>
                    
                    <br>
                    

                    <div class="panel-body">
                    
                            <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                    <tr>
                                       <tr>
                                    <th>LRN</th>
                                    <th>Applicant Name</th>
                                    <th>Previous Grade Level</th>
                                    <th>Date Submitted</th>
                                    <th>Status</th>
                                    
                                        <th>Action</th>
                                    </tr>
                                </thead>';





                                   while($row = mysql_fetch_assoc($result))

                                                    {

                                        $ids = $row['a_id'];
                                        $nso = $row['req_nso'];
                                        $pic = $row['req_pic'];
                                        $exam = $row['req_exam'];
                                        $f137 = $row['req_f137'];
                                        $gmc = $row['req_gmc'];
                                        $pass = $row['req_pass'];
                                        $cert = $row['req_cert'];



                                                            echo "<tbody>";

                                              echo "<tr>";

                                              
                                            


                                               // echo "<td class='sy-content'>" . $ids ."</td>";
                                              echo "<td class='sy-content'>" . $row['lrn'] ."</td>";
                                                echo "<td class='sy-content'> " . $row['name'] ."</td>";
                                                 echo "<td class='sy-content'> " . $row['level'] ."</td>";
                                                   echo "<td class='sy-content'> " . $row['a_date'] ."</td>";
                                                 echo "<td class='sy-content'> " . $row['a_status'] ."</td>";?>
                                      <td class="sy-content"><a class="btn btn-info"  href="#edit<?php echo $ids;?>" data-toggle="modal">
                                            <i class="fa fa-eye" ></i></a>

                                           <a class="btn btn-primary"  href="#check<?php echo $ids;?>" data-toggle="modal"><i class="fa fa-files-o"></i></a>
                                           <?php if($nso == 1 && $pic == 1 && $gmc == 1 && $exam == 1 && $cert == 1 && $pass == 1 && $f137 == 1) {?>

                                            <a class="btn btn-warning"   href="#approveModal<?php echo $ids;?>" data-toggle="modal"><i class="fa fa-check"></i></a> 
                                            <?php  
                                          }
                                          else{

                                          ?>
                                         <a class="btn btn-warning"  disabled href="#approveModal<?php echo $ids;?>" data-toggle="modal"><i class="fa fa-check"></i></a> 
                                          <?php }?>

                                    
                                             <a type="submit" class="btn btn-danger" title="Delete" name="enable" id ="enable" href="#revokeModal<?php echo $ids;?>" data-toggle="modal">
                                            <i class="fa fa-times" ></i></a>
                                        </td><?php
                                            
                                               
                                            
                                             

                                               echo "</tr>";
                                              echo "<tbody>";
                                }



                                echo '  </table>

                                  </section>
                       
                    </div>
                       </form>
                </section>
        </section>';
                                ?>


            </div>
           </div>
        
        </section>
    </section>

 <?php include 'GFSSIS_G_AddOns.php'; ?>
</section>

<?php


            
                    $sql = "SELECT a_id, lrn, fname, mname, lname, bdate,sex, mtongue, religion, contact, pbirth, street, brgy, municipal, city, marital, nationality,email, mother, mother_phone, mother_occu, father, father_phone, father_occu, guard, guard_rel, guard_contact,prev_school, gwa, req_nso, req_pic, req_exam, req_f137, req_gmc, req_cert, req_pass  from t_application";

                                                 
                      $result4 = mysql_query($sql);
                          $r=mysql_num_rows($result4);

                            echo $r ;
                    if (mysql_num_rows($result4) > 0) {
                        // output data of each row
                        while($row = mysql_fetch_array($result4)) {
                            $ids = $row['a_id'];
                            $lrn = $row['lrn'];
                            $fname = $row['fname'];
                            $mname = $row['mname'];
                            $lname = $row['lname'];
                            $bdate = $row['bdate'];
                            $sex = $row['sex'];
                            $mtongue =$row['mtongue'];
                            $ip = $row['religion'];
                            $contact = $row['contact'];
                            $pbirth = $row['pbirth'];
                            $street = $row['street'];
                            $brgy = $row['brgy'];
                            $municipal = $row['municipal'];
                            $city = $row['city'];
                            $marital = $row['marital'];
                            $nationality = $row['nationality'];
                            $email = $row['email'];
                            $mother = $row['mother'];
                            $mother_phone = $row['mother_phone'];
                            $mother_occu = $row['mother_occu'];
                            $father = $row['father'];
                            $father_phone = $row['father_phone'];
                            $father_occu = $row['father_occu'];
                            $guard = $row['guard'];
                            $guard_rel = $row['guard_rel'];
                            $guard_contact = $row['guard_contact'];
                            $prev_school = $row['prev_school'];
                            $gwa = $row['gwa'];
                            $nso = $row['req_nso'];
                            $pic = $row['req_pic'];
                            $exam = $row['req_exam'];
                            $f137 = $row['req_f137'];
                            $gmc = $row['req_gmc'];
                            $pass = $row['req_pass'];
                            $cert = $row['req_cert'];

                       


?>




    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1"  id="edit<?php echo $ids; ?>"" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button" style="color: white">×</button>
                    <div class="warning"><h4 class="modal-title" style="color: white;">Applicant Personal Information</h4></div>
                </div>
                <div class="modal-body">
                    <form role="form">
                        <tr class="col-md-3 form-group">
                            <label>LRN</label><input type="text"   value="<?php echo $lrn; ?>" class="form-control"> &nbsp
                            <label>First Name</label><input type="text"   value="<?php echo $fname; ?>" class="form-control"> &nbsp
                            <label>Middle Name</label><input type="text"   value="<?php echo $mname; ?>" class="form-control"> &nbsp
                            <label>Last Name</label><input type="text"  value="<?php echo $lname; ?>" class="form-control"> &nbsp
                            <label>Mother Tongue</label><input type="text"   value="<?php echo $mtongue; ?>" class="form-control"> &nbsp
                            <label>Sex</label><input type="text"   value="<?php echo $sex; ?>" class="form-control"> &nbsp
                             <label>Ethnic Group</label><input type="text"  value="<?php echo $ip; ?>" class="form-control"> &nbsp
                              <label>Contact</label><input type="text"   value="<?php echo $contact; ?>" class="form-control"> &nbsp
                               <label>Place of Birth</label><input type="text"   value="<?php echo $pbirth; ?>" class="form-control"> &nbsp
                                <label>Street</label><input type="text"   value="<?php echo $street; ?>" class="form-control"> &nbsp
                                <label>Barangay</label> <input type="text"   value="<?php echo $brgy; ?>" class="form-control"> &nbsp
                                 <label>Municipal</label> <input type="text"   value="<?php echo $municipal; ?>" class="form-control"> &nbsp
                                 <label>City</label> <input type="text"   value="<?php echo $city; ?>" class="form-control"> &nbsp
                                 <label>Marital Status</label> <input type="text"   value="<?php echo $marital; ?>" class="form-control"> &nbsp
                                 <label>Nationality</label> <input type="text"   value="<?php echo $nationality; ?>" class="form-control"> &nbsp
                                 <label>Email Address</label> <input type="text"   value="<?php echo $email; ?>" class="form-control"> &nbsp
                                 <label>Father's Name</label> <input type="text"   value="<?php echo $father; ?>" class="form-control"> &nbsp
                                 <label>Contact No.</label> <input type="text"   value="<?php echo $father_phone; ?>" class="form-control"> &nbsp
                                 <label>Occupation</label> <input type="text"   value="<?php echo $father_occu; ?>" class="form-control"> &nbsp
                                 <label>Mother's Name</label> <input type="text"   value="<?php echo $mother; ?>" class="form-control"> &nbsp
                                 <label>Contact No.</label> <input type="text"   value="<?php echo $mother_phone; ?>" class="form-control"> &nbsp
                                 <label>Occupation</label> <input type="text"   value="<?php echo $mother_occu; ?>" class="form-control"> &nbsp
                                 <label>Guardian</label> <input type="text"   value="<?php echo $guard; ?>" class="form-control"> &nbsp
                                 <label>Relationship to Guardian</label> <input type="text"   value="<?php echo $guard_rel; ?>" class="form-control"> &nbsp
                                 <label>Contact Number</label> <input type="text"   value="<?php echo $guard_contact; ?>" class="form-control"> &nbsp
                                 <label>Last School Attended</label> <input type="text"   value="<?php echo $prev_school; ?>" class="form-control"> &nbsp
                                 <label>General Weighted Average</label> <input type="text"   value="<?php echo $gwa; ?>" class="form-control"> &nbsp

                         
                        </tr>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



     <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1"  id="check<?php echo $ids; ?>" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button" style="color: white">×</button>
                    <div class="warning"><h4 class="modal-title" style="color: white;">Evaluate Applicant: Requirements Checklist</h4></div>
                </div>
                <div class="modal-body" style="height: 500px;">
                    <form role="form" method="POST" >
                        <tr class="col-md-3 form-group">
                
                                   <div class="form-group">
                                        <label class="col-sm-3 control-label" >Requirements:</label>
                                        <div class="col-sm-9">

                                            <div class="checkbox single-row">
                                              <?php 
                                                //echo $nso;
                                                  if ($nso == 0 ){
                                              echo'
                                                 <input type="hidden" name = "req_nso" value="0">
                                                <input type="checkbox" name = "req_nso" value="1">
                                                ';
                                              } 
                                                  else if ($nso == 1) 
                                                    echo'
                                                   <input type="checkbox" checked name = "req_nso" value="1"
                                                   >';  ?>
                                                <label>Two (2) photocopies of NSO Birth Certificate</label>
                                            </div>

                                            <div class="checkbox single-row">
                                                <?php 
                                                //echo $nso;
                                                  if ($pic == 0 ){
                                              echo'
                                                 <input type="hidden" name = "req_pic" value="0">
                                                <input type="checkbox" name = "req_pic" value="1">';
                                              } 
                                                  else if ($pic == 1) 
                                                    echo'
                                                   <input type="checkbox" checked name = "req_pic" value="1">';  ?>
                                                <label>Two (2) pieces of recent 1 x 1 picture</label>
                                            </div>

                                            <div class="checkbox single-row">
                                                 <?php 
                                                //echo $nso;
                                                  if ($exam == 0 ){
                                              echo'
                                                <input type="hidden" name = "req_exam" value="0">
                                                <input type="checkbox" name = "req_exam" value="1">
                                                ';
                                              } 
                                                  else if ($exam == 1) 
                                                    echo'
                                                   <input type="checkbox" checked name = "req_exam" value="1">';  ?>
                                                <label>Entrance Examination</label>
                                            </div>

                                            <div class="checkbox single-row">
                                                <label class="checkbox"> <?php 
                                                //echo $nso;
                                                  if ($pass == 0 ){
                                              echo'
                                                <input type="hidden" name = "req_pass" value="0">
                                                <input type="checkbox" name = "req_pass" value="1">
                                                ';
                                              } 
                                                  else if ($pass == 1) 
                                                    echo'
                                                   <input type="checkbox" checked name = "req_pass" value="1">';  ?></label>
                                                <label>Passing Grade</label>
                                            </div>

                                            <div class="checkbox single-row">
                                                <label class="checkbox"> <?php 
                                                //echo $nso;
                                                  if ($f137 == 0 ){
                                              echo'
                                                <input type="hidden" name = "req_f137" value="0">
                                                <input type="checkbox" name = "req_f137" value="1">
                                                 ';
                                              } 
                                                  else if ($f137 == 1) 
                                                    echo'
                                                   <input type="checkbox" checked name = "req_f137" value="1">';  ?></label>
                                                <label>Form 137 (Permanent Records)</label>
                                            </div>

                                            <div class="checkbox single-row">
                                                <label class="checkbox"> <?php 
                                                //echo $nso;
                                                  if ($gmc == 0 ){
                                              echo'
                                                <input type="hidden" name = "req_gmc" value="0">
                                                <input type="checkbox" name = "req_gmc" value="1">
                                                 ';
                                              } 
                                                  else if ($gmc == 1) 
                                                    echo'
                                                   <input type="checkbox" checked name = "req_gmc" value="1">';  ?></label>
                                                <label>Certificate of Good Moral Character</label>
                                            </div>

                                            <div class="checkbox single-row">
                                                <label class="checkbox"> <?php 
                                                //echo $nso;
                                                  if ($cert == 0 ){
                                              echo'
                                                <input type="hidden" name = "req_cert" value="0">
                                                <input type="checkbox" name = "req_cert" value="1">
                                                ';
                                              } 
                                                  else if ($cert == 1) 
                                                    echo'
                                                   <input type="checkbox" checked name = "req_cert" value="1">';  ?></label>
                                                <label>Medical Certificate</label>
                                            </div>
                                        </div>
                                      </div>


                                                <div style="margin-top: 50px; margin-left: 70px;">
                                                <button type="submit" class="btn btn-success" name="submit_checklist" >Submit</button>
                                                <button type="submit" class="btn btn-danger" data-dismiss="modal">Cancel</button>                     
                                              </div>
                                        </div>
                                    </div>
                             
                         
                        </tr>
           
                    </form>
                </div>
            </div>
        </div>
    </div>

      <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="approveModal<?php echo $ids; ?>" class="modal fade">
      <div class="modal-dialog" style="width: 30%">
          <div class="modal-content">
              <div class="modal-header">
                  <div class="warning"><h4 class="modal-title">Application Process</h4></div>
              </div>
              <div class="modal-body">
                  <form role="form" method="POST">
                      <div class="form-group">
                          <label for="logoutModal">Approve Application?</label>
                      </div>
                      
                      <div class="logout-button">
                          <label>ID</label><input type="text" name="updateid"  value="<?php echo $ids; ?>" class="form-control"> 
                     
                        <button type="submit" class="btn btn-success" name="approve" >Yes</button>
                        <button type="submit" class="btn btn-danger" data-dismiss="modal">No</button>                     
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>

      <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="revokeModal<?php echo $ids; ?>" class="modal fade">
      <div class="modal-dialog" style="width: 30%">
          <div class="modal-content">
              <div class="modal-header">
                  <div class="warning"><h4 class="modal-title">Application Process</h4></div>
              </div>
              <div class="modal-body">
                  <form role="form" method="POST">
                      <div class="form-group">
                          <label for="logoutModal">Revoke Application?</label>
                      </div>
                      
                      <div class="logout-button">
                           <label>ID</label><input type="text" name="updateid"  value="<?php echo $ids; ?>" class="form-control">
                        <button type="submit" class="btn btn-success" name="revoke" >Yes</button>
                        <button type="submit" class="btn btn-danger" data-dismiss="modal">No</button>                     
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>


    <?php }}?>


<!-- Placed js at the end of the document so the pages load faster -->
<!--Core js-->


<!--Core js-->
<script src="js/jquery-1.8.3.min.js"></script>
<script src="bs3/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/jquery.scrollTo.min.js"></script>
<script src="js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<!--Easy Pie Chart-->
<script src="js/easypiechart/jquery.easypiechart.js"></script>
<!--Sparkline Chart-->
<script src="js/sparkline/jquery.sparkline.js"></script>
<!--jQuery Flot Chart-->
<script src="js/iCheck/jquery.icheck.js"></script>
<script src="js/flot-chart/jquery.flot.js"></script>
<script src="js/flot-chart/jquery.flot.tooltip.min.js"></script>
<script src="js/flot-chart/jquery.flot.resize.js"></script>
<script src="js/flot-chart/jquery.flot.pie.resize.js"></script>

<script type="text/javascript" src="js/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="js/data-tables/DT_bootstrap.js"></script>

<script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>

<!--icheck init -->
<script src="js/icheck-init.js"></script>

<!--common script init for all pages-->
<script src="js/scripts.js"></script>

<!--script for this page only-->
<!--<script src="js/table-editable.js"></script>-->

<!-- END JAVASCRIPTS -->
<script>
    jQuery(document).ready(function() {
        EditableTable.init();
    });
</script>



</body>
</html>

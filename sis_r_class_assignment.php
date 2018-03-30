<?php


error_reporting(0);
             
                        $con = mysql_connect("localhost","root","");

                        if (!$con)

                          {

                          die('Could not connect: ' . mysql_error());

                          }

                        mysql_select_db("sis_gfs", $con);


      
        $result = mysql_query("select concat(start,'-',end) as schoolyear ,sy_id as syid from r_school_year where sy_status = 'Active' ")
        or die(mysql_error());

        $row = mysql_fetch_row($result);

        $schoolyear = $row[0]; 
        $schoolyearid = $row[1]; 


        if (isset($_POST['section'])){
             $section = mysql_real_escape_string(htmlspecialchars( $_POST['section']));

        }


if (isset($_POST['approve']) )
{
           $section = mysql_real_escape_string(htmlspecialchars( $_POST['section']));
         
             echo "<script>alert($section)</script>";

            $section = mysql_real_escape_string(htmlspecialchars( $_POST['section']));
        $updateid = mysql_real_escape_string(htmlspecialchars( $_POST['updateid']));
         $result_approve = mysql_query( "INSERT INTO R_SECTION_CLASS_DETAILS (section_FK, learner_fk, sy_fk) VALUES ($section, $updateid , $schoolyearid ) ")

                
                  or die(mysql_error());

           $result_update = mysql_query( "UPDATE r_learner_status SET Status ='Active' where learner_fk = $updateid ")

                
                  or die(mysql_error());
                  

}


                       

?>


<!DOCTYPE html>
<html>
<title>Registrar | Class Assignment</title>
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
    <?php include 'sis_r_applicationmodal.php'; ?>




    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
         <form role="form" class="form-horizontal"  action="sis_r_class_assignment.php" method="POST">
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

                                                $none = "select stat.status as status,app.a_apply_level as apply, app.a_date, app.lrn, app.a_id as learner, concat(fname,' ', MNAME, ' ',LNAME) as name, l.l_name  as level , app.a_status
                from t_application as app inner join r_grade_level as l on app.a_apply_level = l.GL_ID inner join r_learner_status as stat on stat.learner_fk = app.a_id where app.a_status='Approved' and status='Inactive' order by app.a_id desc ";
                                                $lvl = "select app.a_apply_level as apply, app.a_date, app.a_id as learner, app.lrn, concat(fname,' ', MNAME, ' ',LNAME) as name, l.l_name  as level , app.a_status
                from t_application as app inner join r_grade_level as l on app.a_apply_level = l.GL_ID where app.a_apply_level = $level_sort and  app.a_status='Approved' order by app.a_id desc ";

                                 if (!isset($_POST['level_sort'])) 
                                         $result = mysql_query($none); 
                           
                                 

                                 else $result = mysql_query($lvl); 


                                echo'    <section class="panel">
                                            <br>
                                            <br>
                                            <br>';
                                            $sql = "SELECT gl_id, l_name  from r_grade_level";
                                            $resulta = mysql_query($sql);

                                            echo' <select name="level_sort" onchange="this.form.submit()" style="margin-left:500px; margin-top: -22px; " class="col-md-6">
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
                                    <th>Learner</th>
                                    <th>Grade Level</th>
                                    <th>Section</th>
                                    
                                    
                                        <th>Action</th>
                                    </tr>
                                </thead>';





                                   while($row = mysql_fetch_assoc($result))

                                                    {

                                      $ids = $row['learner'];
                                      $la = $row['apply'];



                                                            echo "<tbody>";

                                              echo "<tr>";

                                              
                                            


                                               // echo "<td class='sy-content'>" . $ids ."</td>";
                                              echo "<td class='sy-content'>" . $row['lrn'] ."</td>";
                                                echo "<td class='sy-content'> " . $row['name'] ."</td>";
                                                 echo "<td class='sy-content'> " . $row['level'] ."</td>";
                                                 echo '<td class="sy-content">';  

                                                 $sqli = "SELECT s_id, section_name  from r_section  where acadlevel_fk = $la";
                                            $resultsss = mysql_query($sqli);

                                            echo' <select name="section"  onchange="this.form.submit() class="col-md-12">';
                                              while ($row = mysql_fetch_array($resultsss)) {
                                                echo "<option value='" . $row["s_id"] . "'>" . $row["section_name"] . "</option>";
                                            }


                                            echo'</select></td>';
                                                  ?>
                                      <td class="sy-content">


                                            <a class="btn btn-warning"   href="#approveModal<?php echo $ids;?>" data-toggle="modal"><i class="fa fa-check-square-o"></i></a>
                                    
                                            
                                        </td><?php
                                            
                                               
                                            
                                             

                                               echo "</tr>";
                                              echo "<tbody>";
                                }



                                echo '  </table>

                                  </section>
                       
                    </div>';
                                ?>

  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="approveModal<?php echo $ids; ?>" class="modal fade">
      <div class="modal-dialog" style="width: 30%">
          <div class="modal-content">
              <div class="modal-header">
                  <div class="warning"><h4 class="modal-title">Application Process</h4></div>
              </div>
              <div class="modal-body">
               
                      <div class="form-group">
                          <label for="logoutModal">Assign Learner to Section?</label>
                      </div>
                      
                      <div class="logout-button">
                     <label>ID</label><input type="text" name="updateid"  value="<?php echo $ids; ?>" class="form-control"> 

                        <button type="submit" class="btn btn-success" name="approve" >Yes</button>
                        <button type="submit" class="btn btn-danger" data-dismiss="modal">No</button>                     
                      </div>
                
              </div>
          </div>
      </div>
  </div>


          </form>
                </section>
        </section>


            </div>
           </div>
        
        </section>
    </section>

 <?php include 'GFSSIS_G_AddOns.php'; ?>
</section>

<?php


            
                    $sql = "SELECT a_id, lrn, fname, mname, lname, bdate,sex, mtongue, religion, contact, pbirth, street, brgy, municipal, city, marital, nationality,email, mother, mother_phone, mother_occu, father, father_phone, father_occu, guard, guard_rel, guard_contact,prev_school, gwa  from t_application";

                                                 
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

                       


?>




    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1"  id="edit<?php echo $ids; ?>"" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button" style="color: white">×</button>
                    <div class="warning"><h4 class="modal-title" style="color: white;">Applicant Personal Information</h4></div>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST">
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
                    <form role="form">
                        <tr class="col-md-3 form-group">
                
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" >Requirements:</label>

                                        <div class="col-sm-9 icheck minimal">
                                            <div class="checkbox single-row">
                                                <input type="checkbox"  >
                                                <label>Two (2) photocopies of NSO Birth Certificate</label>
                                            </div>

                                            <div class="checkbox single-row">
                                                <input type="checkbox"  >
                                                <label>Two (2) pieces of recent 1 x 1 picture</label>
                                            </div>

                                            <div class="checkbox single-row">
                                                <input type="checkbox"  >
                                                <label>Entrance Examination</label>
                                            </div>

                                            <div class="checkbox single-row">
                                                <label class="checkbox"><input type="checkbox"   ></label>
                                                <label>Passing Grade</label>
                                            </div>

                                            <div class="checkbox single-row">
                                                <label class="checkbox"><input type="checkbox"   ></label>
                                                <label>Form 137 (Permanent Records)</label>
                                            </div>

                                            <div class="checkbox single-row">
                                                <label class="checkbox"><input type="checkbox"   ></label>
                                                <label>Certificate of Good Moral Character</label>
                                            </div>

                                            <div class="checkbox single-row">
                                                <label class="checkbox"><input type="checkbox"   ></label>
                                                <label>Medical Certificate</label>
                                            </div>


                                                <div style="margin-top: 50px; margin-left: 70px;">
                                                <button type="submit" class="btn btn-success" name="submit_checklist" >Submit</button>
                                                <button type="submit" class="btn btn-danger" data-dismiss="modal">Cancel</button>                     
                                              </div>
                                        </div>
                                    </div>
                             
                         
                        </tr>
           </div>
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
                          <label for="logoutModal">Assign Learner to Section?</label>
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
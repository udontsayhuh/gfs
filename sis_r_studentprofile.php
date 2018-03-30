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
    <?php include 'sis_r_applicationmodal.php'; ?>




    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
         <form role="form" class="form-horizontal"  action="sis_r_studentprofile.php" method="POST">
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

                                                $none = "select DISTINCT sec.SECTION_NAME,sec.S_ID as id, prof.T_NAME from r_section_class_details as class 
                                            inner join r_section as sec
                                            on sec.S_ID = class.SECTION_FK
                                            inner join r_teacher as prof
                                            on prof.T_ID = sec.T_FK";
                                                $lvl = "select DISTINCT sec.SECTION_NAME, sec.S_ID, prof.T_NAME from r_section_class_details as class 
                                            inner join r_section as sec
                                            on sec.S_ID = class.SECTION_FK
                                            inner join r_teacher as prof
                                            on prof.T_ID = sec.T_FK
                                            where sec.ACADLEVEL_FK = $level_sort";

                                 if (!isset($_POST['level_sort'])) 
                                         $result = mysql_query($none); 
                           
                                 

                                 else $result = mysql_query($lvl); 


                                echo'    <section class="panel">
                                            <br>';
                                            $sql = "SELECT gl_id, l_name  from r_grade_level";
                                            $resulta = mysql_query($sql);

                                            echo'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<label>Sort by Grade Level:</label> <select name="level_sort" onchange="this.form.submit()" style="margin-left:500px; margin-top: -22px; " class="col-md-6">
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
                                    <th>Section</th>
                                    <th>Adviser</th>
                          
                                    
                                        <th>Action</th>
                                    </tr>
                                </thead>';





                                   while($row = mysql_fetch_assoc($result))

                                                    {

                                      $ids = $row['id'];
                                    //   echo "<script>alert($ids)</script>";


                                                            echo "<tbody>";

                                              echo "<tr>";

                                           
                                            


                                               // echo "<td class='sy-content'>" . $ids ."</td>";
                                              echo "<td class='sy-content'>" . $row['SECTION_NAME'] ."</td>";
                                                echo "<td class='sy-content'> " . $row['T_NAME'] ."</td>";
                                               ?>
                                      <td class="sy-content"><a class="btn btn-info"  href="#edit<?php echo $ids;?>" data-toggle="modal">
                                            <i class="fa fa-eye" ></i></a>

                                         

                                            <a class="btn btn-warning"  ><i class="fa fa-edit"></i></a>
                                    
                                            
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

//(SELECT count(LEARNER_FK)   FROM `r_section_class_details` WHERE SECTION_FK = $ids) as no
            
                    //$sql = "SELECT count( *) as stud,  FROM `r_section_class_details`";


 
                            $sql  ="select DISTINCT sec.SECTION_NAME as name,sec.S_ID as id, prof.T_NAME, gl.L_NAME as acad, (SELECT count(LEARNER_FK)   FROM `r_section_class_details` WHERE SECTION_FK = $ids) as no from r_section_class_details as class 
                                            inner join r_section as sec
                                            on sec.S_ID = class.SECTION_FK
                                            inner join r_teacher as prof
                                            on prof.T_ID = sec.T_FK
                                            INNER join r_grade_level as GL
                                            on gl.GL_ID = sec.ACADLEVEL_FK
 ";
                                                 
                      $result4 = mysql_query($sql);
                          $r=mysql_num_rows($result4);

                            echo $r ;
                    if (mysql_num_rows($result4) > 0) {
                        // output data of each row
                        while($row = mysql_fetch_array($result4)) {
                            $ids = $row['id'];
                            $lrn = $row['name'];
                            $acad = $row['acad'];
                            $num = $row['no'];


                           
                           
                       


?>




    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1"  id="edit<?php echo $ids; ?>"" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button" style="color: white">×</button>
                    <div class="warning"><h4 class="modal-title" style="color: white;">Class Details</h4></div>
                </div>
                <div class="modal-body">
                    <form role="form">
                        <tr class="col-md-3 form-group">
                            
                            <label>Grade Level:</label><input type="text"   value="<?php echo $acad; ?>" class="form-control"> &nbsp
                            <label>Section Name:</label><input type="text"   value="<?php echo $lrn; ?>" class="form-control"> &nbsp
                            <label>Number of Students:</label><input type="text"   value="<?php echo $num; ?>" class="form-control"> &nbsp
                            <br>
                            <br>
                            <div style=" margin-left: 210px;">
                                                 <a class="btn btn-success" href="sis_r_class.php?id=<?php echo $ids ?>"  >View Class List</a>
                                                <button type="submit" class="btn btn-danger" data-dismiss="modal">Cancel</button>                     
                                              </div>
                           

                          
                         
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
                                              <?php 
                                                $result1 = mysqli_query($connection, "SELECT REQ_NSO FROM t_application");
                                                while ($row = mysqli_fetch_assoc($result1)){
                                                  if ($row['REQ_NSO'] == 0 ){
                                              ?>
                                                <input type="checkbox" checked  ><?php }
                                                  else ?> <input type="checkbox"   >  <?php }?>
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
                          <label for="logoutModal">Approve Application?</label>
                      </div>
                      
                      <div class="logout-button">
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

<!-- 


SELECT app.lrn ,concat(app.FNAME, ' ', app.LNAME) from r_section_class_details as class
INNER join t_application as app
on class.LEARNER_FK = app.A_ID
where class.SECTION_FK = 1
-->
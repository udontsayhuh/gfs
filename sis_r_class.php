<?php




             
                        $con = mysql_connect("localhost","root","");

                        if (!$con)

                          {

                          die('Could not connect: ' . mysql_error());

                          }

                        mysql_select_db("sis_gfs", $con);




                            if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)

                                {

                                // query db

                                $id = $_GET['id'];

                                $result = mysql_query("SELECT section_fk FROM r_section_class_details WHERE section_fk=$id")

                                or die(mysql_error());

                                $row = mysql_fetch_array($result);



                                // check that the 'id' matches up with a row in the databse

                                if($row)

                                {



                                // get data from db

                                $section = $row['section_fk'];
}}
            /*                    


                        }}
                           $result3 = mysql_query("SELECT * FROM r_learner")

                                or die(mysql_error());

                                $row3 = mysql_fetch_array($result3);

                                   if($row3)

                                {



                                // get data from db

                               $gender = $row3['learner_id'];

}
*/




            
                    $sql = "SELECT * from r_learner";

                                                 
                      $result4 = mysql_query($sql);
                      

             
                        // output data of each row
                  /*
                            $learner_fname = $row['learner_fname'];
                            $learner_mname = $row['learner_mname'];
                            $learner_lname = $row['learner_lname'];
                            $learner_gender = $row['learner_gender'];
                            $learner_bdate = $row['learner_bdate'];
                            $learner_city = $row['learner_city']; */
                        


?>

<!DOCTYPE html>
<html>
<title>Registrar | Student Profile</title>
<?php include 'GFSSIS_G_Head.php'; ?>


    <link rel="stylesheet" type="text/css" href="js/jquery-tags-input/jquery.tagsinput.css" />


<body>
    <style>
        .col-sm-12 {
    width: 90%;
    align-self: center;
    margin-left: 5%;
}

    .button01{
    background-color: #84C596; 
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    font-size: 12px;
    border-radius: 8px;
}

    .button02{
    background-color:#59ace2; 
    border: none;
    color: white;
    padding:10px 16px;
    text-align: center;
    font-size: 12px;
    border-radius: 6px;

    }

    .button3{
    background-color:#FF6C60; 
    border: none;
    color: white;
    padding:10px 16px;
    text-align: center;
    font-size: 12px;
    border-radius: 6px;

    }
    </style>
<section>
    <?php include 'GFSSIS_G_Header.php'; ?>
    <?php include 'sis_r_leftnav.php'; ?>
    <?php include 'GFSSIS_G_Modals.php'; ?>


  <?php
                             $con = mysql_connect("localhost","root","");

                                if (!$con)

                                  {

                                  die('Could not connect: ' . mysql_error());

                                  }

                                mysql_select_db("sis_gfs", $con);

                                $result = mysql_query("SELECT app.a_id as aid, app.lrn AS LRN,concat(app.FNAME, ' ', app.LNAME) AS NAME from r_section_class_details as class
                                    INNER join t_application as app
                                    on class.LEARNER_FK = app.A_ID
                                    where class.SECTION_FK = $id
                                    ");



echo'

              <section id="main-content">
        <section class="wrapper">
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    
                    <header class="panel-heading">
                    
                        <div class="container-form"><h4><b>STUDENT PROFILE</b></h4></div>
                    </header>
                    
                  <div class="panel-body" >
                        <div class="adv-table editable-table ">
                            <div class="space15"></div>
                            <table class="table table-striped table-hover table-bordered" id="editable-sample">
                              
                    </div>  
                                <thead>                    
                                    <tr>
                                    <th style= "text-align  : center; font-size:24px;  ">LRN</th>
                                    <th style= "text-align  : center; font-size:24px;  ">Name </th>
                              
                                    <th style= "text-align  : center; font-size:24px; width: 50px; ">Action</th>
                                  
                                  
                                </tr>
                                </thead>



';
                   while($row = mysql_fetch_assoc($result)) {
                            $ids = $row['aid'];
                            

                                        //'".$row['announcement_id']."'
                                            echo "<tbody>";

                                              echo "<tr>";

                                              
                                              echo "<td style = 'width: 500px;' align='center'>" . $row['LRN'] . "</td>";
                                               echo "<td style = 'width: 500px;' align='center'>" . $row['NAME'] . "</td>"
                                       ?>
                                             <td align="center" > <a class="button02"  href="#view<?php echo $ids;?>" data-toggle="modal">View</a>
                                     

                                     <?php
                                               echo "</tr>";
                                              echo "<tbody>";
                                }



    echo'             </table>
                            <button type="button" class="button01" ><a href="sis_r_studentprofile.php" style="color: white">  < Back  </button>
                               
                        </div>
                    </div>
                </section>
            </div>
        </div>
        </section>
    </section>

 ';



?>
 
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




    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1"  id="view<?php echo $ids; ?>"" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button" style="color: white">×</button>
                    <div class="warning"><h4 class="modal-title" style="color: white;">Learner Information</h4></div>
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




<!-- Placed js at the end of the document so the pages load faster -->
<?php include 'GFSSIS_G_JScript.php';?>

<script type="text/javascript" src="js/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="js/data-tables/DT_bootstrap.js"></script>
<!--script for this page only-->
<script src="js/table-editable.js"></script>

<script type="text/javascript" src="js/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>

<script src="js/jquery-tags-input/jquery.tagsinput.js"></script>

<!-- END JAVASCRIPTS -->
<script>
    jQuery(document).ready(function() {
        EditableTable.init();
    });
</script>

</body>
</html>
<?php }} ?>
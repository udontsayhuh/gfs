<?php 
    $server = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'sis_gfs';
    $today = date('Y-m-d');
            $connection = mysql_connect($server, $user, $pass)
            or die ("Could not connect to server ... \n" . mysql_error ());
            mysql_select_db($db);
               //$id = $_GET['id']; 
             $result = mysql_query("SELECT START, END from R_TRANSACTION_DATE WHERE DESCRIPT = 'Online Application'")
             or die(mysql_error());
                        while($rowList = mysql_fetch_array($result))
                    {  
                        $start = $rowList['START'];
                        $end = $rowList['END'];
                      
                     }
            if ( $today > $end || $today < $start )
                {
                    header("Location: GFSSIS_G_ApplicationNotOpen.php");
                 ;}
                //echo date("D M d, Y ");
            else 
            {
                
            }
            
                        
    
     if (isset($_POST['submit'])) {
        
                    echo "Submitted";
                    $lrn = mysql_real_escape_string(htmlspecialchars( $_POST['lrn']));
                    $fname = mysql_real_escape_string(htmlspecialchars( $_POST['fname']));
                    $mname = mysql_real_escape_string(htmlspecialchars( $_POST['mname']));
                    $lname = mysql_real_escape_string(htmlspecialchars( $_POST['lname']));
                    $bdate = mysql_real_escape_string(htmlspecialchars( $_POST['bdate']));
                    $sex = mysql_real_escape_string(htmlspecialchars( $_POST['sex']));
                    $mtongue = mysql_real_escape_string(htmlspecialchars( $_POST['mtongue']));
                    $ip = mysql_real_escape_string(htmlspecialchars( $_POST['ip']));
                    $religion = mysql_real_escape_string(htmlspecialchars( $_POST['religion']));
                    $contact = mysql_real_escape_string(htmlspecialchars( $_POST['contact']));
                    $pbirth = mysql_real_escape_string(htmlspecialchars( $_POST['pbirth']));
                    $street = mysql_real_escape_string(htmlspecialchars( $_POST['street']));
                    $brgy = mysql_real_escape_string(htmlspecialchars( $_POST['brgy']));
                    $municipal = mysql_real_escape_string(htmlspecialchars( $_POST['municipal']));
                    $city = mysql_real_escape_string(htmlspecialchars( $_POST['city']));
                    $marital = mysql_real_escape_string(htmlspecialchars( $_POST['marital']));
                    $nation = mysql_real_escape_string(htmlspecialchars( $_POST['nation']));
                    $email = mysql_real_escape_string(htmlspecialchars( $_POST['email']));
                    $mother = mysql_real_escape_string(htmlspecialchars( $_POST['mother']));
                    $m_contact = mysql_real_escape_string(htmlspecialchars( $_POST['m_contact']));
                    $m_occu = mysql_real_escape_string(htmlspecialchars( $_POST['m_occu']));
                    $father = mysql_real_escape_string(htmlspecialchars( $_POST['father']));
                    $f_contact = mysql_real_escape_string(htmlspecialchars( $_POST['f_contact']));
                    $f_occu = mysql_real_escape_string(htmlspecialchars( $_POST['f_occu']));
                    $guard = mysql_real_escape_string(htmlspecialchars( $_POST['guard']));
                    $rel = mysql_real_escape_string(htmlspecialchars( $_POST['rel']));
                    $g_contact = mysql_real_escape_string(htmlspecialchars( $_POST['g_contact']));
                    $prevschool = mysql_real_escape_string(htmlspecialchars( $_POST['prevschool']));
                    $gwa = mysql_real_escape_string(htmlspecialchars( $_POST['gwa']));
                    $prevlevel = mysql_real_escape_string(htmlspecialchars( $_POST['prevlevel']));
                  if ($prevlevel == ""){
                    $result = mysql_query( "INSERT INTO `t_application` ( `A_DATE`, `A_STATUS`, `LRN`, `FNAME`, `MNAME`, `LNAME`, `BDATE`, `SEX`, `MTONGUE`, `IP`, `RELIGION`, `CONTACT`, `PBIRTH`, `STREET`, `BRGY`, `MUNICIPAL`, `CITY`, `MARITAL`, `NATIONALITY`, `EMAIL`, `MOTHER`, `MOTHER_PHONE`, `MOTHER_OCCU`, `FATHER`, `FATHER_PHONE`, `FATHER_OCCU`, `GUARD`, `GUARD_REL`, `GUARD_CONTACT`, `PREV_SCHOOL`, `GWA`, `PREV_GRADE_LEVEL`, `REQ_NSO`, `REQ_PIC`, `REQ_EXAM`, `REQ_F137`, `REQ_GMC`, `REQ_CERT`, `DELETE_FLAG`) VALUES ( '$today', 'Pending', '$lrn', '$fname', '$mname','$lname', '$bdate', '$sex', '$mtongue', '$ip', '$religion', '$contact', '$pbirth','$street', '$brgy','$municipal', '$city','$marital', '$nation', '$email','$mother', '$m_contact', '$m_occu', '$father','$f_contact','$f_occu', '$guard', '$rel', '$g_contact','$prevschool', '$gwa', 37, b'0', b'0', b'0', b'0', b'0', b'0', b'0')")
                  
                    or die(mysql_error()); 
                    }
                    else{
                        $result = mysql_query( "INSERT INTO `t_application` ( `A_DATE`, `A_STATUS`, `LRN`, `FNAME`, `MNAME`, `LNAME`, `BDATE`, `SEX`, `MTONGUE`, `IP`, `RELIGION`, `CONTACT`, `PBIRTH`, `STREET`, `BRGY`, `MUNICIPAL`, `CITY`, `MARITAL`, `NATIONALITY`, `EMAIL`, `MOTHER`, `MOTHER_PHONE`, `MOTHER_OCCU`, `FATHER`, `FATHER_PHONE`, `FATHER_OCCU`, `GUARD`, `GUARD_REL`, `GUARD_CONTACT`, `PREV_SCHOOL`, `GWA`, `PREV_GRADE_LEVEL`, `REQ_NSO`, `REQ_PIC`, `REQ_EXAM`, `REQ_F137`, `REQ_GMC`, `REQ_CERT`, `DELETE_FLAG`) VALUES ( '$today', 'Pending', '$lrn', '$fname', '$mname','$lname', '$bdate', '$sex', '$mtongue', '$ip', '$religion', '$contact', '$pbirth','$street', '$brgy','$municipal', '$city','$marital', '$nation', '$email','$mother', '$m_contact', '$m_occu', '$father','$f_contact','$f_occu', '$guard', '$rel', '$g_contact','$prevschool', '$gwa', '$prevlevel', b'0', b'0', b'0', b'0', b'0', b'0', b'0')")
                             or die(mysql_error()); 
                    }}
                  
               
    
?>
                     
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'GFSSIS_G_Head.php'; ?>
    <title>GFS | Application</title>
</head>
<body>
    <section id="main-content">
      <section class="wrapper"> 
        <div class="row">
          <div class="app-form"> 
            <div>
              <h1 class="app-success"><i class="fa fa-check-square-o"> Congratulations!</i></h1>
              <p class="app-details"> Congratulations [name of applicant]!<br> Your request for application has been successfully submitted. <br><br> Print your proof of application for complete details<br>
              Thank you!</p>
            </div>
            <div class="form-divider"></div>
            <a href="#" class="btn btn-congrats"><i class="fa fa-print"></i> Print Proof of Application</a>
          </div>
        </div>
      </section>
    </section>
</body>
</html>

<?php

  $connect = mysqli_connect('localhost','root','','sis');
  $errors = array();
  $username = "";


    session_start();

    if (isset($_POST['login'])) {
      $username = mysql_real_escape_string($_POST['username']);
      $password = mysql_real_escape_string($_POST['password']);
/*
      if (empty($username)) {
        array_push($errors, "username is required");
      }
      if (empty($password)) {
        array_push($errors, "password is required");
      }
*/

      if (count($errors) == 0) {
     /*   
        $query = "SELECT FACULTY_UID, FACULTY_PASS FROM R_FACULTY WHERE FACULTY_UID = '$username' AND FACULTY_PASS = '$password'";
        $result = mysqli_query($connect,$query);
    */

$ui = substr($username, 0,3);


      //if uid is faculty
     if ($ui == substr("FAC", 0,3)){


     
         $query = "SELECT FACULTY_UID, FACULTY_PASS FROM R_FACULTY WHERE FACULTY_UID = '$username' AND FACULTY_PASS = '$password'";
        $result = mysqli_query($connect,$query);

       

                      if (mysqli_num_rows($result) == 1) {
                        $_SESSION['username'] = $username;
                        $_SESSION['login'] = "true";
                       
                        echo "Login Success";
                        header('location: GFSSIS_F_Announcements.php');
                        
                      } else {
                        array_push($errors, "Invalid username/password combination");
                      }
                      }
      //if admin
     if ($ui == substr("ADM", 0,3)){


     
         $query = "SELECT ADMIN_UID, ADMIN_PASS FROM R_ADMIN WHERE ADMIN_UID = '$username' AND ADMIN_PASS = '$password'";
        $result = mysqli_query($connect,$query);

       

                      if (mysqli_num_rows($result) == 1) {
                        $_SESSION['username'] = $username;
                        $_SESSION['login'] = "true";
                       
                        echo "Login Success";
                        header('location: GFSSIS_A_SchoolSetup.php');
                        
                      } else {
                        array_push($errors, "Invalid username/password combination");
                      }
                      }

       //if learner
     if ($ui == substr("LRN", 0,3)){


     
         $query = "SELECT LEARNER_UID, LEARNER_PASS FROM R_LEARNER WHERE LEARNER_UID = '$username' AND LEARNER_PASS = '$password'";
        $result = mysqli_query($connect,$query);

       

                      if (mysqli_num_rows($result) == 1) {
                        $_SESSION['username'] = $username;
                        $_SESSION['login'] = "true";
                       
                        echo "Login Success";
                        // PUT PAGE AFTER LOGIN FOR LEARNER BELOW
                        //header('location: GFSSIS_A_SchoolSetup.php');
                        
                      } else {
                        array_push($errors, "Invalid username/password combination");
                      }
                      }

           //if registrar
     if ($ui == substr("REG", 0,3)){


     
         $query = "SELECT REGISTRAR_UID, REGISTRAR_PASS FROM R_REGISTRAR WHERE REGISTRAR_UID = '$username' AND REGISTRAR_PASS = '$password'";
        $result = mysqli_query($connect,$query);

       

                      if (mysqli_num_rows($result) == 1) {
                        $_SESSION['username'] = $username;
                        $_SESSION['login'] = "true";
                       
                        echo "Login Success";
                        // PUT PAGE AFTER LOGIN FOR REGISTRAR BELOW
                        //header('location: GFSSIS_A_SchoolSetup.php');
                        
                      } else {
                        array_push($errors, "Invalid username/password combination");
                      }
                      }

     //if PRINCIPAL
     if ($ui == substr("PRI", 0,3)){


     
         $query = "SELECT PRINCIPAL_UID, PRINCIPAL_PASS FROM R_PRINCIPAL WHERE PRINCPAL_UID = '$username' AND PRINCIPAL_PASS = '$password'";
        $result = mysqli_query($connect,$query);

       

                      if (mysqli_num_rows($result) == 1) {
                        $_SESSION['username'] = $username;
                        $_SESSION['login'] = "true";
                       
                        echo "Login Success";
                        // PUT PAGE AFTER LOGIN FOR PRINCIPAL BELOW
                        //header('location: GFSSIS_A_SchoolSetup.php');
                        
                      } else {
                        array_push($errors, "Invalid username/password combination");
                      }
                      }


        
      
      }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="images/favicon.png">
    <link rel="stylesheet" type="text/css" href="css/sweetalert.css">

    <title>Login</title>

    <!--Core CSS -->
    <link href="bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
    <script src="js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

  <body class="login-body">

    <div class="container" >

        <?php if (count($errors) > 0): ?>
            <div class="error">
              <?php foreach ($errors as $error): ?>
                <p><?php echo $error; ?></p>
              <?php endforeach ?>
            </div>
        <?php endif ?>


      <form class="form-signin" action="login.php" method="POST">
        <h2 class="form-signin-heading">sign in now</h2>
        <div class="login-wrap">
            <div class="user-login-info">
                <input type="text" class="form-control" required placeholder="Learner's Reference Number" name="username" autofocus value=<?php echo $username ?>>
                <input type="password" class="form-control" required placeholder="Password" name="password">
            </div>
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
                <span class="pull-right">
                    <a data-toggle="modal" href="#myModal"> Forgot Password?</a>

                </span>
            </label>
            <button class="btn btn-lg btn-login btn-block" type="submit" name="login">Log in</button>

            <div class="registration">
                Don't have an account yet?
                <a class="" href="registration.html">
                    Create an account
                </a>
            </div>

        </div>

          <!-- Modal -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header" style="background: #405d27">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">&times;</button>
                          <h4 class="modal-title" style="color: white">Forgot Password ?</h4>
                      </div>
                      <div class="modal-body">
                          <p>Enter your e-mail address below to reset your password.</p>
                          <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                      </div>
                      <div class="modal-footer">
                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                          <button class="btn btn-success" type="button">Submit</button>
                      </div>
                  </div>
              </div>
          </div>
          <!-- modal -->

      </form>

    </div>



    <!-- Placed js at the end of the document so the pages load faster -->

    <!--Core js-->
    <script src="js/jquery.js"></script>
    <script src="bs3/js/bootstrap.min.js"></script>

  </body>
</html>

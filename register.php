<?php
session_start();
if (isset($_SESSION['userSession'])!="") {
	header("Location: home.php");
}
require_once 'dbconnect.php';

if(isset($_POST['btn-signup'])) {
	$first = strip_tags($_POST['firstname']);
	$last = strip_tags($_POST['lastname']);
	$uname = strip_tags($_POST['username']);
	$uphone = strip_tags($_POST['phonenumber']);
	$email = strip_tags($_POST['email']);
	$upass = strip_tags($_POST['password']);
	
	$first = $DBcon->real_escape_string($first);
	$last = $DBcon->real_escape_string($last);
	$uname = $DBcon->real_escape_string($uname);
	$uphone = $DBcon->real_escape_string($uphone);
	$email = $DBcon->real_escape_string($email);
	$upass = $DBcon->real_escape_string($upass);

	
	$hashed_password = password_hash($upass, PASSWORD_DEFAULT); // this function works only in PHP 5.5 or latest version
	// check if fields are empty
	if(empty($first&&$last&&$uname&&$uphone&&$email&&$upass)){
            $errMSG = "Please Input All the fields.";
        }
          else  if(empty($first)){
            $errMSG = "Please Fill In First Name..";
        }
        else if(empty($last)){
            $errMSG = "Please Fill In LastName..";
        }
        else if(empty($uname)){
            $errMSG = "Please Fill In Username..";
        }
        else if(empty($uphone)){
            $errMSG = "Please Input Phone Number";
        } else if(empty($email)){
            $errMSG = "Please Input Email.";
        } else if(empty($upass)){
            $errMSG = "Please Input Password.";
        }
        
        else
        {
	$check_email = $DBcon->query("SELECT email FROM tbl_users WHERE email='$email'");
	$count=$check_email->num_rows;
	
	if ($count==0) {
		 //$query = $DBcon->prepare("INSERT INTO tbl_users(firstname,lastname,username,phonenumber,email,password) VALUES(?,?,?,?,?,?)");
        //$query->bind_param('ssssss',$first,$last,$uname,$uphone,$email,$hashed_password);
            //$query->execute();
		$query = "INSERT INTO tbl_users(firstname,lastname,username,phonenumber,email,password) VALUES('$first' , '$last' ,'$uname', '$uphone' ,'$email','$hashed_password')";
		

		if ($DBcon->query($query)) {
			 $successMSG1 = "Registered succesfully..";
			header("refresh:5;home.php");
		}else {
			 $errMSG1 = "Error while registering.";
					
		}
		
	} else {
		
		
		 $errMSG1 = "Sorry email already taken.";
			
	}
	
	$DBcon->close();
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Signup</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <!-- Bootstrap Core CSS -->
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
<link href="dist/css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom Fonts -->
<link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- jQuery -->
<script src="vendor/jquery/jquery.min.js"></script>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<!-- Optional theme -->
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
<!-- custom stylesheet -->
<link rel="stylesheet" href="style.css">
<!-- Latest compiled and minified JavaScript -->
<script src="bootstrap/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/theme.css" />
    <link rel="stylesheet" href="css/MoneAdmin.css" />
    <link rel="stylesheet" href="plugins/Font-Awesome/css/font-awesome.css" />
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>


    <div class="row" style="padding-top: 80px">
<div class="col-md-5 col-md-offset-3">
	<div class="panel panel-default">
		
			<div class="panel-heading">
				<center><strong>SIGNUP</strong></center>
				<?php
    if(isset($errMSG1)){
            ?>
            <div class="alert alert-danger">
                <span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG1; ?></strong>
            </div>
            <?php
    }
    else if(isset($successMSG1)){
        ?>
        <div class="alert alert-success">
              <strong><span class="glyphicon glyphicon-info-sign"></span> <?php echo $successMSG1; ?></strong>
        </div>
        <?php
    }
    ?>   
			</div>
			<div class="panel-body">
       
       <form class="form-signin" method="post" id="register-form">
        

              
			<div class="form-group input-group">
				 
                 <span class="input-group-addon">First Name</span>
                 <input class="form-control" type="text" name="firstname" placeholder="Firstname">
             </div>
             <div class="form-group input-group">
				 
                 <span class="input-group-addon">Last Name</span>
                 <input class="form-control" type="text" name="lastname" placeholder="Lastname">
             </div>
            
             <div class="form-group input-group">
                 
                 <span class="input-group-addon">Username</span>
                 <input class="form-control" type="text" name="username" placeholder="Username">
             </div>
              <div class="form-group input-group">
                 
                 <span class="input-group-addon">Phone No.</span>
                 <input class="form-control" type="text" name="phonenumber" placeholder="Phone No.">
             </div>
              <div class="form-group input-group">
                 
                 <span class="input-group-addon">Email Add</span>
                 <input class="form-control" type="email"   name="email" placeholder="Email">
             </div>
             <div class="form-group input-group">
                 
                 <span class="input-group-addon">Password.</span>
                 <input class="form-control" type="password" name="password" placeholder="Password">
             </div>
            
   	         &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button type="submit" name="btn-signup" class="btn btn-primary btn-round" value="POST">Signup.</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
   	         <a class="btn btn-primary btn-round" href="index.php">Login</a>
   	         </form>
   	          </div>
			<div class="panel-footer">
				<?php
    if(isset($errMSG)){
            ?>
            <div class="alert alert-danger">
                <span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
            </div>
            <?php
    }
    else if(isset($successMSG)){
        ?>
        <div class="alert alert-success">
              <strong><span class="glyphicon glyphicon-info-sign"></span> <?php echo $successMSG; ?></strong>
        </div>
        <?php
    }
    ?>   
			</div>
		</div>
	</div>
</div>

</body>
</html>
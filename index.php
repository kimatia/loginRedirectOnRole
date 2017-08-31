<?php
session_start();
require_once 'dbconnect.php';

if (isset($_SESSION['userSession'])!="") {
	header("Location: home.php");
	exit;
}

if (isset($_POST['btn-login'])) {
	
	$email = strip_tags($_POST['email']);
	$password = strip_tags($_POST['password']);
	
	$email = $DBcon->real_escape_string($email);
	$password = $DBcon->real_escape_string($password);
	if(empty($email&&$password)){
        $errMSG="Please fill in all the fields!";
    }else{
	$query = $DBcon->query("SELECT user_id, email, password,logintype FROM tbl_users WHERE email='$email'");
	$row=$query->fetch_array();
	
	$count = $query->num_rows; // if email/password are correct returns must be 1 row
	
	if (password_verify($password, $row['password']) && $count==1) {
        if($row['logintype'] == "admin" ){
        $_SESSION['userSession'] = $row['user_id'];
        $successMSG1="Successfuly signed in...";
        header("refresh:5; adhome.php");
        }
        else {
               $_SESSION['userSession'] = $row['user_id'];
        $successMSG1="Successfuly signed in...";
        header("refresh:5; home.php");
            }
		
	} else {
		$errMSG1="Invalid email address or paword.";
	}
	$DBcon->close();
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Login</title>
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
				<center><strong>LOGIN</strong></center>
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
        <span class="input-group-addon">Email Add</span>
        <input type="email" class="form-control" placeholder="Email address" name="email" />
       
        </div>
        
        <div class="form-group input-group">
        <span class="input-group-addon">Password.</span>
        <input type="password" class="form-control" placeholder="Password" name="password" />
        </div>
       
     	<hr />
        
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-round" name="btn-login" id="btn-login">
    		<span class="glyphicon glyphicon-log-in"></span> &nbsp;Login
			</button>  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            
            <a href="register.php" class="btn btn-primary btn-round">Signup</a>
            
        </div>  
        
        
      
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
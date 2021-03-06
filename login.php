<?php
session_start();
include 'config/dbconfig.php';
require_once 'class/class.user.php';
require_once 'class/class.error.php';

$user_login = new USER();
$user_error = new ErrorRep();

if($user_login->is_logged_in()!="")
{
	$user_login->redirect('my/home.php');
}

if(isset($_POST['btn-login']))
{
	$email = addslashes($_POST['txtemail']);
	$upass = addslashes($_POST['txtupass']);
	if(filter_var($email,FILTER_VALIDATE_EMAIL)) {
		if($user_login->login($email,$upass))
			{
				$user_login->redirect('my/home.php');
			}
	}
    else
	{
		header("Location: login.php?error=2C");
	}

}

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Đăng nhập | <?php echo $siteTitle ?></title>
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="assets/styles.css" rel="stylesheet" media="screen">
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  </head>
  <body id="login">
    <div class="container">
        <form class="form-signin" method="post">
        <?php
        if(isset($_GET['error']))
			if ($user_error->exist($_GET['error']))
				{
					?>
						<div class='alert alert-warning'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong><?php $user_error->ectt($_GET['error']); ?></strong>
						</div>
					<?php
				}
					?>
	   <?php
        if(isset($_GET['success']))
			if ($user_error->exist($_GET['success']))
				{
					?>
						<div class='alert alert-success'>
						<button class='close' data-dismiss='success'>&times;</button>
						<strong><?php $user_error->ectt($_GET['success']); ?></strong>
						</div>
					<?php
				}
					?>
        <h2 class="form-signin-heading">Đăng nhập</h2><hr />
        <input type="email" class="input-block-level" placeholder="Địa chỉ email" name="txtemail" required />
        <input type="password" class="input-block-level" placeholder="Mật khẩu" name="txtupass" required />
     	<hr />
        <button class="btn btn-large btn-primary" type="submit" name="btn-login">Đăng nhập</button>
        <a href="signup.php" style="float:right;" class="btn btn-large">Đăng ký</a><hr />
        <a href="fpass.php">Bạn quên mật khẩu ? </a>
      </form>

    </div> <!-- /container -->
    <?php include("template/misc.php") ?>
  </body>
</html>

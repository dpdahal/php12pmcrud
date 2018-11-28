<?php
// required config file
require_once(__DIR__ . '/../../config/config.php');
require_once(__DIR__ . '/../../config/database.php');
require_once(__DIR__ . '/../../help/help.php');

if (!empty($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $selectQuery = "SELECT * FROM tbl_users WHERE username='$username' 
&& password='$password' && status=1";
    $prepare = mysqli_query($connection, $selectQuery);
    $numberOfRow = mysqli_num_rows($prepare);
    if ($numberOfRow > 0) {
        $findData = mysqli_fetch_assoc($prepare);
        $_SESSION['user_id'] = $findData['id'];
        $_SESSION['user_name'] = $findData['username'];
        $_SESSION['user_email'] = $findData['email'];
        $_SESSION['user_image'] = $findData['image'];
        $_SESSION['is_log_in'] = true;
        redirect_to('admin');


    } else {
        $_SESSION['error'] = 'username and password not match';
        redirect_to('admin/login');
    }

}


?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login page</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?= base_url('public/admin/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="<?= base_url('public/admin/bower_components/font-awesome/css/font-awesome.min.css') ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?= base_url('public/admin/bower_components/Ionicons/css/ionicons.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('public/admin/bower_components/select2/dist/css/select2.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/admin/dist/css/AdminLTE.min.css') ?>">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect. -->
    <link rel="stylesheet" href="<?= base_url('public/admin/dist/css/skins/skin-blue.min.css') ?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Login to dashboard</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <?= messages(); ?>
        <form action="" method="post">
            <div class="form-group has-feedback">
                <input type="text" name="username" class="form-control" placeholder="username">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div>
</div>
<!
<!-- REQUIRED JS SCRIPTS -->
<!-- jQuery 3 -->
<script src="<?= base_url('public/admin/bower_components/jquery/dist/jquery.min.js') ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url('public/admin/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('public/admin/bower_components/select2/dist/js/select2.full.min.js') ?>"></script>
<script src="<?= base_url('public/admin/dist/js/adminlte.min.js') ?>"></script>
<script src="<?= base_url('public/admin/custom/custom.js') ?>"></script>
</body>
</html>


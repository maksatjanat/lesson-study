<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin panel</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" type="image/x-icon" href="../assets/img/favicon.png">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link href="dist/css/fontawesome/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/style.css">
  <link rel="stylesheet" href="dist/css/main.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" type="text/css" href="plugins/clockpicker-gh-pages/dist/bootstrap-clockpicker.min.css">
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="plugins/iCheck/all.css">
  <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
  <link href="plugins/tree/css/jstree/style.css" rel="stylesheet" type="text/css">
  <link href="plugins/bootstrap-fileinput-master/css/fileinput.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="plugins/caleandar-master/css/theme2.css"/>
  <meta name="yandex-verification" content="b54893ffee4f973c" />
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <?php
    session_start();

    if(isset($_SESSION['username'])){

      require("config/db.php");

      $user = mysql_query("SELECT * FROM db_users_admin u WHERE u.username = '$_SESSION[username]' ");
      $user_info  = mysql_fetch_array($user);

      require("functions.php");
      require("modules/header.php");
      require("modules/left-main.php");
      require("modules/content.php");
      require("modules/footer.php");

    }else{
      header("Location: ./login.php");
    }
    require("scripts.php");
    ?>
    <div class="control-sidebar-bg"></div>
  </div>
</body>

</html>

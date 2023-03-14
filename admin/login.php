<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin panel</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" type="image/x-icon" href="../assets/img/favicon.png">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/style.css">
  <link href="dist/css/fontawesome/css/all.min.css" rel="stylesheet">
</head>

<body class="hold-transition login-page" style="height: 80%;">
  <?php
  session_start(); 
  if(isset($_SESSION['msg'])){
    echo'<div class="alert alert-danger alert-dismissible" id="message" style="position: fixed; top: 0px; width: 100%; text-align: center; padding: 3px 35px 3px 3px;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fa fa-ban"></i>Логин или пароль не верный</h5>
    </div>';
  }
  ?>
  
  <div class="login-box">
    <div class="login-logo" style="font-family: Nova Mono; font-size: 40px; background-color: #303030; margin: 0; padding: 20px; color: white">
      <div class="row">
        <div class="col-md-8"> <p style="font-size: 30px;">Admin panel </p> </div>
      </div>
    </div>
    <div class="login-box-body">
      <p class="login-box-msg">Войдите, чтобы начать сеанс</p>
      <form action="login_test.php" method="post" required="" autocomplete="off">
        <?php
        if(isset($_SESSION['msg'])){

          echo'
          <div class="form-group has-error">
          <input type="text" name="login" class="form-control" placeholder="Логин" required="" value="'.$_SESSION['login'].'">
          </div>
          <div class="form-group has-error">
          <input type="password" name="pass" class="form-control" placeholder="Пароль" required="" value="'.$_SESSION['pass'].'">
          </div>';

          unset($_SESSION['msg']);
          unset($_SESSION['login']);
          unset($_SESSION['pass']);

        }else{
        ?>
          <div class="form-group has-feedback">
            <input type="text" name="login" class="form-control" placeholder="Логин" required="" autocomplete="off">
            <span class="form-control-feedback"><i class="fas fa-user"></i></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="pass" class="form-control" placeholder="Пароль" required="" autocomplete="off">
            <span class="form-control-feedback"><i class="fas fa-key"></i></span>
          </div>
        <?php
        }
        ?>
        <div class="row">
          <div class="col-xs-8" style="padding-top: 8px;">
          </div>
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Войти</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script>
  $('#message').show(1000, function(){
    setTimeout(function(){
      $('#message').hide(200);
    }, 2500);
  });
</script>
</html>

<?php
if(isset($_POST['change_password'])){

  $old_password = $_POST['old_password'];
  $new_password = $_POST['new_password'];
  $confirm_new_password = $_POST['confirm_new_password'];

  $old_password = stripslashes($old_password);
  $old_password = htmlspecialchars($old_password);
  $old_password = trim($old_password);
  $new_password = stripslashes($new_password);
  $new_password = htmlspecialchars($new_password);
  $new_password = trim($new_password);
  $confirm_new_password = stripslashes($confirm_new_password);
  $confirm_new_password = htmlspecialchars($confirm_new_password);
  $confirm_new_password = trim($confirm_new_password);

  $old_password = md5($old_password);

  if($new_password != $confirm_new_password){
    $_SESSION['msg'] = '<div class="alert alert-warning alert-dismissible" id="message">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <h5><i class="icon fa fa-check"></i> Новые пароли не совпадают! </h5>
                        </div>';
    exit("<meta http-equiv=\"refresh\" content=\"0;url=?setting\">");
  }else{

    $query_test_password = mysql_query("SELECT * FROM db_users WHERE username='$_SESSION[username]' AND password='$old_password' ");
    $result_test_password = mysql_fetch_array($query_test_password);

    if($result_test_password['id_user'] != ''){
      $new_password = md5($new_password);

      $update_password = mysql_query("UPDATE db_users SET password='$new_password' WHERE username='$_SESSION[username]' ");

      if($update_password == true) $_SESSION['msg'] = '<div class="alert alert-success alert-dismissible" id="message">
                                                         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                         <h5><i class="icon fa fa-check"></i> Пароль успешно изменен! </h5>
                                                       </div>';
      else $_SESSION['msg'] = ' <div class="alert alert-warning alert-dismissible" id="message">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                  <h5><i class="icon fa fa-check"></i> Ошибка сервера! Попробуйте позже </h5>
                                </div>';
  
      exit("<meta http-equiv=\"refresh\" content=\"0;url=?setting\">");

    }else{
      $_SESSION['msg'] = '<div class="alert alert-warning alert-dismissible" id="message">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fa fa-check"></i> Старый пароль не правильно! </h5>
                          </div>';
      exit("<meta http-equiv=\"refresh\" content=\"0;url=?setting\">");
    }
  }
}else{
?>
<div class="content-wrapper" style="margin-top: -20px;">
  <section class="content-header">
    <h1>
      Сменить пароль
    </h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <?php if(isset($_SESSION['msg'])) echo $_SESSION['msg']; unset($_SESSION['msg']); ?>
      </div>
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <div class="box box-info">
          
          <div class="box-body">
            <form action="?setting" method="post" required>
              <div class="row" style="padding: 20px 30px">
                <div class="col-md-12">
                  
                  <div class="form-group">
                    <label>Старый пароль</label><br>
                    <input name="old_password" type="password" class="form-control" required placeholder="*********">
                  </div>

                  <div class="form-group">
                    <label>Новый пароль</label><br>
                    <input name="new_password" type="password" class="form-control" required placeholder="*********">
                  </div>

                  <div class="form-group">
                    <label>Подтвердить новый пароль</label><br>
                    <input name="confirm_new_password" type="password" class="form-control" required placeholder="*********">
                  </div>

                </div>

                <div class="col-md-12 text-center">
                  <br>
                  <input name="change_password" type="submit" class="btn btn-primary btn-flat" value="Изменить">
                </div>

              </div>
            </form>
          </div>

        </div>
      </div>

    </div>
  </section>
</div>
<?php
}
?>
<?php
session_start();
include_once("admin/config/db.php");

if(isset($_POST['login'])){

  $login = $_POST['login'];
  $pass  = $_POST['password'];
  
  $login  = stripslashes($login);
  $login  = htmlspecialchars($login);
  $login  = trim($login);
  $pass = stripslashes($pass);
  $pass = htmlspecialchars($pass);
  $pass = trim($pass);

  $password = md5($pass);
  
  $user = mysql_query("SELECT * FROM db_users
                               WHERE username = '$login' 
                                 AND password = '$password' 
                                 AND access = 1 ");
  $row  = mysql_fetch_array($user);
  
  if($row['id_user'] != ''){
    $_SESSION['username_student'] = $row['username'];
    $_SESSION['id_user'] = $row['id_user'];
    $_SESSION['fname_user'] = $row['fname_user'];
    $_SESSION['name_user'] = $row['name_user'];
  }
  else{
    $_SESSION['login'] = $login;
    $_SESSION['pass'] = $pass;
    $_SESSION['msg'] = '1';
  }

  header("Location: ./");

}else{
  header("Location: ./login.php");
}
?>
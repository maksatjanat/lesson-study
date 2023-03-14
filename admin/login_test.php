<?php
session_start();
require("config/db.php");

if(isset($_POST['login'])){

  $login = $_POST['login'];
  $pass  = $_POST['pass'];
  
  $login  = stripslashes($login);
  $login  = htmlspecialchars($login);
  $login  = trim($login);
  $pass = stripslashes($pass);
  $pass = htmlspecialchars($pass);
  $pass = trim($pass);

  $password = md5($pass);
  
  $user = mysql_query("SELECT * FROM db_users_admin
                               WHERE username = '$login' 
                                 AND password = '$password' 
                                 AND access = 1 ");
  $row  = mysql_fetch_array($user);
  
  if($row['id_user'] != ''){
    $_SESSION['username'] = $row['username'];
    $_SESSION['level_user'] = $row['level_user'];
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
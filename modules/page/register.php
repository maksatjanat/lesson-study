<?php
if (isset($_POST['fullname'])) {
    if (emailExist($_POST['fullname'])) {
        header("Location: /?page=login");
        die();
    } else {
        addUser($_POST['fullname'], $_POST['phone'], $_POST['password']);
    }
}

function emailExist($email) {
    $query = mysql_query("SELECT * FROM db_users WHERE username = '$_POST[phone]'");
    $result = mysql_fetch_assoc($query);
    $_SESSION['exist'] = true;
    return $result==true?1:0;
}
function addUser($fullname, $phone, $password)
{
    $password = md5($password);
	$newUserQuery = mysql_query("INSERT INTO db_users (username, password, fname_user, name_user, level_user, access) 
                                               VALUES ('$phone', '$password', ' ', '$fullname', 1, 1) ");
	$_SESSION['registered'] = 'true';
	if($newUserQuery == true) header("Location: /?page=login");

}
?>

<div>
	<div id="titlebar" class="gradient">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
	
					<h2>Регистрация</h2>
	
					<!-- Breadcrumbs -->
					<nav id="breadcrumbs" class="dark">
						<ul>
							<li><a href="./">Главная</a></li>
							<li>Регистрация</li>
						</ul>
					</nav>
	
				</div>
			</div>
		</div>
	</div>
	
	<div class="container">
		<div class="row">
			<div class="col-xl-5 offset-xl-3">
	
	
				<div class="login-register-page">
					<!-- Welcome Text -->
					<div class="welcome-text">
						<h3>Мы рады встретиться с вами снова!</h3>
						<span>Пожалуйста, войдите, чтобы продолжить сеанс</span>
					</div>
						
					<!-- Form -->
					<form method="post" id="login-form">
						<div class="input-with-icon-left">
							<i class="icon-material-outline-account-circle"></i>
							<input type="text" class="input-text with-border" name="fullname" placeholder="Ваше ФИО" required>
						</div>

						<div class="input-with-icon-left">
							<i class="icon-feather-smartphone"></i>
							<input type="text" class="input-text with-border" name="phone" data-inputmask="&quot;mask&quot;: &quot;9(999) 999-9999&quot;" data-mask="" placeholder="Телефон" required>
						</div>
						
						<div class="input-with-icon-left">
							<i class="icon-material-outline-lock"></i>
							<input type="password" class="input-text with-border" name="password" id="password" placeholder="пароль" required>
						</div>
					</form>
					
					<br>
					<!-- Button -->
					<button class="button full-width button-sliding-icon ripple-effect margin-top-10" type="submit" form="login-form"> Регистрация <i class="icon-material-outline-arrow-right-alt"></i></button>
					<br>
				</div>
	
			</div>
		</div>
	</div>

	<div class="margin-top-100"></div>
</div>
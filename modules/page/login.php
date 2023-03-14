<div>
	<div id="titlebar" class="gradient">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
	
					<h2>Вход</h2>
	
					<!-- Breadcrumbs -->
					<nav id="breadcrumbs" class="dark">
						<ul>
							<li><a href="./">Главная</a></li>
							<li>Вход</li>
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
					<form action="login_test.php" method="post" id="login-form" required>
						<div class="input-with-icon-left">
							<i class="icon-feather-smartphone"></i>
							<input type="text" class="input-text with-border" name="login" data-inputmask="&quot;mask&quot;: &quot;9(999) 999-9999&quot;" data-mask="" placeholder="Телефон" required>
						</div>
	
						<div class="input-with-icon-left">
							<i class="icon-material-outline-lock"></i>
							<input type="password" class="input-text with-border" name="password" id="password" placeholder="пароль" required>
						</div>
						<a href="#" class="forgot-password">Забыли пароль?</a>
					</form>
					
					<!-- Button -->
					<button class="button full-width button-sliding-icon ripple-effect margin-top-10" type="submit" form="login-form"> Вход <i class="icon-material-outline-arrow-right-alt"></i></button>
					
					<!-- Social Login -->
					<div class="social-login-separator"><span>или</span></div>
					<div class="social-login-buttons">
						<button class="facebook-login ripple-effect" style="width: 100%; max-width: 100% !important;" onclick="Register();"> <b>Регистрация</b> </button>
					</div>
				</div>
	
			</div>
		</div>
	</div>

	<div class="margin-top-80"></div>
</div>

<script>
	function Register(){
	  window.location.href = '?page=register';
	}
</script>
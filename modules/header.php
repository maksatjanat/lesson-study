<!-- Header Container -->
<header id="header-container"> <!-- class="fullwidth" -->

	<div id="header">
		<div class="container">
			
			<div class="left-side">
				<div id="logo">
					<a href="./"><img src="images/cplus2.png"></a>
				</div>
			</div>

			<div class="right-side">
				<nav id="navigation">
					<ul id="responsive">
						<li><a href="?page=all_courses&search=">Курсы</a></li>
						<?php
						if(isset($_SESSION['username_student'])) echo"<li><a href='logout.php' class='button ripple-effect' style='color: white; font-weight: 400;'> $_SESSION[username_student] </a></li>";
						else echo"<li><a href='?page=login' class='button ripple-effect' style='color: white; font-weight: 400;'> Вход / Регистрация </a></li>";
						?>
					</ul>
				</nav>
				<span class="mmenu-trigger">
					<button class="hamburger hamburger--collapse" type="button">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					</button>
				</span>
				<div class="clearfix"></div>
			</div>

		</div>
	</div>

</header>
<!-- Header Container / End -->


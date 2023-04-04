<?php
function CourseRating(){

	$q_list_reviews = mysql_query("SELECT * FROM db_list_current_reviews WHERE course_id = '$_GET[course_id]' AND status = 1 ");
	$r_list_reviews = mysql_fetch_array($q_list_reviews);

	if($r_list_reviews['id_list_current_reviews'] != ''){

		$col = 0;
		$rating_sum = 0;
		do{
			$rating_sum += $r_list_reviews['appraisal'];
			$col++;
		}while($r_list_reviews = mysql_fetch_array($q_list_reviews));

		$rating = $rating_sum/$col;
		$rating = round($rating, 1);
		echo"<div class='star-rating' data-rating='$rating'></div>";

	}else echo"<div class='star-rating' data-rating='5'></div>";
}

if(isset($_GET['course_id'])){

	$q_course_info = mysql_query("SELECT * FROM db_list_courses
													  					   WHERE course_id = $_GET[course_id]");
	$r_course_info = mysql_fetch_array($q_course_info);

	$price = $r_course_info['course_price'];
	$price = number_format($price, 0, '.', ' ');

	if(isset($_SESSION['id_user'])){

		$q_users_access_to_course = mysql_query("SELECT * FROM db_users_access_to_courses
	 																								 WHERE id_user = $_SESSION[id_user]
	 																								   AND course_id = $_GET[course_id] ");
	  $r_users_access_to_course = mysql_fetch_array($q_users_access_to_course);

	  if($r_users_access_to_course['user_access_to_course_id'] != '') $access = 1; else $access = 0;

	}else $access = 0;
}

if(isset($_POST['give_feedback'])){

	$current_date = date("d.m.Y");
	$current_time = time();
	$insert_feedback = mysql_query("INSERT INTO db_list_current_reviews (course_id, username, author_fio, text_reviews, arrival_date, order_date, appraisal, status) 
																														   VALUES ('$_GET[course_id]', '$_SESSION[username]', '$_POST[author_fio]', '$_POST[text_reviews]', '$current_date', '$current_time', '$_POST[appraisal]', '0') ");

	header("Location: ./?page=course_info&course_id=$_GET[course_id]");
}
?>

<div class="single-page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<nav id="breadcrumbs" class="dark" style="float: right; margin-bottom: 15px">
					<ul>
						<li><a href="./">Главная</a></li>
						<li><a href="?page=all_courses">Курсы</a></li>
						<li><?=$r_course_info[course_name]?></li>
					</ul>
				</nav>
			</div>
			<div class="col-md-12">
				<div class="single-page-header-inner">
					<div class="row">	
						<div class="col-md-7">
							<img src="images/logo_courses/<?=$r_course_info['course_photo']?>">
						</div>
						<div class="col-md-5">
							<div class="header-details" style="padding-top: 20px;">
								<h3><?=$r_course_info[course_name]?></h3>
								<br>
								<?=CourseRating();?>
								<br>
								<p align="right">
									<b>Автор курса:</b> <?=$r_course_info[course_author_name]?><br>
									<b>Начало курса:</b> <?=$r_course_info[course_date_started]?> ж.<br>
									<br>
									<span style="font-size: 24px; color: #F33816; font-weight: bold"> <?=$price?> тг. </span>								
								</p>
								<?php
								if(!isset($_SESSION['id_user'])) echo "<a href='?page=login'><p align='right'><button class='button button-sliding-icon ripple-effect' style='width: 170px;'> Открыть курс <i class='icon-material-outline-arrow-right-alt'></i></button></p></a>";
								else if(isset($_SESSION['id_user'])) echo "<a href='?page=course_materials&course_id=$_GET[course_id]'><p align='right'><button class='button button-sliding-icon ripple-effect' style='width: 170px;'> Открыть курс <i class='icon-material-outline-arrow-right-alt'></i></button></p></a>";
	
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-xl-8 col-lg-8 content-right-offset">

			<!-- Курсқа кіріспе -->
			<div class="single-page-section">
				<h2 class="margin-bottom-25 text-center">Введение в курс</h2>
				<p align="center">
									<?=$r_course_info['course_introduction']?>
				</p>
			</div>

			<!-- Курс не туралы -->
			<div class="single-page-section">
				<h3 class="margin-bottom-25">Про что курс?</h3>
				<p align="justify">
					<?=$r_course_info[course_about]?>
				</p>
			</div>

			<!-- Курс кімдерге арналады -->
			<div class="single-page-section">
				<h3 class="margin-bottom-25">Для кого этот курс?</h3>
				<p align="justify">
					<?=$r_course_info[course_for_who_is]?>
				</p>
			</div>

			<!-- Бұл курста не үйренесің -->
			<div class="single-page-section">
				<h3>Чему вы научитесь на этом курсе??</h3>
				<p align="justify">
					<?=$r_course_info[course_what_will_you_learn]?>
				</p>
			</div>

			<!-- Курсты кім жүргізеді -->
			<div class="single-page-section">
				<h3 class="margin-bottom-25">Кто ведет курс??</h3>
				<p align="justify">
					<?=$r_course_info[course_author_info]?>
				</p>
			</div>

		</div>

		<!-- Sidebar -->
		<div class="col-xl-4 col-lg-4">
			<div class="sidebar-container">
					
				<!-- Sidebar Widget -->
				<div class="sidebar-widget">
					<div class="job-overview">
						<div class="job-overview-headline">Темы курса</div>
						<div class="job-overview-inner">
							<ol>
								<?=ListCourseMaterials($_GET['course_id'])?>
							</ol>
						</div>
					</div>
				</div>

				<!-- Share -->
				<div class="sidebar-widget">
					<h3>Ссылка на эту страницу</h3>
					<!-- Copy URL -->
					<div class="copy-url">
						<input id="copy-url" type="text" value="" class="with-border">
						<button class="copy-url-button ripple-effect" data-clipboard-target="#copy-url" title="Скопировать в буфер обмена" data-tippy-placement="top"><i class="icon-material-outline-file-copy"></i></button>
					</div>

					<!-- Share Buttons -->
					<!-- <div class="share-buttons margin-top-25">
						<div class="share-buttons-trigger"><i class="icon-feather-share-2"></i></div>
						<div class="share-buttons-content">
							<span><strong>Поделиться этим!</strong></span>
							<ul class="share-buttons-icons">
								<li><a href="#" data-button-color="#3b5998" data-tippy-placement="top"><i class="icon-brand-facebook-f"></i></a></li>
								<li><a href="#" data-button-color="#1da1f2" data-tippy-placement="top"><i class="icon-brand-twitter"></i></a></li>
								<li><a href="#" data-button-color="#0077b5" data-tippy-placement="top"><i class="icon-brand-vk"></i></a></li>
								<li><a href="#" data-button-color="#40A7E3" data-tippy-placement="top"><i class="icon-brand-telegram-plane"></i></a></li>
								<li><a href="#" data-button-color="#06D755" data-tippy-placement="top"><i class="icon-brand-whatsapp"></i></a></li>
							</ul>
						</div>
					</div> -->
				</div>

			</div>
		</div>

		<div class="col-8">
			<div class="boxed-list margin-bottom-60">
				<div class="boxed-list-headline">
					<h3><i class="icon-material-outline-thumb-up"></i> Отзывы </h3>
				</div>
				<?php
					ListActualReviews($_GET['course_id']);

					if(isset($_SESSION['id_user']) && $access == 1){

						$q_info_review = mysql_query("SELECT * FROM db_list_current_reviews WHERE username = '$_SESSION[username]' AND course_id = '$_GET[course_id]' ");
						$r_info_review = mysql_fetch_array($q_info_review);

						if($r_info_review['id_list_current_reviews']){

							echo"";
						}else{

						echo'
							<div class="centered-button margin-top-35">
								<a href="#small-dialog" class="popup-with-zoom-anim button button-sliding-icon"> Пікір қалдыру <i class="icon-material-outline-arrow-right-alt"></i></a>
							</div>';
						}

					}else if(isset($_SESSION['id_user']) && $access == 0){

						echo"<br><p align='center'><button class='button button-sliding-icon ripple-effect' style='width: 170px;'> Открыть курс <i class='icon-material-outline-arrow-right-alt'></i></button></p>";
					}else{

						echo"<br><p align='center'><button class='button button-sliding-icon ripple-effect' style='width: 170px;'> Открыть курс <i class='icon-material-outline-arrow-right-alt'></i></button></p>";
					}
				?>
				<!-- Pagination -->
				<!-- <div class="clearfix"></div>
				<div class="pagination-container margin-top-40 margin-bottom-0">
					<nav class="pagination">
						<ul>
							<li><a href="#" class="ripple-effect current-page">1</a></li>
							<li><a href="#" class="ripple-effect">2</a></li>
							<li><a href="#" class="ripple-effect">3</a></li>
							<li class="pagination-arrow"><a href="#" class="ripple-effect"><i class="icon-material-outline-keyboard-arrow-right"></i></a></li>
						</ul>
					</nav>
				</div>
				<div class="clearfix"></div> -->
				<!-- Pagination / End -->
			</div>
		</div>

	</div>
</div>

<div id="small-dialog" class="zoom-anim-dialog mfp-hide dialog-with-tabs" style="min-width: 300px; width: 35%;">
	<div class="sign-in-form">
		<ul class="popup-tabs-nav">
			<li><a href="#tab"> Оставить отзыв </a></li>
		</ul>

		<div class="popup-tabs-container">
			<div class="popup-tab-content" id="tab">
				<form action="" method="post" id="leave-company-review-form" required>
					<div class="welcome-text">
						<h3>Оценить курс</h3>
						<div class="clearfix"></div>
						<div class="leave-rating-container">
							<div class="leave-rating margin-bottom-5">
								<input type="radio" name="appraisal" id="rating-1" value="5" required>
								<label for="rating-1" class="icon-material-outline-star"></label>
								<input type="radio" name="appraisal" id="rating-2" value="4" required>
								<label for="rating-2" class="icon-material-outline-star"></label>
								<input type="radio" name="appraisal" id="rating-3" value="3" required>
								<label for="rating-3" class="icon-material-outline-star"></label>
								<input type="radio" name="appraisal" id="rating-4" value="2" required>
								<label for="rating-4" class="icon-material-outline-star"></label>
								<input type="radio" name="appraisal" id="rating-5" value="1" required>
								<label for="rating-5" class="icon-material-outline-star"></label>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>

					<div class="row">
						<div class="col-xl-12">
							<div class="input-with-icon-left" title="Leave blank to add review anonymously" data-tippy-placement="bottom">
								<i class="icon-material-outline-account-circle"></i>
								<input type="text" class="input-text with-border" name="author_fio" id="name" placeholder="Атыңыз" value="<?=$_SESSION['fname_user']." ".$_SESSION['name_user']?>" required>
							</div>
						</div>
					</div>

					<textarea class="with-border" placeholder="Пікіріңіз" name="text_reviews" id="message" cols="7" required></textarea>
				</form>

				<button class="button margin-top-35 full-width button-sliding-icon ripple-effect" name="give_feedback" type="submit" form="leave-company-review-form" value="ok"> Пікір қалдыру <i class="icon-material-outline-arrow-right-alt"></i></button>
			</div>
		</div>

	</div>
</div>

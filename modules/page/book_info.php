<?php
function BookRating(){

	$q_list_reviews = mysql_query("SELECT * FROM db_list_current_reviews WHERE book_id = '$_GET[book_id]' AND status = 1 ");
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

if(isset($_GET['book_id'])){

	$q_book_info = mysql_query("SELECT * FROM db_list_books
													  					WHERE book_id = $_GET[book_id]");
	$r_book_info = mysql_fetch_array($q_book_info);

	$price = $r_book_info['book_price'];
	$price = number_format($price, 0, '.', ' ');

	if(isset($_SESSION['id_user'])){

		$q_users_access_to_book = mysql_query("SELECT * FROM db_users_access_to_books
	 																								 WHERE id_user = $_SESSION[id_user]
	 																								   AND book_id = $_GET[book_id] ");
	  $r_users_access_to_book = mysql_fetch_array($q_users_access_to_book);

	  if($r_users_access_to_book['user_access_to_book_id'] != '') $access = 1; else $access = 0;

	}else $access = 0;
}

if(isset($_POST['give_feedback'])){

	$current_date = date("d.m.Y");
	$current_time = time();
	$insert_feedback = mysql_query("INSERT INTO db_list_current_reviews (book_id, username, author_fio, text_reviews, arrival_date, order_date, appraisal, status) 
																														   VALUES ('$_GET[book_id]', '$_SESSION[username]', '$_POST[author_fio]', '$_POST[text_reviews]', '$current_date', '$current_time', '$_POST[appraisal]', '0') ");

	header("Location: ./?page=book_info&book_id=$_GET[book_id]");
}

$r_book_materials = mysql_query("SELECT * FROM db_list_book_materials WHERE book_id = '$_GET[book_id]' ");
if(mysql_num_rows($r_book_materials) > 0){
  $cats = array();
  while($cat = mysql_fetch_assoc($r_book_materials)){
    $cats_ID[$cat['id']][] = $cat;
    $cats[$cat['book_material_parent_id']][$cat['book_material_id']] = $cat;
  }
}

function build_tree($cats, $parent_id, $only_parent = false){
  if(is_array($cats) and isset($cats[$parent_id])){
    $tree = '<ul style="list-style: none;">';
    if($only_parent==false){
      foreach($cats[$parent_id] as $cat){
        $tree .= '<li>'.$cat['book_material_theme'];
        $tree .=  build_tree($cats,$cat['book_material_id']);
        $tree .= '</li>';
      }
    }elseif(is_numeric($only_parent)){
      $cat = $cats[$parent_id][$only_parent];
      $tree .= '<li>'.$cat['book_material_theme'];
      $tree .=  build_tree($cats,$cat['book_material_id']);
      $tree .= '</li>';
    }
    $tree .= '</ul>';
  }
  else return null;
  return $tree;
}
?>

<div class="single-page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-3">
						<img src="images/logo_books/<?=$r_book_info['book_photo']?>">
					</div>
					<div class="col-md-4">
						<div class="header-details" style="padding-top: 20px; padding-left: 50px;">
							<h3><?=$r_book_info[book_name]?></h3>
							<br>
							<?=BookRating();?>
							<br>
							<p align="left">
								<b>Автор книги:</b> <?=$r_book_info[book_author_name]?><br>
								<b>год:</b> <?=$r_book_info[book_year_publication]?><br>
								<b>Количество страниц:</b> <?=$r_book_info[book_number_page]?><br>
								<br>
								<span style="font-size: 24px; color: #F33816; font-weight: bold"> <?=$price?> тг. </span>								
							</p>
							<?php
							if($access == 0) echo "<p align='left'><button class='button button-sliding-icon ripple-effect' style='width: 170px;'> Купить <i class='icon-material-outline-arrow-right-alt'></i></button></p>";
							else if($access == 1) echo "<a href='?page=book_materials&book_id=$_GET[book_id]'><p align='left'><button class='button button-sliding-icon ripple-effect' style='width: 170px;'> Кітапты оқу <i class='icon-material-outline-arrow-right-alt'></i></button></p></a>";
							?>
						</div>
					</div>
					<div class="col-md-5">
						<nav id="breadcrumbs" class="dark" style="float: right; margin-bottom: 15px">
							<ul>
								<li><a href="./">Главная</a></li>
								<li><a href="?page=all_books">Книги</a></li>
								<li><?=$r_book_info[book_name]?></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-xl-8 col-lg-8 content-right-offset">

			<!-- Автор туралы -->
			<div class="single-page-section">
				<h3 class="margin-bottom-25">Про автора:</h3>
				<p align="justify">
					<?=$r_book_info[book_about_author]?>
				</p>
			</div>

			<!-- Аннотация -->
			<div class="single-page-section">
				<h3 class="margin-bottom-25">Аннотация:</h3>
				<p align="justify">
					<?=$r_book_info[book_annotation]?>
				</p>
			</div>

		</div>

		<!-- Sidebar -->
		<div class="col-xl-4 col-lg-4">
			<div class="sidebar-container">
					
				<!-- Sidebar Widget -->
				<div class="sidebar-widget">
					<div class="job-overview">
						<div class="job-overview-headline">Темы книги</div>
						<div class="job-overview-inner" style="max-height: 350px; overflow: auto; padding: 20px 0px;">
							<?=build_tree($cats,0);?>
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
				</div>

			</div>
		</div>

		<div class="col-8">
			<div class="boxed-list margin-bottom-60">
				<div class="boxed-list-headline">
					<h3><i class="icon-material-outline-thumb-up"></i> Отзывы </h3>
				</div>
				<?php
					ListActualReviewsBook($_GET['book_id']);

					if(isset($_SESSION['id_user']) && $access == 1){

						$q_info_review = mysql_query("SELECT * FROM db_list_current_reviews WHERE username = '$_SESSION[username]' AND book_id = '$_GET[book_id]' ");
						$r_info_review = mysql_fetch_array($q_info_review);

						if($r_info_review['id_list_current_reviews']){

							echo"";
						}else{

						echo'
							<div class="centered-button margin-top-35">
								<a href="#small-dialog" class="popup-with-zoom-anim button button-sliding-icon"> Оставить отзыв <i class="icon-material-outline-arrow-right-alt"></i></a>
							</div>';
						}

					}else if(isset($_SESSION['id_user']) && $access == 0){

						echo"<br><p align='center'><button class='button button-sliding-icon ripple-effect' style='width: 170px;'> Купить <i class='icon-material-outline-arrow-right-alt'></i></button></p>";
					}else{

						echo"<br><p align='center'><button class='button button-sliding-icon ripple-effect' style='width: 170px;'> Купить <i class='icon-material-outline-arrow-right-alt'></i></button></p>";
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
			<li><a href="#tab"> Написать комментарий </a></li>
		</ul>

		<div class="popup-tabs-container">
			<div class="popup-tab-content" id="tab">
				<form action="" method="post" id="leave-company-review-form" required>
					<div class="welcome-text">
						<h3>Оценить книгу</h3>
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

					<textarea class="with-border" placeholder="Ваше мнение" name="text_reviews" id="message" cols="7" required></textarea>
				</form>

				<button class="button margin-top-35 full-width button-sliding-icon ripple-effect" name="give_feedback" type="submit" form="leave-company-review-form" value="ok"> Оставить отзыв <i class="icon-material-outline-arrow-right-alt"></i></button>
			</div>
		</div>

	</div>
</div>
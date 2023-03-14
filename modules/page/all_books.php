<?php
function list_courses_for_all_reviews($search){

	$countView = 3;

	if(isset($_GET['page_number'])){
	    $pageNum = (int)$_GET['page_number'];
	    $startIndex = ($pageNum-1)*$countView;
	}else{
			$pageNum = 1;
	    $startIndex = 0;
	}

	$sql = mysql_query("SELECT * FROM db_list_books l
													    WHERE l.book_name LIKE '%$search%'
											          AND l.status = 1
											           OR l.book_author_name LIKE '%$search%'
											          AND l.status = 1
										       ORDER BY book_id DESC
										          LIMIT $startIndex, $countView ");
	$r = mysql_fetch_array($sql);
	
	if($r['book_id'] != ''){
	
		do{
	    
			echo"
			<div class='freelancer'>
				<div class='freelancer-overview'>
					<div class='freelancer-overview-inner'>
						<div class='row'>
							<div class='col-md-5'>	
								<div class='freelancer-avatar'>
									<img src='images/logo_books/$r[book_photo]' alt=''>
								</div>
							</div>
							<div class='col-md-7'>
								<div class='freelancer-name'>
									<h4> \"$r[book_name]\" </h4>
									<span> $r[book_author_name] </span>
								</div>
				
								<div class='freelancer-rating'>
									<div class='star-rating' data-rating='5.0'></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class='freelancer-details'>
					<div class='freelancer-details-list'>
						<ul>
							<li>Год <strong> $r[book_year_publication] </strong></li>
							<li>Количество страниц <strong> $r[book_number_page] </strong></li>
						</ul>
					</div>
					<a href='?page=book_info&book_id=$r[book_id]' class='button button-sliding-icon ripple-effect'> Подробнее <i class='icon-material-outline-arrow-right-alt'></i></a>
				</div>
			</div>";

		}while($r = mysql_fetch_array($sql));
		
	}else if($search != '') echo "<div class='text-center' style='padding: 25px'><h2>К сожалению, по вашему запросу не найдено информации.</h2><br><a href='?page=all_books' class='button ripple-effect'> Назад </a></div>";
	else echo "<h2>Ничего не найдено</h2>";

}

// получение полного количества новостей

function pagination($search){

	$countView = 3;

	if(isset($_GET['page_number'])){
	    $pageNum = (int)$_GET['page_number'];
	    $startIndex = ($pageNum-1)*$countView;
	}else{
			$pageNum = 1;
	    $startIndex = 1;
	}

	$q = mysql_query("SELECT COUNT(*) as col FROM db_list_books l
													    						WHERE l.book_name LIKE '%$search%'
											        						  AND l.status = 1
											        						   OR l.book_author_name LIKE '%$search%'
											        						  AND l.status = 1");
	$r = mysql_fetch_array($q);
	$countAllNews = $r["col"];
	// номер последней страницы
	$lastPage = ceil($countAllNews/$countView);

	if($pageNum > 1) {
		$linkPage = $pageNum-1;
		echo "
		<li class='pagination-arrow'>
			<a href='?page=all_books&search=$_GET[search]&page_number=$linkPage'>
				<i class='icon-material-outline-keyboard-arrow-left'></i>
			</a>
		</li>";
  }
  for($i = 1; $i <= $lastPage; $i++){
  	echo"
  	<li>
  		<a href='?page=all_books&search=$_GET[search]&page_number=$i'"; if($i == $pageNum) echo "class='current-page'>$i</a>"; else echo">$i</a>";
  	echo"
  	</li>";
  }
  if($pageNum < $lastPage){
  	$linkPage = $pageNum+1;
  	echo "
		<li class='pagination-arrow'>
			<a href='?page=all_books&search=$_GET[search]&page_number=$linkPage'>
				<i class='icon-material-outline-keyboard-arrow-right'></i>
			</a>
		</li>";
  }      
    
}

?>
<div class="gray">
	<div id="titlebar" class="gradient">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<h2>Все книги</h2>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="./">Главная</a></li>
						<li>Книги</li>
					</ul>
				</nav>

			</div>
		</div>
	</div>
	</div>
	
	<div class="container" style="min-height: 520px">
		<div class="row">

			<div class="col-12">
	
				<div class="row">
					<div class="col-md-6">
						<div class="input-with-icon">
							<input name="intro_keywords_search" type="text" placeholder="Напишите название книги или имя автора" autocomplete="off" onkeypress="return ClickSearch(event)" value="<?=$_GET['search']?>">
							<i class="icon-material-outline-search"></i>
						</div>
					</div>
				</div>

				<div class="default-slick-carousel freelancers-container freelancers-grid-layout">
					<?=list_courses_for_all_reviews($_GET['search'])?>
				</div>

				<!-- Pagination -->
				<div class="clearfix"></div>
				<div class="row">
					<div class="col-md-12">
						<div class="pagination-container margin-top-30 margin-bottom-60">
							<nav class="pagination">
								<ul>
									<?=pagination($_GET['search']);?>
								</ul>
							</nav>
						</div>
					</div>
				</div>
				<!-- Pagination / End -->
	
			</div>
		</div>
	</div>
</div>

<script>
	function ClickSearch(e){

	  if (e.keyCode == 13) {
	  	var search = $('input[name="intro_keywords_search"]').val();

	  	if(search != '') window.location.href = '?page=all_books&search='+search;
	  }

	}
</script>
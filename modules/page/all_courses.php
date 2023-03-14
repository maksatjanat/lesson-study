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

	$sql = mysql_query("SELECT * FROM db_list_courses l
													    WHERE l.course_name LIKE '%$search%'
											          AND l.status = 1
											           OR l.course_author_name LIKE '%$search%'
											          AND l.status = 1
										       ORDER BY course_id DESC
										          LIMIT $startIndex, $countView ");
	$r = mysql_fetch_array($sql);
	
	if($r['course_id'] != ''){
	
		do{
	    
		echo"
			<a href='?page=course_info&course_id=$r[course_id]' class='job-listing with-apply-button'>
				<div class='job-listing-details'>
	
					<div class='job-listing-company-logo'>
						<img src='images/logo_courses/$r[course_photo]'>
					</div>
	
					<div class='job-listing-description'>
						<h3 class='job-listing-title'> $r[course_name] </h3>
						<div class='job-listing-footer'>
							<ul>
								<li><i class='icon-line-awesome-user'></i> $r[course_author_name] </li>
								<li><i class='icon-material-outline-access-time'></i> $r[course_date_started] ж. </li>
							</ul>
						</div>
					</div>
	
					<span class='list-apply-button ripple-effect'>Подробнее</span>
				</div>
			</a>";
		}while($r = mysql_fetch_array($sql));
		
	}else if($search != '') echo "<div class='text-center' style='padding: 25px'><h2>К сожалению, по вашему запросу не найдено информации.</h2><br><a href='?page=all_courses&search=' class='button ripple-effect'> Назад </a></div>";
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

	$q = mysql_query("SELECT COUNT(*) as col FROM db_list_courses l
														              WHERE l.course_name LIKE '%$search%'
											          					  AND l.status = 1
											          					   OR l.course_author_name LIKE '%$search%'
											          					  AND l.status = 1");
	$r = mysql_fetch_array($q);
	$countAllNews = $r["col"];
	// номер последней страницы
	$lastPage = ceil($countAllNews/$countView);

	if($pageNum > 1) {
		$linkPage = $pageNum-1;
		echo "
		<li class='pagination-arrow'>
			<a href='?page=all_courses&search=$_GET[search]&page_number=$linkPage'>
				<i class='icon-material-outline-keyboard-arrow-left'></i>
			</a>
		</li>";
  }
  for($i = 1; $i <= $lastPage; $i++){
  	echo"
  	<li>
  		<a href='?page=all_courses&search=$_GET[search]&page_number=$i'"; if($i == $pageNum) echo "class='current-page'>$i</a>"; else echo">$i</a>";
  	echo"
  	</li>";
  }
  if($pageNum < $lastPage){
  	$linkPage = $pageNum+1;
  	echo "
		<li class='pagination-arrow'>
			<a href='?page=all_courses&search=$_GET[search]&page_number=$linkPage'>
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

				<h2>Все курсы</h2>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="./">Главная</a></li>
						<li>Курсы</li>
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
							<input name="intro_keywords_search" type="text" placeholder="Напишите название курса или имя автора" autocomplete="off" onkeypress="return ClickSearch(event)" value="<?=$_GET['search']?>">
							<i class="icon-material-outline-search"></i>
						</div>
					</div>
				</div>
	
				<div class="listings-container compact-list-layout margin-top-35">
					<?=list_courses_for_all_reviews($_GET['search'])?>		
				</div>

				<!-- Pagination -->
				<div class="clearfix"></div>
				<div class="row">
					<div class="col-md-12">
						<!-- Pagination -->
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

	  	if(search != '') window.location.href = '?page=all_courses&search='+search;
	  }

	}
</script>
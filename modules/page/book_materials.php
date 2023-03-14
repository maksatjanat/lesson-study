<?php
if(isset($_GET['book_id'])){

	$q_book_info = mysql_query("SELECT * FROM db_list_books
													  					   WHERE book_id = $_GET[book_id]");
	$r_book_info = mysql_fetch_array($q_book_info);

	$q_users_access_to_book = mysql_query("SELECT * FROM db_users_access_to_books
	 																								 WHERE id_user = $_SESSION[id_user]
	 																								   AND book_id = $_GET[book_id] ");
	$r_users_access_to_book = mysql_fetch_array($q_users_access_to_book);

	if($r_users_access_to_book['user_access_to_book_id'] != '') $access = 1; else $access = 0;
}

if(isset($_GET['material_id'])){

	$q_info_material_id = mysql_query("SELECT * FROM db_list_course_materials WHERE course_material_id = $_GET[material_id] ");
	$r_info_material_id = mysql_fetch_array($q_info_material_id);

}

$r_book_materials = mysql_query("SELECT * FROM db_list_book_materials WHERE book_id = '$_GET[book_id]' ");
if(mysql_num_rows($r_book_materials) > 0){
  $cats = array();
  while($cat = mysql_fetch_assoc($r_book_materials)){
    $cats_ID[$cat['book_material_id']][] = $cat;
    $cats[$cat['book_material_parent_id']][$cat['book_material_id']] = $cat;
  }
}

function build_tree($cats, $parent_id, $only_parent = false){
  if(is_array($cats) and isset($cats[$parent_id])){
    $tree = '	
    <div class="course-materials-nav">
			<nav id="navbar-example3" class="navbar navbar-light bg-light">';
    	if($only_parent == false){
    	  foreach($cats[$parent_id] as $cat){
    	  	if($cat['book_material_parent_id'] == 0) $item = $cat['book_material_id'];
    	  	else $item = "$cat[book_material_parent_id]-$cat[book_material_id]";
    	    $tree .= "<nav class='nav nav-pills flex-column'><a class='nav-link' href='#item-$item'>".$cat['book_material_theme']."</a>";
    	    $tree .=  build_tree($cats,$cat['book_material_id']);
    	    $tree .= "</nav>";
    	  }
    	}elseif(is_numeric($only_parent)){
    	  if($cat['book_material_parent_id'] == 0) $item = $cat['book_material_id'];
    	  else $item = "$cat[book_material_parent_id]-$cat[book_material_id]";
    	  $cat = $cats[$parent_id][$only_parent];
    	  $tree .= "<nav class='nav nav-pills flex-column'><a class='nav-link' href='#item-$item'>".$cat['book_material_theme']."</a>";
    	  $tree .=  build_tree($cats,$cat['book_material_id']);
    	  $tree .= "</nav>";
    	}
    	$tree .= '
    	</nav>
    </div>';
  }
  else return null;
  return $tree;
}

if($access == 1){
?>

<div class="full-page-container">

	<div class="full-page-sidebar">
		<div class="full-page-sidebar-inner" data-simplebar>
			<div class="sidebar-container">
				<h3><?=$r_book_info['book_name']?></h3>
				<hr>
				<?=build_tree($cats,0);?>
			</div>
		</div>
	</div>

	<div class="full-page-content-container" data-simplebar>
		<div class="full-page-content-inner">

			<div class="dashboard-headline">
				<h3><?=$r_info_material_id['course_material_theme'];?></h3>

				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="./">Главная</a></li>
						<li><a href="?page=all_books">Книги</a></li>
						<li><a href="?page=book_info&book_id=<?=$_GET['book_id']?>"><?=$r_book_info['book_name']?></a></li>
					</ul>
				</nav>
			</div>

			<div class="margin-top-60"></div>

			<div class="row">

				<div class="col-md-12">
					<div id="book_text">
						<?php

						$q_book_text = mysql_query("SELECT * FROM db_list_book_materials WHERE book_id = '$_GET[book_id]' ");

						while($r_book_text = mysql_fetch_array($q_book_text)){

							if($r_book_text['book_material_parent_id'] == 0) echo"<h2 id='item-$r_book_text[book_material_id]'> <b>$r_book_text[book_material_theme]</b> </h2>";
							else echo"<h3 id='item-$r_book_text[book_material_parent_id]-$r_book_text[book_material_id]'> <b>$r_book_text[book_material_theme]</b> </h2>";

							echo"
							<br>
							$r_book_text[book_material]
							<br>";
						}

						?>
					</div>
				</div>

			</div>

		</div>
	</div>

</div>

<?php
}else header('Location:./');?>

<script>
	const windowInnerHeight = window.innerHeight;
	height = windowInnerHeight - 200;
	//alert(height);
	document.getElementById("book_text").style.cssText = "overflow: auto; padding-right: 15px; height: "+height+"px;";
</script>

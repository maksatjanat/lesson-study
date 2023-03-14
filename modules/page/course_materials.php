<?php
if(isset($_GET['course_id'])){

	$q_course_info = mysql_query("SELECT * FROM db_list_courses
													  					   WHERE course_id = $_GET[course_id]");
	$r_course_info = mysql_fetch_array($q_course_info);

	$q_users_access_to_course = mysql_query("SELECT * FROM db_users_access_to_courses
	 																								 WHERE id_user = $_SESSION[id_user]
	 																								   AND course_id = $_GET[course_id] ");
	$r_users_access_to_course = mysql_fetch_array($q_users_access_to_course);

	if($r_users_access_to_course['user_access_to_course_id'] != '') $access = 1; else $access = 0;

	$q_first_material_id = mysql_query("SELECT MIN(course_material_id) as first_material_id FROM db_list_course_materials WHERE course_id = 1 ");
	$r_first_material_id = mysql_fetch_array($q_first_material_id);
}

if(isset($_GET['material_id'])){

	$q_info_material_id = mysql_query("SELECT * FROM db_list_course_materials WHERE course_material_id = $_GET[material_id] ");
	$r_info_material_id = mysql_fetch_array($q_info_material_id);

}

if($access == 1){
?>

<div class="full-page-container">

	<div class="full-page-sidebar">
		<div class="full-page-sidebar-inner" data-simplebar>
			<div class="sidebar-container">
				<h3><?=$r_course_info['course_name']?></h3>
				<hr>

				<div class="course-materials-nav">
					<table width="100%">

					<?=ListCourseMaterialsLink($_GET['course_id'])?>
					</table>
				</div>

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
						<li><a href="?page=course_info&course_id=<?=$_GET['course_id']?>"><?=$r_course_info['course_name']?></a></li>
					</ul>
				</nav>
			</div>

			<div class="margin-top-80"></div>

			<div class="row">

				<div class="col-md-12 text-center">
					<iframe width="70%" height="500" src="<?=$r_info_material_id['course_material'];?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				</div>

			</div>

		</div>
	</div>
</div>

<?php
}else header('Location:./');?>

<script type="text/javascript">
function DoNav(url)
{
   document.location.href = url;
}
</script>

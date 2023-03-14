<div id="content">
<?php
	if($_GET['page'] != ''){
		$page = "page/".$_GET['page'].".php";
		if(!include_once($page)) header('Location:./?page=error');
	}
	else include_once("page/welcome.php");
?>
</div>
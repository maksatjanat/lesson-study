<?php
	session_start();
	include_once("admin/config/db.php");
	include_once("scripts/functions.php");
?>
<!doctype html>
<html>
<head>
	<?php include_once("modules/head.php"); ?>
</head>
<body>
	<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5M62Q9L"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	<div id="wrapper">
		<?php
			include_once("modules/header.php");
			include_once("modules/content.php");
			if(isset($_GET['page']) && $_GET['page'] == 'book_materials'){}
			else include_once("modules/footer.php");
		?>
	</div>
	
	<script src="js/jquery-3.3.1.min.js"></script>
    <script>
        $(document).ready(function(){
//get the width of the container for the video in this case "body" then divide by 560 then use that as a scaling factor
            $("iframe").width( 850 );
            $("iframe").height( 500 );
        });
    </script>
	<script src="js/jquery-migrate-3.0.0.min.js"></script>
	<script src="js/mmenu.min.js"></script>
	<script src="js/tippy.all.min.js"></script>
	<script src="js/simplebar.min.js"></script>
	<script src="js/bootstrap-slider.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/snackbar.js"></script>
	<script src="js/clipboard.min.js"></script>
	<script src="js/counterup.min.js"></script>
	<script src="js/magnific-popup.min.js"></script>
	<script src="js/slick.min.js"></script>
	<script src="js/custom.js"></script>
	<script type="application/javascript" src="admin/plugins/input-mask/jquery.inputmask.js"></script>
	<script type="application/javascript" src="admin/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
	<script type="application/javascript" src="admin/plugins/input-mask/jquery.inputmask.extensions.js"></script>

	<script>
	$('[data-mask]').inputmask()
	// Snackbar for copy to clipboard button
	$('.copy-url-button').click(function() { 
		Snackbar.show({
			text: 'Скопировано в буфер обмена!',
		}); 
	}); 
	</script>

</body>
</html>
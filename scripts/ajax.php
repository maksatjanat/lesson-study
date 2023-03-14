<?php
require("../admin/config/db.php");

if(isset($_GET['AttachmentDocID'])){

	$q = mysql_query("SELECT * FROM db_uploaded_documents WHERE document_id = $_GET[AttachmentDocID] ");
	$r = mysql_fetch_array($q);

	echo"<iframe style='width: 100%; height: 100%;' align='center' src='documents/$r[document_url]#zoom=100'></iframe>";

}else if(isset($_GET['email_for_newsletter_subscription'])){

	if($_GET['error_type'] == 1){

		$q = mysql_query("SELECT * FROM db_list_newsletter_subscription WHERE email = '$_GET[email_for_newsletter_subscription]' ");
		$r = mysql_fetch_array($q);

		if($r['id'] != ''){

			echo "
			<div class='order-confirmation-page'>
				<div class='breathing-icon'><i class='icon-feather-thumbs-up'></i></div>
				<h2 class='margin-top-30'>Спасибо!</h2>
				<p>Вы ранее подписались на Email рассылку!</p>
			</div>";

		}else{

			$current_date = date("d.m.Y");
			$order_date = time();
			$insert_new_email = mysql_query("INSERT INTO db_list_newsletter_subscription (email, date_added, order_date) 
				                                                                    VALUES ('$_GET[email_for_newsletter_subscription]', '$current_date', '$order_date') ");
			echo"
			<div class='order-confirmation-page'>
				<div class='breathing-icon'><i class='icon-feather-check'></i></div>
				<h2 class='margin-top-30'>Спасибо!</h2>
				<p>Вы подписаны на Email рассылку!</p>
			</div>";
		}

	}else if($_GET['error_type'] == 0){

		echo "
		<div class='order-confirmation-page'>
			<div class='breathing-icon' style='background-color: #F39C12 !important; box-shadow: 0 0 0 15px rgba(243,156,18,0.07) !important;'><i class='icon-feather-alert-triangle'></i></div>
			<h2 class='margin-top-30'>Ошибка!</h2>
			<p>Адрес электронной почты введен неправильно, <b>$_GET[email_for_newsletter_subscription]</b>!</p>
		</div>";

	}

}
?>
<?php

if(isset($_POST['add_review'])){

	$array_document_id = UploadDocuments();
	$current_date = date("d.m.Y H:i:s");

	$insert_new_review = mysql_query("INSERT INTO db_form_reviews (author_fio, 
		                                                             author_phone, 
		                                                             company_information, 
		                                                             text_reviews, 
		                                                             documents_id, 
		                                                             I_agree, 
		                                                             legal_consultation, 
		                                                             arrival_date, 
		                                                             status) 
													 															 VALUES ('$_POST[author_fio]', 
													 															         '$_POST[author_phone]', 
													 															         '$_POST[company_information]', 
													 															         '$_POST[text_reviews]', 
													 															         '$array_document_id', 
													 															         '$_POST[I_agree]', 
													 															         '$_POST[legal_consultation]', 
													 															         '$current_date',
													 															         '1') ");

	if($insert_new_review == true) header("Location: ./?page=upload&insert=success");

}else if(isset($_POST['legal_aid'])){

	$current_date = date("d.m.Y H:i:s");

	$insert_new_legal_aid = mysql_query("INSERT INTO db_legal_consultation (author_fio, 
		                                                        			        author_phone, 
		                                                        			        company_information, 
		                                                        			        text_reviews, 
		                                                        			        arrival_date, 
		                                                        			        status) 
													 															    			VALUES ('$_POST[author_fio]', 
													 															    			        '$_POST[author_phone]', 
													 															    			        '$_POST[company_information]', 
													 															    			        '$_POST[text_reviews]', 
													 															    			        '$current_date',
													 															    			        '1') ");

	if($insert_new_legal_aid == true) header("Location: ./?page=upload&insert=success");

}else if(isset($_POST['for_companies'])){

	$current_date = date("d.m.Y H:i:s");

	$insert_new_for_companies = mysql_query("INSERT INTO db_form_for_companies (author_fio, 
		                                                        					        author_phone, 
		                                                        					        company_information, 
		                                                        					        text_reviews, 
		                                                        					        arrival_date, 
		                                                        					        status) 
													 															    					VALUES ('$_POST[author_fio]', 
													 															    					        '$_POST[author_phone]', 
													 															    					        '$_POST[company_information]', 
													 															    					        '$_POST[text_reviews]', 
													 															    					        '$current_date',
													 															    					        '1') ");

	if($insert_new_for_companies == true) header("Location: ./?page=upload&insert=success");

}else if(isset($_GET['insert']) && $_GET['insert'] = 'success'){
?>

<div id="titlebar" class="gradient"> </div>

<!-- Container -->
<div class="container">
	<div class="row">
		<div class="col-md-12">

			<div class="order-confirmation-page">
				<div class="breathing-icon"><i class="icon-feather-check"></i></div>
				<h2 class="margin-top-30">Спасибо!</h2>
				<p>Мы получили ваши данные и свяжемся с вами в ближайшие дни.</p>
				<a href="./" class="button ripple-effect-dark button-sliding-icon margin-top-30"> Главная <i class="icon-material-outline-arrow-right-alt"></i></a>
			</div>

		</div>
	</div>
</div>

<?php
}
?>
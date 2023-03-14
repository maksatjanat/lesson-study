<?php
function list_cities_for_select(){
	$q = mysql_query("SELECT * FROM db_cities ");

	while($r = mysql_fetch_array($q)){
		echo "<option value='$r[id_city]'> $r[city_name] </option>";
	}
}

function list_course_for_welcome(){
	$q = mysql_query("SELECT * FROM db_list_courses l
													  WHERE l.status = 1
												 ORDER BY l.course_date_started DESC LIMIT 4 ");
	$r = mysql_fetch_array($q);
	
	if($r['course_id'] != ''){
		
		echo"<div class='listings-container compact-list-layout margin-top-35'>";
		
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
							<li><i class='icon-material-outline-access-time'></i> $r[course_date_started] г. </li>
						</ul>
					</div>
				</div>

				<span class='list-apply-button ripple-effect'>Подробнее</span>
			</div>
		</a>";
		}while($r = mysql_fetch_array($q));
		
		echo"</div>";
		
	}else echo "Нет данных";
}

function ListAttachmentFiles($documents_id){

	if($documents_id != ''){
  
    $list_files = $documents_id;
    $list_files = explode(",", $list_files);
    $count_files = count($list_files);
  
    $n = 0;
  
    for($i = 0; $i < $count_files; $i++){
      $n++;
  
      $query_info_file  = mysql_query("SELECT * FROM db_uploaded_documents d
                                               WHERE d.document_id = '$list_files[$i]' ");
      $result_info_file = mysql_fetch_array($query_info_file);

      if($result_info_file['document_id'] != ''){
  
        $file_name = "file_".$n;
        $file_open = "number_".$n;
    
        $file  = $result_info_file['document_url'];
        $file_type = explode(".", $file);
        
        $cnt = count($file_type);
    
        if($file_type[$cnt-1] != 'docx' && $file_type[$cnt-1] != 'doc' && $file_type[$cnt-1] != 'xlsx' && $file_type[$cnt-1] != 'xls')
    			echo "<a href='#small-dialog' class='attachment-box ripple-effect popup-with-zoom-anim' onclick='javascript:AttachmentDocID($result_info_file[document_id]);'><span> $result_info_file[upload_document_name] </span><i>".$file_type[$cnt-1]."</i></a>";

    		else 
    			echo"<a href='documents/$result_info_file[document_url]' class='attachment-box ripple-effect' target='_blank'><span> $result_info_file[upload_document_name] </span><i>".$file_type[$cnt-1]."</i></a>";
      }
    }

  }else echo "<p align='center'>Нет файлов</p>";

}

function ListActualReviews($course_id){

	$q = mysql_query("SELECT * FROM db_list_current_reviews WHERE course_id = $course_id AND status = 1 ORDER BY order_date DESC ");
	$r = mysql_fetch_array($q);

	if($r['id_list_current_reviews'] != ''){

		echo"
		<ul class='boxed-list-ul'>";

		do{

			echo"
			<li>
				<div class='boxed-list-item'>
					<div class='item-content'>
						<h4>$r[author_fio]</h4>
						<div class='item-details margin-top-10'>
							<div class='star-rating' data-rating='$r[appraisal]'></div>
							<div class='detail-item'><i class='icon-material-outline-date-range'></i> $r[arrival_date]</div>
						</div>
						<div class='item-description'>
							<p>$r[text_reviews]</p>
						</div>
					</div>
				</div>
			</li>";

		}while($r = mysql_fetch_array($q));

		echo"
		</ul>";

	}else echo "<br><p><b>Не нашлось отзывов</b></p>";

}

function ListActualReviewsBook($book_id){

	$q = mysql_query("SELECT * FROM db_list_current_reviews WHERE book_id = $book_id AND status = 1 ORDER BY order_date DESC ");
	$r = mysql_fetch_array($q);

	if($r['id_list_current_reviews'] != ''){

		echo"
		<ul class='boxed-list-ul'>";

		do{

			echo"
			<li>
				<div class='boxed-list-item'>
					<div class='item-content'>
						<h4>$r[author_fio]</h4>
						<div class='item-details margin-top-10'>
							<div class='star-rating' data-rating='$r[appraisal]'></div>
							<div class='detail-item'><i class='icon-material-outline-date-range'></i> $r[arrival_date]</div>
						</div>
						<div class='item-description'>
							<p>$r[text_reviews]</p>
						</div>
					</div>
				</div>
			</li>";

		}while($r = mysql_fetch_array($q));

		echo"
		</ul>";

	}else echo "<br><p><b>Не нашлось отзывов</b></p>";

}

function UploadDocuments(){

  if(isset($_FILES['myfile']['name'][0]) && $_FILES['myfile']['name'][0] != '') $cnt = count($_FILES['myfile']['name']);
  else $cnt = 0;

  $date = date("Y-m-d H:i");
  $upload_month = date("Y-m");
  $upload_day = date("d");

  $array_document_id = '';

  // Загрузка документов
  
  $id_storage = $folder;
  $attached = $attached;

  if($cnt > 0) {
    for($i = 0; $i < $cnt; ++$i) {

      $file = $_FILES['myfile']['name'][$i];
      $fdata = pathinfo($file);
      
      $ext = $fdata['extension'];
      $filename = $fdata['filename'];

      $real_filename = $filename;
      
      $newname = time().'_'.$i.'.'.$ext;

      move_uploaded_file($_FILES['myfile']['tmp_name'][$i],'documents/'.$newname);

      mysql_query("INSERT INTO db_uploaded_documents  (document_url,
                                                       upload_document_name, 
                                                       document_type,
                                                       upload_date) 
                                               VALUES ('$newname',
                                                       '$real_filename',
                                                       '$ext',
                                                       '$date')");

      $doc_id = mysql_insert_id();

      if($i+1 < $cnt){
        $array_document_id .= $doc_id.",";
      }else{
        $array_document_id .= $doc_id;
      }

    } 
  }
  // Загрузка документов
  return $array_document_id;
}

function ListCourseMaterials($course_id){

	$q = mysql_query("SELECT * FROM db_list_course_materials WHERE course_id = $course_id ORDER BY course_material_id ");
	$r = mysql_fetch_array($q);

	do{

		echo "<li><span>$r[course_material_theme]</span></li>";

	}while($r = mysql_fetch_array($q));

}

function ListCourseMaterialsLink($course_id){

	$q = mysql_query("SELECT * FROM db_list_course_materials WHERE course_id = $course_id ORDER BY course_material_id ");
	$r = mysql_fetch_array($q);

	$i = 0;

	do{

		$i++;

		if($_GET['material_id'] == $r['course_material_id']){ $bg_tr_color = "#F7F8FE"; $color_text = "#2A41E8";}
		else { $bg_tr_color = "#fff"; $color_text = "#666666";}

		echo "
		<tr onclick=\"DoNav('?page=course_materials&course_id=$_GET[course_id]&material_id=$r[course_material_id]')\" style='background-color: $bg_tr_color; color: $color_text;'>
			<td width='30px'> <i class='icon-feather-play-circle'></i> </td>
			<td><b>$i - дәріс. $r[course_material_theme]</b></td>
		</tr>";

	}while($r = mysql_fetch_array($q));

}
?>
<?php
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

      move_uploaded_file($_FILES['myfile']['tmp_name'][$i],'../documents/'.$newname);

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
function UploadLogoCompany(){
  if(!empty($_FILES['img']['tmp_name'])){
    if(!empty($_FILES['img']['error'])){
      $_SESSION['msg'] = '<h4 class="info-text text-warning"><br><br><br><br>Не удалось загрузить файл<br>Попробуйте позднее.<br><br><br></h4>';
    }

    if($_FILES['img']['size']>2*1024*1024){
      $_SESSION['msg'] = '<h4 class="info-text text-warning"><br><br><br><br>Не удалось загрузить файл<br>Файл слишком большой.<br><br><br></h4>';
    }

    switch($_FILES['img']['type']){

      case 'image/jpeg':
      case 'image/pjpeg':
      $type = 'jpeg';
      break;

      case 'image/png':
      case 'image/x-png':
      $type='png';
      break;

      case 'image/gif':
      $type = 'gif';
      break;

      default:
      $_SESSION['msg'] = '<h4 class="info-text text-warning"><br><br><br><br>Не удалось загрузить файл<br>Неправильный тип изображения.<br><br><br></h4>';
      break;
    }

    $file = $_FILES['img']['name'];
    $fdata = pathinfo($file);
    
    $ext = $fdata['extension'];
    $filename = $fdata['filename'];
    
    $newname = time().".".$ext;

    if(!move_uploaded_file($_FILES['img']['tmp_name'],'../images/logo_companies/'.$newname)){
      $_SESSION['msg'] = '<h4 class="info-text text-warning"><br><br><br><br>Не удалось загрузить файл<br>Попробуйте позднее.<br><br><br></h4>';
    }
  }else{
    $newname = 'no_logo_company.png';
  }
  return $newname;
}
function Blacklist_companies($archive){
  $q = mysql_query("SELECT * 
                      FROM db_list_companies l, db_cities c, db_statuses s
                     WHERE l.archive = $archive
                       AND c.id_city = l.id_city
                       AND s.id_status = l.id_status
                  ORDER BY l.date_order DESC ");
  $r = mysql_fetch_array($q);

  if($r['id_company'] != ''){

    $n = 0;

    do{
      $status = '';
      $n++;

      if($r['id_status'] == 1) $status = "<font color='DC3139'> $r[status_name] </font>";
      else if($r['id_status'] == 2) $status = "<font color='2A41E8'> $r[status_name] </font>";
      else if($r['id_status'] == 3) $status = "<font color='EFA80F'> $r[status_name] </font>";

      $query = mysql_query("SELECT COUNT(*) as col 
                              FROM db_list_current_reviews
                             WHERE id_company = $r[id_company]
                               AND status = 1 ");
      $result = mysql_fetch_array($query);
    
      echo $result['COL'];

      echo"
      <tr>
        <td align='center'>$n</td>
        <td> <a href='?companies=$r[id_company]'>$r[company_name]</a> </td>
        <td> $r[city_name] </td>
        <td> $status </td>
        <td align='center'> $result[col] </td>
      </tr>";

    }while($r = mysql_fetch_array($q));

  }else echo"  
  <tr>
    <td colspan='5' align='center'> Нет данных </td>
  </tr>";
}
function Name_page(){
  if($_GET['forms'] != '') echo "Отзыв № ".$_GET['forms'];
  else if($_GET['legal_consultation'] != '') echo "Юридическая помощь № ".$_GET['legal_consultation'];
}
function content(){
  if($_GET['forms'] != ''){
    $query_info_reviews  = mysql_query("SELECT * FROM db_form_reviews WHERE id_reviews = '$_GET[forms]' ");
    $result_info_reviews = mysql_fetch_array($query_info_reviews);

    echo"
    <dl class='dl-horizontal'>
      <dt>№:</dt>
      <dd>$result_info_reviews[id_reviews]</dd>
      <dt>ФИО:</dt>
      <dd>$result_info_reviews[author_fio]</dd>
      <dt>Контактный номер:</dt>
      <dd>$result_info_reviews[author_phone]</dd>
      <dt>Название компании:</dt>
      <dd>$result_info_reviews[company_information]</dd>
      <dt>Я согласен на обработку и проверку информации:</dt>
      <dd>$result_info_reviews[I_agree]</dd>
      <dt>Мне требуется бесплатная юридическая консультация:</dt>
      <dd>$result_info_reviews[legal_consultation]</dd>
    </dl>
    <div class='col-md-12' style='margin: 15px 0 35px 0; padding: 20px; background-color: #F8F8F8; border: 1px solid #999;'> $result_info_reviews[text_reviews] </div>
    <div class='col-md-10'>";

    ListFiles($result_info_reviews['documents_id']);

    echo "
    </div>
    <div class='col-md-5'>
      <a class='btn btn-social-icon btn-danger' onclick='javascript:DeleteReviews($result_info_reviews[id_reviews]);'><i class='fa fa-trash'></i></a>
    </div>";

  }else if($_GET['legal_consultation'] != ''){

    $query_info_legal_consultation  = mysql_query("SELECT * FROM db_legal_consultation WHERE id_legal_consultation = '$_GET[legal_consultation]' ");
    $result_info_legal_consultation = mysql_fetch_array($query_info_legal_consultation);

    echo"
    <dl class='dl-horizontal'>
      <dt>№:</dt>
      <dd>$result_info_legal_consultation[id_legal_consultation]</dd>
      <dt>ФИО:</dt>
      <dd>$result_info_legal_consultation[author_fio]</dd>
      <dt>Контактный номер:</dt>
      <dd>$result_info_legal_consultation[author_phone]</dd>
      <dt>Название компании:</dt>
      <dd>$result_info_legal_consultation[company_information]</dd>
    </dl>
    <div class='col-md-12' style='margin: 15px 0 35px 0; padding: 20px; background-color: #F8F8F8; border: 1px solid #999;'> $result_info_legal_consultation[text_reviews] </div>";

    echo "<a class='btn btn-social-icon btn-danger' onclick='javascript:DeleteLegalConsultation($result_info_legal_consultation[id_legal_consultation]);'><i class='fa fa-trash'></i></a>";

  }else if($_GET['for_companies'] != ''){

    $query_info_for_companies  = mysql_query("SELECT * FROM db_form_for_companies WHERE id_form_for_companies = '$_GET[for_companies]' ");
    $result_info_for_companies = mysql_fetch_array($query_info_for_companies);

    echo"
    <dl class='dl-horizontal'>
      <dt>№:</dt>
      <dd>$result_info_for_companies[id_form_for_companies]</dd>
      <dt>ФИО:</dt>
      <dd>$result_info_for_companies[author_fio]</dd>
      <dt>Контактный номер:</dt>
      <dd>$result_info_for_companies[author_phone]</dd>
      <dt>Название компании:</dt>
      <dd>$result_info_for_companies[company_information]</dd>
    </dl>
    <div class='col-md-12' style='margin: 15px 0 35px 0; padding: 20px; background-color: #F8F8F8; border: 1px solid #999;'> $result_info_for_companies[text_reviews] </div>";

    echo "<a class='btn btn-social-icon btn-danger' onclick='javascript:DeleteForCompanies($result_info_for_companies[id_form_for_companies]);'><i class='fa fa-trash'></i></a>";

  }
}
function List_form_reviews(){
  $q = mysql_query("SELECT * 
                      FROM db_form_reviews
                     WHERE status != 0 ");
  $r = mysql_fetch_array($q);

  if($r['id_reviews'] != ''){

    $n = 0;

    do{
      $n++;

      echo"
      <tr>
        <td align='center'>$n</td>
        <td> <a href='?forms=$r[id_reviews]'>$r[author_fio]</a> </td>
        <td> $r[author_phone] </td>
        <td> $r[company_information] </td>
        <td> $r[text_reviews] </td>
        <td align='center'> $r[I_agree] </td>
        <td align='center'> $r[legal_consultation] </td>
        <td align='center'> 
          <a class='btn btn-social-icon btn-danger' onclick='javascript:DeleteReviews($r[id_reviews]);'><i class='fa fa-trash'></i></a> 
        </td>
      </tr>";

    }while($r = mysql_fetch_array($q));

  }else echo"  
  <tr>
    <td colspan='7' align='center'> Нет данных </td>
  </tr>";
}
function List_form_reviews_col(){
  $q = mysql_query("SELECT COUNT(*) as COL 
                      FROM db_form_reviews
                     WHERE status != 0 ");
  $r = mysql_fetch_array($q);

  echo $r['COL'];
}
function List_legal_consultation(){
  $q = mysql_query("SELECT * 
                      FROM db_legal_consultation
                     WHERE status != 0 ");
  $r = mysql_fetch_array($q);

  if($r['id_legal_consultation'] != ''){

    $n = 0;

    do{
      $n++;

      echo"
      <tr>
        <td align='center'>$n</td>
        <td> <a href='?forms&legal_consultation=$r[id_legal_consultation]'>$r[author_fio]</a> </td>
        <td> $r[author_phone] </td>
        <td> $r[company_information] </td>
        <td> $r[text_reviews] </td>
        <td align='center'> 
          <a class='btn btn-social-icon btn-danger' onclick='javascript:DeleteLegalConsultation($r[id_legal_consultation]);'><i class='fa fa-trash'></i></a> 
        </td>
      </tr>";

    }while($r = mysql_fetch_array($q));

  }else echo"  
  <tr>
    <td colspan='5' align='center'> Нет данных </td>
  </tr>";
}
function List_legal_consultation_col(){
  $q = mysql_query("SELECT COUNT(*) as COL 
                      FROM db_legal_consultation
                     WHERE status != 0 ");
  $r = mysql_fetch_array($q);

  echo $r['COL'];
}
function List_for_companies(){
  $q = mysql_query("SELECT * 
                      FROM db_form_for_companies
                     WHERE status != 0 ");
  $r = mysql_fetch_array($q);

  if($r['id_form_for_companies'] != ''){

    $n = 0;

    do{
      $n++;

      echo"
      <tr>
        <td align='center'>$n</td>
        <td> <a href='?forms&for_companies=$r[id_form_for_companies]'>$r[author_fio]</a> </td>
        <td> $r[author_phone] </td>
        <td> $r[company_information] </td>
        <td> $r[text_reviews] </td>
        <td align='center'> 
          <a class='btn btn-social-icon btn-danger' onclick='javascript:DeleteForCompanies($r[id_form_for_companies]);'><i class='fa fa-trash'></i></a> 
        </td>
      </tr>";

    }while($r = mysql_fetch_array($q));

  }else echo"  
  <tr>
    <td colspan='5' align='center'> Нет данных </td>
  </tr>";
}
function List_for_companies_col(){
  $q = mysql_query("SELECT COUNT(*) as COL 
                      FROM db_form_for_companies
                     WHERE status != 0 ");
  $r = mysql_fetch_array($q);

  echo $r['COL'];
}
function ListFiles($documents_id){

  if($documents_id != ''){

    echo"
    <div class='col-md-12' style='padding: 15px 0 0 0;'>
      <table class='table table-striped' style='top: 15px; border: 1px solid #0073B7'>
        <tr class='bg-blue'>
          <td colspan='4' align='center'> Вложенные документы </td>
        </tr>
        <tr>
          <th width='5%' style='text-align:center'>№</th>
          <th width='65%'>Название файла</th>
          <th width='30%'>Тип файла</th>
          <th width='30%' style='text-align:center'>Удалить</th>
        </tr>";
  
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
    
            if($file_type[$cnt-1] != 'docx' && $file_type[$cnt-1] != 'doc' && $file_type[$cnt-1] != 'xlsx' && $file_type[$cnt-1] != 'xls'){
    
              echo"
              <tr>
               <td style='text-align:center'>$n</td>
               <td style='text-align:left'><a data-toggle='modal' data-target='#$file_open' style='cursor: pointer'>$result_info_file[upload_document_name]</a></td>
               <td style='text-align:left'>$result_info_file[document_type]</td>
               <td style='text-align:center'> <a class='btn btn-block btn-xs btn-danger' style='background-color: #DD4B39; width: 60px; display: inline-block; margin: 0px 5px; color: white;' onclick='javascript:DeleteDocument($result_info_file[document_id]);'><i class='fa fa-trash'></i></a> </td>
              </tr>";
    
              echo "
              <div class='modal fade' id='$file_open'>
                <div class='modal-dialog' style='width: 95%; height: 95%;'>
                  <div class='modal-content' style='width: 100%; height: 100%;'>
                    <div class='modal-header'>
                      <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span></button>
                      <h4 class='modal-title'>$result_info_file[upload_document_name]</h4>
                    </div>
                    <div class='modal-body' style='height: 80%;'>
                      <iframe width='100%' height='100%' align='center' src='../documents/$result_info_file[document_url]#zoom=100'></iframe>
                    </div>
                    <div class='modal-footer'>
                      <button type='button' class='btn btn-danger pull-right' data-dismiss='modal'>Закрыт</button>
                    </div>
                  </div>
                </div>
              </div>";
    
            }else{
    
              echo"
              <tr>
                <td style='text-align:center'>$n</td>
                <td style='text-align:left'><a href='../documents/$result_info_file[document_url]' target='_blank'>$result_info_file[upload_document_name]</a></td>
                <td style='text-align:left'>$result_info_file[document_type]</td>
                <td style='text-align:center'> <a class='btn btn-block btn-xs btn-danger' style='background-color: #DD4B39; width: 60px; display: inline-block; margin: 0px 5px; color: white;' onclick='javascript:DeleteDocument($result_info_file[document_id]);'><i class='fa fa-trash'></i></a> </td>
              </tr>";
            }
          }
        }
  
    echo"
      </table>
    </div>";
  }else echo "<p align='center'>Нет файлов</p>";
}
function ListReviews(){
  $q = mysql_query("SELECT * FROM db_list_current_reviews r, db_list_companies c
                            WHERE r.status = 1
                              AND c.id_company = r.id_company 
                         ORDER BY order_date DESC ");
  $r = mysql_fetch_array($q);

  if($r['id_list_current_reviews'] != ''){

    echo"
    <table class='table table-bordered table-hover datatable'>
      <thead>
        <tr>
          <th width='7%' class='text-center'>№</th>
          <th width='25%'>Название компаний</th>
          <th width='15%'>Имя автора</th>                
          <th width='43%'>Текст отзыва</th>                
          <th width='10%'>Дата добавление</th>         
          <th width='5%'>Удалить</th>         
        </tr>
      </thead>
      <tbody>";

    $n = 0;

    do{

      $n++;
    
      echo"  
        <tr>
          <td align='center'> $n </td>
          <td> $r[company_name] </td>
          <td> $r[author_fio] </td>
          <td> <a data-toggle='modal' data-target='#EditReview' onclick='javascript:EditCurrentReview($r[id_list_current_reviews]);'> $r[text_reviews] </a> </td>
          <td> $r[arrival_date] </td>
          <td> <a class='btn btn-block btn-xs btn-danger' style='background-color: #DD4B39; width: 60px; display: inline-block; margin: 0px 5px; color: white;' onclick='javascript:DeleteCurrentReview($r[id_list_current_reviews]);'><i class='fa fa-trash'></i></a> </td>
        </tr>";

    }while($r = mysql_fetch_array($q));

    echo"
      </tbody>
    </table>";

  }else echo "Нет данных";
}
function ListNewsletter(){

  $q = mysql_query("SELECT * FROM db_list_newsletter_subscription ORDER BY order_date DESC ");
  $r = mysql_fetch_array($q);

  if($r['id'] != ''){

    echo"
    <table class='table table-bordered table-hover datatable'>
      <thead>
        <tr>
          <th width='10%' class='text-center'>№</th>
          <th width='45%'>Email</th>              
          <th width='25%'>Дата добавление</th>         
          <th width='20%'>Удалить</th>         
        </tr>
      </thead>
      <tbody>";

    $n = 0;

    do{

      $n++;
    
      echo"  
        <tr>
          <td align='center'> $n </td>
          <td> $r[email] </td>
          <td> $r[date_added] </td>
          <td> <a class='btn btn-block btn-xs btn-danger' style='background-color: #DD4B39; width: 60px; display: inline-block; margin: 0px 5px; color: white;' onclick='javascript:DeleteNewsletterId($r[id]);'><i class='fa fa-trash'></i></a> </td>
        </tr>";

    }while($r = mysql_fetch_array($q));

    echo"
      </tbody>
    </table>";

  }else echo "Нет данных";

}
?>
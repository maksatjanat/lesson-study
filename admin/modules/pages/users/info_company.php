<?php
$q_company_info = mysql_query("SELECT * FROM db_list_companies l, db_statuses s, db_cities c
													  					 WHERE id_company = $_GET[companies]
													  					   AND s.id_status = l.id_status
													  					   AND c.id_city = l.id_city");
$r_company_info = mysql_fetch_array($q_company_info);

if($r_company_info['archive'] == 0){ $box_color = "box-success"; $text = "Активный"; $button_left = "<button type='submit' class='btn btn-warning btn-flat' onclick='javascript:SendToArchive($r_company_info[id_company]);'>В архив</button>"; }
else if($r_company_info['archive'] == 1){ $box_color = "box-warning"; $text = "В архиве"; $button_left = "<button type='submit' class='btn btn-success btn-flat' onclick='javascript:SendToActive($r_company_info[id_company]);'>Активировать</button>"; }
else if($r_company_info['archive'] == 3){ $box_color = "box-danger"; $text = "Неактивный"; $button_left = "<button type='submit' class='btn btn-success btn-flat' onclick='javascript:SendToActive($r_company_info[id_company]);'>Активировать</button>"; }

if(isset($_POST['update_company_info'])){
  
  $array_document_id = UploadDocuments();
  $company_logo = UploadLogoCompany();

  if($array_document_id != '') $documents_id = $r_company_info['documents_id'].",".$array_document_id;
  else $documents_id = $r_company_info['documents_id'];

  $update_company_info = mysql_query("UPDATE db_list_companies SET company_name = '$_POST[company_name]', 
                                                                   company_bin = '$_POST[company_bin]',
                                                                   company_headperson = '$_POST[company_headperson]',
                                                                   company_website = '$_POST[company_website]',
                                                                   company_logo = '$company_logo',
                                                                   company_description = '$_POST[company_description]',
                                                                   id_city = '$_POST[id_city]',
                                                                   company_address = '$_POST[company_address]',
                                                                   company_email = '$_POST[company_email]',
                                                                   company_phones = '$_POST[company_phones]',
                                                                   documents_id = '$documents_id',
                                                                   id_status = '$_POST[id_status]' WHERE id_company = $_GET[companies] ");

  if($update_company_info == true) header("Location: ./?companies=$_GET[companies]");

}

?>
<div class="content-wrapper" style="margin-top: -20px;">
  <section class="content-header">
    <h1>
      Список компаний
      <small><?=$r_company_info['company_name']?></small>
    </h1>
  </section>
  <section class="content">
		<div class="row">

			<div class="col-md-8">
				<div class="box <?=$box_color?> box-solid">
					<div class="box-header with-border">
  		      <h3 class="box-title">О компаний > <?=$text;?></h3>
  		    </div>
					<div class="box-body box-profile">
						<div class="row">
							<br>
							<div class="col-md-3">
								<img class="profile-user-img img-responsive" src="../images/logo_companies/<?=$r_company_info['company_logo']?>">
							</div>
							<div class="col-md-9">
								<dl class="dl-horizontal">
  		      		  <dt>Название компаний:</dt>
  		      		  <dd><?=$r_company_info['company_name']?></dd>
  		      		  <dt>БИН:</dt>
  		      		  <dd><?=$r_company_info['company_bin']?></dd>
  		      		  <dt>ФИО руководителя:</dt>
  		      		  <dd><?=$r_company_info['company_headperson']?></dd>
  		      		  <dt>Статус:</dt>
  		      		  <dd><?=$r_company_info['status_name']?></dd>
  		      		</dl>
							</div>
						</div>
						<br>
						<div class="box-header with-border">
  		    	  <h3 class="box-title">Описание</h3>
  		    	</div>
						<div class="row">
							<br>
							<div class="col-md-1"></div>
							<div class="col-md-10">
								<div class='col-md-12' style='margin: 15px 0 35px 0; padding: 20px; background-color: #F8F8F8; border: 1px solid #999;'> <?=$r_company_info['company_description']?> </div>
							</div>
						</div>
						<br>
						<div class="box-header with-border">
  		    	  <h3 class="box-title">Подтверждающие документы</h3>
  		    	</div>
						<div class="row">
							<br>
							<div class="col-md-1"></div>
							<div class="col-md-10">
								<?=ListFiles($r_company_info['documents_id'])?>
							</div>
						</div>
					</div>
  		    <div class="box-footer">
  		      <?=$button_left;?>
  		      <button type="button" class="btn btn-primary pull-right btn-flat" data-toggle="modal" data-target="#modal-update">Изменить данные</button>
  		    </div>
  		  </div>
  		</div>
		
  		<div class="col-md-4">
  		  <div class="box box-info">
  		    <div class="box-header with-border">
  		      <h3 class="box-title">Контактная информация</h3>
  		    </div>
		
  		    <div class="box-body">
  		      <dl class="dl-horizontal">
  		        <dt>Город:</dt>
  		      	<dd><?=$r_company_info['city_name']?></dd>
  		      	<dt>Адрес:</dt>
  		      	<dd><?=$r_company_info['company_address']?></dd>
  		      	<dt>Адрес сайта:</dt>
  		      	<dd><?=$r_company_info['company_website']?></dd>
  		      	<dt>Email:</dt>
  		      	<dd><?=$r_company_info['company_email']?></dd>
  		      	<dt>Телефон:</dt>
  		      	<dd><?=$r_company_info['company_phones']?></dd>
  		      </dl>
  		    </div>
  		  </div>
  		</div>

		</div>

  </section>
</div>

<div class="modal fade" id="modal-update">
  <div class="modal-dialog" style="width: 90%">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Изменить данные компаний</h4>
      </div>
      <form method="post" action="?companies=<?=$_GET['companies']?>" enctype="multipart/form-data" required="" autocomplete='off'>
        <div class="modal-body">
          
          <div class="row">

            <div class="col-md-2">
              <div class="form-group">
                <label>Лого компаний</label><br>
                <div class="picture-container">
                  <div class="picture">
                    <img src="../images/logo_companies/<?=$r_company_info['company_logo']?>" class="picture-src" id="wizardPicturePreview" title=""/>
                    <input name="img" type="file" id="wizard-picture">
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-5">
              <label>О компаний</label><br>
              <div class="form-group">
                <input name="company_name" type="text" class="form-control" placeholder="Название компаний" autocomplete='off' value="<?=$r_company_info['company_name']?>">
              </div>
              <div class="form-group">
                <input name="company_bin" type="text" class="form-control" placeholder="БИН" autocomplete='off' value="<?=$r_company_info['company_bin']?>">
              </div>
              <div class="form-group">
                <input name="company_headperson" type="text" class="form-control" placeholder="ФИО руководителя" autocomplete='off' value="<?=$r_company_info['company_headperson']?>">
              </div>
              <div class="form-group">
                <label>Статус</label><br>
                <select name="id_status" class="form-control select_all" required="" style="width: 100%;">
                  <option value="">Выберите из списка</option>
                  <?php
                    $query_list_statuses = mysql_query("SELECT * FROM db_statuses ");
              
                    while($row_list_statuses = mysql_fetch_array($query_list_statuses)){
                      if($r_company_info['id_status'] == $row_list_statuses['id_status']) echo "<option value='$row_list_statuses[id_status]' selected>$row_list_statuses[status_name]</option>";
                      else echo "<option value='$row_list_statuses[id_status]'>$row_list_statuses[status_name]</option>";
                    }
                  ?>
                </select>
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group">
                <label>Город</label><br>
                <select name="id_city" class="form-control select_all" required="" style="width: 100%;">
                  <option value="">Выберите из списка</option>
                  <?php
                    $query_list_cities = mysql_query("SELECT * FROM db_cities ");
              
                    while($row_list_cities = mysql_fetch_array($query_list_cities)){
                      if($r_company_info['id_city'] == $row_list_cities['id_city']) echo "<option value='$row_list_cities[id_city]' selected>$row_list_cities[city_name]</option>";
                      else echo "<option value='$row_list_cities[id_city]'>$row_list_cities[city_name]</option>";
                    }
                  ?>
                </select>
              </div>

              <div class="form-group">
                <input name="company_address" type="text" class="form-control" id="exampleInputPassword1" placeholder="Адрес" autocomplete='off' value="<?=$r_company_info['company_address']?>">
              </div>

              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fas fa-globe"></i>
                  </div>
                  <input name="company_website" type="text" class="form-control" placeholder="Адрес сайта" autocomplete='off' value="<?=$r_company_info['company_website']?>">
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fas fa-envelope"></i>
                      </div>
                      <input name="company_email" type="email" class="form-control" placeholder="email" autocomplete="off" value="<?=$r_company_info['company_email']?>">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fas fa-mobile-alt"></i>
                      </div>
                      <input name="company_phones" type="text" class="form-control" data-inputmask="&quot;mask&quot;: &quot;9(999) 999-9999&quot;" data-mask="" placeholder="Телефон" autocomplete='off' value="<?=$r_company_info['company_phones']?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <hr>

          <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
              <label>Описание</label>
              <textarea id="editor" name="company_description" rows="10" cols="80" autocomplete='off'><?=$r_company_info['company_description']?></textarea>
            </div>
          </div>

          <hr>

          <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
              <label>Подтверждающие документы</label>
              <div class="file-loading">
                <input type="file" id="myfile" name="myfile[]" multiple="multiple">
              </div>
            </div>
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left btn-flat" data-dismiss="modal">Закрыть</button>
          <button name="update_company_info" type="submit" class="btn btn-success pull-right btn-flat"> Сохранить </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
function DeleteDocument(document_id){

  var result = confirm("Вы точно хотите удалить документ");
  if (result == true){
    $.ajax({
      type: 'get',
      dataType: "html",
      url: 'plugins/php/ajax_scripts.php',
      data: {document_id: document_id},
      success: function(result) {
        location.reload();
      },
    });
  }
}
function SendToArchive(id_company){

  var result = confirm("Вы точно хотите отправить компанию в Архив");
  if (result == true){
    $.ajax({
      type: 'get',
      dataType: "html",
      url: 'plugins/php/ajax_scripts.php',
      data: {id_companyToArchive: id_company},
      success: function(result) {
        window.location.href = '?companies';
      },
    });
  }
}
function SendToActive(id_company){

  var result = confirm("Вы точно хотите отправить компанию на сайт");
  if (result == true){
    $.ajax({
      type: 'get',
      dataType: "html",
      url: 'plugins/php/ajax_scripts.php',
      data: {id_companyToActive: id_company},
      success: function(result) {
        window.location.href = '?companies';
      },
    });
  }
}
</script>
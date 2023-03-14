<?php
if(isset($_POST['add_new_company'])){
  
  $array_document_id = UploadDocuments();
  $company_logo = UploadLogoCompany();

  $current_date = date("d.m.Y H:i:s");
  $order_date = time();

  $insert_new_company = mysql_query("INSERT INTO db_list_companies (company_name,
                                                                    company_bin,
                                                                    company_headperson,
                                                                    company_website,
                                                                    company_logo,
                                                                    company_description,
                                                                    id_city,
                                                                    company_address,
                                                                    company_email,
                                                                    company_phones,
                                                                    documents_id,
                                                                    id_status,
                                                                    date_added,
                                                                    date_order,
                                                                    archive)
                                                            VALUES ('$_POST[company_name]',
                                                                    '$_POST[company_bin]',
                                                                    '$_POST[company_headperson]',
                                                                    '$_POST[company_website]',
                                                                    '$company_logo',
                                                                    '$_POST[company_description]',
                                                                    '$_POST[id_city]',
                                                                    '$_POST[company_address]',
                                                                    '$_POST[company_email]',
                                                                    '$_POST[company_phones]',
                                                                    '$array_document_id',
                                                                    '$_POST[id_status]',
                                                                    '$current_date',
                                                                    '$order_date',
                                                                    '3') ");

  if($insert_new_company == true) header("Location: ./?companies");

}
?>
<div class="content-wrapper" style="margin-top: -20px;">
  <section class="content-header">
    <h1>
      Список компаний
    </h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs pull-right">
            <li><a href="#tab_3" data-toggle="tab"> Неактивный </a></li>
            <li><a href="#tab_2" data-toggle="tab"> Архив </a></li>
            <li class="active"><a href="#tab_1" data-toggle="tab"> На сайте </a></li>
            <li class="pull-left header"> 
              <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#add_company"> 
                <i class="fa fa-plus"></i> Добавить новую компанию 
              </button> 
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
              <table class="table table-bordered table-hover datatable">
                <thead>
                  <tr>
                    <th width="7%" class="text-center">№</th>
                    <th width="43%">Название компаний</th>
                    <th width="20%">Город</th>                
                    <th width="20%">Статус</th>                
                    <th width="10%" class="text-center">Количество отзывов</th>         
                  </tr>
                </thead>
                <tbody>
                  <?=Blacklist_companies(0);?>
                </tbody>
              </table>
            </div>

            <div class="tab-pane" id="tab_2">
              <table class="table table-bordered table-hover datatable">
                <thead>
                  <tr>
                    <th width="7%" class="text-center">№</th>
                    <th width="43%">Название компаний</th>
                    <th width="20%">Город</th>                
                    <th width="20%">Статус</th>                
                    <th width="10%" class="text-center">Количество отзывов</th>         
                  </tr>
                </thead>
                <tbody>
                  <?=Blacklist_companies(1);?>
                </tbody>
              </table>
            </div>

            <div class="tab-pane" id="tab_3">
              <table class="table table-bordered table-hover datatable">
                <thead>
                  <tr>
                    <th width="7%" class="text-center">№</th>
                    <th width="43%">Название компаний</th>
                    <th width="20%">Город</th>                
                    <th width="20%">Статус</th>                
                    <th width="10%" class="text-center">Количество отзывов</th>         
                  </tr>
                </thead>
                <tbody>
                  <?=Blacklist_companies(3);?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<div class="modal fade" id="add_company">
  <div class="modal-dialog" style="width: 90%">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Добавить новую компанию</h4>
      </div>
      <form method="post" action="?companies" enctype="multipart/form-data" required="" autocomplete='off'>
        <div class="modal-body">
          
          <div class="row">

            <div class="col-md-2">
              <div class="form-group">
                <label>Лого компаний</label><br>
                <div class="picture-container">
                  <div class="picture">
                    <img src="../images/logo_companies/no_logo_company.png" class="picture-src" id="wizardPicturePreview" title=""/>
                    <input name="img" type="file" id="wizard-picture">
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-5">
              <label>О компаний</label><br>
              <div class="form-group">
                <input name="company_name" type="text" class="form-control" placeholder="Название компаний" autocomplete='off'>
              </div>
              <div class="form-group">
                <input name="company_bin" type="text" class="form-control" placeholder="БИН" autocomplete='off'>
              </div>
              <div class="form-group">
                <input name="company_headperson" type="text" class="form-control" placeholder="ФИО руководителя" autocomplete='off'>
              </div>
              <div class="form-group">
                <label>Статус</label><br>
                <select name="id_status" class="form-control select_all" required="" style="width: 100%;">
                  <option value="">Выберите из списка</option>
                  <?php
                    $query_list_statuses = mysql_query("SELECT * FROM db_statuses ");
              
                    while($row_list_statuses = mysql_fetch_array($query_list_statuses)){
                      echo "<option value='$row_list_statuses[id_status]'>$row_list_statuses[status_name]</option>";
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
                      echo "<option value='$row_list_cities[id_city]'>$row_list_cities[city_name]</option>";
                    }
                  ?>
                </select>
              </div>

              <div class="form-group">
                <input name="company_address" type="text" class="form-control" id="exampleInputPassword1" placeholder="Адрес" autocomplete='off'>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fas fa-globe"></i>
                  </div>
                  <input name="company_website" type="text" class="form-control" placeholder="Адрес сайта" autocomplete='off'>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fas fa-envelope"></i>
                      </div>
                      <input name="company_email" type="email" class="form-control" placeholder="email" autocomplete="off">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fas fa-mobile-alt"></i>
                      </div>
                      <input name="company_phones" type="text" class="form-control" data-inputmask="&quot;mask&quot;: &quot;9(999) 999-9999&quot;" data-mask="" placeholder="Телефон" autocomplete='off'>
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
              <textarea id="editor" name="company_description" rows="10" cols="80" autocomplete='off'></textarea>
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
          <button name="add_new_company" type="submit" class="btn btn-success pull-right btn-flat"> Добавить </button>
        </div>
      </form>
    </div>
  </div>
</div>
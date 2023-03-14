<?php

function ListCourseMaterials(){

  $q = mysql_query("SELECT * FROM db_list_course_materials WHERE course_id = $_GET[course_info_id] ");
  if(mysql_num_rows($q) > 0){

    while($r = mysql_fetch_array($q)){
      echo"
      <div class='col-md-4'>
        <div class='box box-widget widget-user'>
          <div class='widget-user-header bg-black' style='width: 100%; height: 250px; padding: 0 !important;'>
            <iframe width='100%' height='250px' src='$r[course_material]' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>
          </div>
  
          <div class='box-footer' style='background-color: #ECF0F5'>
            <div class='row'>
              <div class='col-sm-12'>
                <h3 class='widget-user-username' style='padding-left: 20px !important;'> $r[course_material_theme] </h3>
                <hr>
              </div>
              <div class='col-sm-12'> 
                <br>
                <div class='col-md-4'> <button type='button' class='btn btn-block btn-warning btn-sm btn-flat' onclick=\"EditMaterial($r[course_material_id])\" data-toggle='modal' data-target='#EditCourseMaterial'> Редактировать </button> </div>
                <div class='col-md-4'></div>
                <div class='col-md-4'> <button type='button' class='btn btn-block btn-danger btn-sm btn-flat' onclick=\"DeleteMaterial($r[course_material_id])\"> Удалить </button> </div>
              </div>
            </div>
          </div>
        </div>
      </div>";
    }
  }
}

$q_course_info = mysql_query("SELECT * FROM db_list_courses WHERE course_id = $_GET[course_info_id] ");
$r_course_info = mysql_fetch_array($q_course_info);

if(isset($_POST['update_info_course'])){
    $target_dir = "../images/logo_courses/";
    $target_file = $target_dir . basename($_FILES["img"]["name"]);
    move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
    $imageName = $_FILES["img"]["name"];

  mysql_query("UPDATE db_list_courses SET course_name = '$_POST[course_name]', 
                                          course_price = '$_POST[course_price]', 
                                          course_photo = '$imageName', 
                                          course_author_name = '$_POST[course_author_name]', 
                                          course_about = '$_POST[course_about]', 
                                          course_introduction = '$_POST[course_introduction]', 
                                          course_for_who_is = '$_POST[course_for_who_is]', 
                                          course_what_will_you_learn = '$_POST[course_what_will_you_learn]', 
                                          course_author_info = '$_POST[course_author_info]', 
                                          course_date_started = '$_POST[course_date_started]'
                                    WHERE course_id = $_GET[course_info_id] ");

  header("Location:./?courses&course_info_id=$_GET[course_info_id]");
}else if(isset($_POST['add_new_course_material'])){

  mysql_query("INSERT INTO db_list_course_materials (course_id, course_material_theme, course_material) VALUES ('$_GET[course_info_id]', '$_POST[course_material_theme]', '$_POST[course_material]') ");

  header("Location:./?courses&course_info_id=$_GET[course_info_id]");
}else if(isset($_POST['edit_course_material'])){

  mysql_query("UPDATE db_list_course_materials SET course_material_theme = '$_POST[course_material_theme]', course_material = '$_POST[course_material]' WHERE course_material_id = $_POST[course_material_id] ");
  header("Location:./?courses&course_info_id=$_GET[course_info_id]");
}

?>
<div class="content-wrapper" style="margin-top: -20px;">

  <section class="content-header">
    <h1>
      Все курсы
    </h1>
  </section>

  <section class="content" style="margin-top: 20px;">
    <div class="row">

      <div class="col-md-12">

        <div class="box box-info" style="margin-top: -10px;">
        
          <div class='box-header with-border'>
            <h3 class='box-title'>Все курсы</h3>
            &nbsp&nbsp<i class='fas fa-angle-right'></i>
            &nbsp<small> <?=$r_course_info['course_name']?> </small>
          </div>
        
          <div class='box-body no-padding'>
            <div class='col-md-12 no-padding'>
              <div class='nav-tabs-custom'>
                <ul class='nav nav-tabs'>
                  <li class='active'><a href='#course_info' data-toggle='tab'> Про курс </a></li>
                  <li><a href='#course_materials' data-toggle='tab'> Материалы курса </a></li>
                </ul>
                <div class='tab-content'>
        
                  <!-- Курс туралы -->
                  <div class='tab-pane active' id='course_info' style='padding: 15px;'>
                    <div class="row">
                      <form action="?courses&course_info_id=<?=$_GET['course_info_id']?>" method="post" role="form" required="" enctype="multipart/form-data">

                        <div class="col-md-5">
                            <div class="form-group">
                                <div class="picture-container">
                                    <div class="picture">
                                        <img src="../images/logo_courses/<?=$r_course_info['course_photo'];?>" class="picture-src" id="wizardPicturePreview" title="" required>
                                        <input name="img" type="file" id="wizard-picture">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-7">
                          <div class="form-group">
                            <label>Название курса</label>
                            <input name="course_name" type="text" class="form-control" placeholder="Название курса" value="<?=$r_course_info['course_name'];?>" required>
                          </div>
                          <div class="form-group">
                            <label>Автор курса</label>
                            <input name="course_author_name" type="text" class="form-control" placeholder="Автор курса" value="<?=$r_course_info['course_author_name'];?>" required>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Цена курса</label>
                                <input name="course_price" type="number" class="form-control" placeholder="9990 тг." value="<?=$r_course_info['course_price'];?>" required>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Начало курса</label>
                
                                <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="far fa-calendar-alt"></i>
                                  </div>
                                  <input name="course_date_started" type="text" class="form-control pull-right datepicker" placeholder="дд.мм.гггг" value="<?=$r_course_info['course_date_started'];?>" autocomplete='off' required>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-md-6">
                          <label>Введение в курс</label>
                          <textarea id="editor1" name="course_introduction" rows="10" cols="80" autocomplete='off' required><?=$r_course_info['course_introduction'];?></textarea>
                          <br>
                          <label>Кому предназначен курс?</label>
                          <textarea id="editor2" name="course_for_who_is" rows="10" cols="80" autocomplete='off' required><?=$r_course_info['course_for_who_is'];?></textarea>
                        </div>
                          
                        <div class="col-md-6">
                          <label>Про что курс?</label>
                          <textarea id="editor3" name="course_about" rows="10" cols="80" autocomplete='off' required><?=$r_course_info['course_about'];?></textarea>
                          <br>
                          <label>Чему вы научитесь на этом курсе?</label>
                          <textarea id="editor4" name="course_what_will_you_learn" rows="10" cols="80" autocomplete='off' required><?=$r_course_info['course_what_will_you_learn'];?></textarea>
                        </div>

                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                          <br>
                          <label>Кто ведет курс?</label>
                          <textarea id="editor5" name=" course_author_info" rows="10" cols="80" autocomplete='off' required><?=$r_course_info['course_author_info'];?></textarea>
                        </div>
                      </div>
                      <hr>
                      <div class="row text-center">
                        <button name="update_info_course" type="submit" class="btn btn-success btn-flat" style="width: 50%">Отредактировать изменения</button>
                      </div>
                    </form>
                  </div>
                  <!-- ./Курс туралы -->
        
                  <!-- Курс материалдары -->
                  <div class='tab-pane' id='course_materials' style='padding: 15px;'>
                    <div class="row">
                      <?=ListCourseMaterials();?>
                      <div class="col-md-4">
                        <a class="btn btn-app" style="width: 100%; margin-top: 50%; top: -100px;" data-toggle="modal" data-target="#AddNewCourseMaterial">
                          <i class="fa fa-plus"></i> Добавить материал
                        </a>
                      </div>
                    </div>
                  </div>
                  <!-- ./Курс материалдары -->
        
                </div><!-- ./tab-content -->
              </div><!-- ./nav-tabs-custom -->
            </div><!-- ./col-md-12 no-padding -->
          </div><!-- ./box-body no-padding -->
        </div>

      </div>

    </div>
  </section>

</div>

<div class="modal fade" id="AddNewCourseMaterial">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Добавление нового материала в курс</h4>
      </div>
      <form method="post" action="?courses&course_info_id=<?=$_GET[course_info_id]?>" required="" autocomplete='off'>
        <div class="modal-body">
          <div class="form-group">
            <input name="course_material_theme" type="text" class="form-control" placeholder="Тема" autocomplete='off' required>
          </div>
          <div class="form-group">
            <input name="course_material" type="text" class="form-control" placeholder="Ссылка на видео" autocomplete='off' required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left btn-flat" data-dismiss="modal">Закрыть</button>
          <button name="add_new_course_material" type="submit" class="btn btn-success pull-right btn-flat"> Добавить </button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="EditCourseMaterial">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Изменить материал курса</h4>
      </div>
      <form method="post" action="?courses&course_info_id=<?=$_GET[course_info_id]?>" required="" autocomplete='off'>
        <div class="modal-body">
          <div id="EditCourseMaterialResult"></div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left btn-flat" data-dismiss="modal">Закрыть</button>
          <button name="edit_course_material" type="submit" class="btn btn-success pull-right btn-flat"> Сохранить </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
function EditMaterial(course_material_id){

  $.ajax({
    type: 'get',
    dataType: "html",
    url: 'plugins/php/ajax_scripts.php',
    data: {course_material_id: course_material_id, process: 1},
    success: function(result) {
      $('#EditCourseMaterialResult').html(result);
    },
  });
}
function DeleteMaterial(course_material_id){

  var result = confirm("Вы точно хотите удалить");
  if (result == true){

    $.ajax({
      type: 'get',
      dataType: "html",
      url: 'plugins/php/ajax_scripts.php',
      data: {course_material_id: course_material_id, process: 2},
      success: function(result) {
        window.location.href = '?courses&course_info_id='+<?=$_GET[course_info_id]?>;
      },
    });
  }
}
</script>
<?php
function ListCourses(){

  $q = mysql_query("SELECT * FROM db_list_courses ");
  
  if(mysql_num_rows($q) > 0){
    while($r = mysql_fetch_array($q)){

      $q_col_students = mysql_query("SELECT * FROM db_users_access_to_courses WHERE course_id = $r[course_id] ");
      $r_col_students = mysql_num_rows($q_col_students);

      $q_col_reviews = mysql_query("SELECT * FROM db_list_current_reviews WHERE course_id = $r[course_id] ");
      $r_col_reviews = mysql_num_rows($q_col_reviews);

      echo"
      <div class='col-md-4'>
        <div class='box box-widget widget-user'>
          <div class='widget-user-header bg-black' style='background: url(\"../images/logo_courses/$r[course_photo]\") top center; background-size: cover; height: 250px;'></div>
  
          <div class='box-footer'>
            <div class='row'>
              <div class='col-sm-12'> 
                <h3 class='widget-user-username' style='padding-left: 20px !important;'>$r[course_name]</h3>
                <h5 class='widget-user-desc' style='padding-left: 20px !important;'>$r[course_author_name]</h5>
                <hr>
              </div>
              <div class='col-sm-4 border-right'>
                <div class='description-block'>
                  <h5 class='description-header'>$r[course_price] тг.</h5>
                  <span class='description-text'>Курс бағасы</span>
                </div>
              </div>
              <div class='col-sm-4 border-right'>
                <div class='description-block'>
                  <h5 class='description-header'>$r_col_students</h5>
                  <span class='description-text'>Оқушылар</span>
                </div>
              </div>
              <div class='col-sm-4'>
                <div class='description-block'>
                  <h5 class='description-header'>$r_col_reviews</h5>
                  <span class='description-text'>Пікірлер</span>
                </div>
              </div>
              <div class='col-sm-12'> 
                <br>
                <a href='?courses&course_info_id=$r[course_id]'><button type='button' class='btn btn-block btn-info btn-sm btn-flat'> Подробнее </button></a>
              </div>
            </div>
          </div>
        </div>
      </div>";
    }
  }

}

if(isset($_POST['add_new_course'])){

  mysql_query("INSERT INTO db_list_courses (course_name,  course_author_name, status) VALUES ('$_POST[course_name]', '$_POST[course_author_name]', '1') ");
  header('Location:./?courses');
}

?>
<div class="content-wrapper" style="margin-top: -20px;">
  <section class="content-header">
    <h1>
        Все курсы
    </h1>
  </section>
  <section class="content">
    <div class="row">
      <?=ListCourses();?>
      <div class="col-md-12" style="margin-top: 20px">
        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6"><button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#AddNewCourse"> Добавить новый курс </button></div>
          <div class="col-md-3"></div>
        </div>
      </div>
    </div>
  </section>
</div>

<div class="modal fade" id="AddNewCourse">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Добавить новый курс</h4>
      </div>
      <form method="post" action="?courses" enctype="multipart/form-data" required="" autocomplete='off'>
        <div class="modal-body">
          <div class="form-group">
            <input name="course_name" type="text" class="form-control" placeholder="Название курса" autocomplete='off' required>
          </div>
          <div class="form-group">
            <input name="course_author_name" type="text" class="form-control" placeholder="Автор курса" autocomplete='off' required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left btn-flat" data-dismiss="modal">Закрыть</button>
          <button name="add_new_course" type="submit" class="btn btn-success pull-right btn-flat"> Добавить </button>
        </div>
      </form>
    </div>
  </div>
</div>
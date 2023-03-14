<?php


?>
<div class="content-wrapper" style="margin-top: -20px;">
  <section class="content-header">
    <h1>
      Все книги
    </h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12" style="margin-top: 20px">
        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6"><button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#AddNewCourse"> Добавить новую книгу </button></div>
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
        <h4 class="modal-title">Добавить новую книгу</h4>
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
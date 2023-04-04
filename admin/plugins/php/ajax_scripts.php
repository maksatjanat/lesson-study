<script type="application/javascript" src="../../bower_components/ckeditor/ckeditor.js"></script>
<?php
require("../../config/db.php");

if(isset($_GET['course_material_id']) && $_GET['process'] == 1 ){

  $q_info_material = mysql_query("SELECT * FROM db_list_course_materials WHERE course_material_id = $_GET[course_material_id] ");
  $r_info_material = mysql_fetch_array($q_info_material);

  echo"
  <input name='course_material_id' type='hidden' value='$_GET[course_material_id]'>
  <div class='form-group'>
    <label>Тема урока</label>
    <input name='course_material_theme' type='text' class='form-control' placeholder='Тема' autocomplete='off' value='$r_info_material[course_material_theme]' required>
  </div>
  <div class='form-group'>
    <label>Видео урока</label>
    <input name='course_material' type='text' class='form-control' placeholder='Видео' autocomplete='off' value='$r_info_material[course_material]' required>
  </div>
  <div class='form-group'>
    <label>Задание урока</label>
    <textarea id='exerciseCKEditor' name='exercise' rows='10' cols='80' placeholder='Задание' autocomplete='off' required>$r_info_material[exercise]</textarea>
  </div>";
}else if(isset($_GET['course_material_id']) && $_GET['process'] == 2){ echo"asdasdasd"; mysql_query("DELETE FROM db_list_course_materials WHERE course_material_id = $_GET[course_material_id]");}
else if(isset($_GET['id_newsletter'])) mysql_query("DELETE FROM `db_list_newsletter_subscription` WHERE id = $_GET[id_newsletter] ");
?>
<?php
session_start();

$generate_logins = $_SESSION['generate_logins'];
$limit           = $_SESSION['limit'];

$name_object     = $_SESSION['name_object'];
$date_testing    = $_SESSION['date_testing'];
$group           = $_SESSION['group'];
$kurs            = $_SESSION['kurs'];
$specialty       = $_SESSION['specialty'];
$testing_type_id = $_SESSION['testing_type_id'];

if($testing_type_id == 3){

  echo "<br><br>
        <table width='1000' border='1' align='center' style='border: 1px solid #000; font-size: 14px;' cellspacing='0' cellpadding='0'>
          <tr height='65' style='font-family: tahoma; font-size: 14px;' align='left'> 
            <td colspan='6' style='padding-left: 15px;'>
              <br> 
              Дата тестирование: $date_testing<br>
              Предмет тестирование: $name_object <br>
              Специальность: $specialty<br>
              Курс: $kurs<br>
              Группа: $group
              <br>
              <br>
            </td> 
          </tr>
          <tr height='35' style='background-color: #ccc; font-family: tahoma;' align='center'>
            <td width='5%'>№</td>
            <td > ФИО студента </td>
            <td width='10%'>Итоговая</td>
            <td width='12%'>Логин</td>
            <td width='10%'>Пароль</td>
            <td width='8%'> Подпись </td>
          </tr>";
  
  for($i = 1; $i < $limit; $i++){
  
    echo "<tr height='35' style='border: 1px solid #000'>
            <td align='center'> $i </td>
            <td> &nbsp&nbsp&nbsp".$generate_logins[$i]['fio_student']." </td>
            <td align='center'> ".$generate_logins[$i]['total']." </td>
            <td align='center'> ".$generate_logins[$i]['login']." </td>
            <td align='center'> ".$generate_logins[$i]['pass']." </td>
            <td>  </td>
          </tr>";
  }
  echo "</table>";

}else{

  echo "<br><br>
        <table width='1000' border='1' align='center' style='border: 1px solid #000; font-size: 14px;' cellspacing='0' cellpadding='0'>
          <tr height='65' style='font-family: tahoma; font-size: 14px;' align='left'> 
            <td colspan='5' style='padding-left: 15px;'>
              <br> 
              Дата тестирование: $date_testing<br>
              Предмет тестирование: $name_object <br>
              Специальность: $specialty<br>
              Курс: $kurs<br>
              Группа: $group
              <br>
              <br>
            </td> 
          </tr>
          <tr height='35' style='background-color: #ccc; font-family: tahoma;' align='center'>
            <td width='5%'>№</td>
            <td > ФИО студента </td>
            <td width='12%'>Логин</td>
            <td width='10%'>Пароль</td>
            <td width='8%'> Подпись </td>
          </tr>";
  
  for($i = 1; $i < $limit; $i++){
  
    echo "<tr height='35' style='border: 1px solid #000'>
            <td align='center'> $i </td>
            <td> &nbsp&nbsp&nbsp".$generate_logins[$i]['fio_student']." </td>
            <td align='center'> ".$generate_logins[$i]['login']." </td>
            <td align='center'> ".$generate_logins[$i]['pass']." </td>
            <td>  </td>
          </tr>";
  }
  echo "</table>";

}
?>
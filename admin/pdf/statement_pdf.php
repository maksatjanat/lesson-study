<?php
session_start();

require("../config/db.php");

if($_GET['testing_type'] != 4 && $_GET['testing_type'] != 5 ){

	$query_list_info_testing = mysql_query("SELECT * FROM db_specialties s, db_objects o, db_form_training f, db_testing_type t, db_faculty d, db_group g
																									WHERE f.id_form_training = '$_GET[statement]'
																									  AND s.id_specialties = '$_GET[specialty]'
																									  AND d.id_faculty = s.id_faculty
																									  AND o.id_objects = '$_GET[object]'
																									  AND g.id_group = '$_GET[group]'
																									  AND t.testing_type_id = '$_GET[testing_type]' ");
	$result_list_info_testing = mysql_fetch_array($query_list_info_testing);

	$query_list_students = mysql_query("SELECT s.fio_student FROM db_students s 
																						              WHERE s.id_specialties = '$_GET[specialty]'
																						                AND s.kurs = '$_GET[kurs]'
																						                AND s.id_group = '$_GET[group]'
																					             ORDER BY s.fio_student ");
	$result_list_students = mysql_fetch_array($query_list_students);

	$semestr = 2 * $_GET['kurs'];

	echo "
			<br>
			<p align='center'> <b> Шет тілдер және іскерлік карьера университеті <br> (Университет иностранных языков и деловой карьеры) </b> </p>
			<br><br>
			<table width='850' border='1' align='center' cellspacing='0' cellpadding='0'>
				<tr>
					<td colspan='10' style='padding: 10px;'>
						<p>Факультет: $result_list_info_testing[name_faculty].</p>
						<p>Предмет тестирование: $result_list_info_testing[name_object]</p>
						<p>Специальность: $result_list_info_testing[name].</p>
						<p>$_GET[kurs]-курс, $result_list_info_testing[name_group] ( $result_list_info_testing[name_form_training] )</p>
						<p>Ведомость за: $result_list_info_testing[testing_type_name].</p>
						<p>Семестр: $semestr</p>
					</td>
				</tr>
        <tr height='30' style='background-color: #ddd; font-family: tahoma; font-size: 14px;' align='center'>
          <td width='50' rowspan='2'>№</td>
          <td width='580' rowspan='2'> ФИО студента </td>
          <td width='220' colspan='3'> Результат </td>
        </tr>
        <tr height='30' style='background-color: #ddd; font-family: tahoma; font-size: 14px;' align='center'>
          <td width='100'> Оценка %  </td>
          <td width='120'> Дата тес. </td>
        </tr>";

 	$i = 0;
	do{
		$i++;

		$query_result_test = mysql_query("SELECT MAX(t.mark) as mark, MAX(t.start_date) as start_date FROM db_testing t
																						  WHERE t.fio_student LIKE '%$result_list_students[fio_student]%'
																						    AND t.id_objects = '$_GET[object]'
																						    AND t.testing_type_id = '$_GET[testing_type]' ");
		$result_rest       = mysql_fetch_array($query_result_test);

		if($result_rest['mark'] == '' && $result_rest['start_date'] == '' ){
			$mark = '0';
			$start_date = 'Не явка';
		}else{
			$mark = $result_rest['mark'];
			$start_date = $result_rest['start_date'];
		} 
	
		echo "<tr height='35'>
						<td align='center'> $i </td>
						<td>&nbsp $result_list_students[fio_student] </td>
						<td align='center' style='background-color: #ddd;'> $mark </td>
						<td align='center'> $start_date </td>
		   		</tr>";
	}while($result_list_students = mysql_fetch_array($query_list_students));
	
	echo "</table>
				<br><br>
				<table width='850' align='center'>
					<tr height='80'>
						<td>
							Тест қабылдауға жауапты тұлға <br>
							(Подпись ответственного за проведение тестирования) ______________________________________________________
						</td>
					</tr>
					<tr height='80'>
						<td>
							Қабылдау және тіркеу бөлімінің бастығы<br>
							(Начальник отдела приема и регистрации) _________________________________________________________________
						</td>
					</tr>
					<tr height='80'>
						<td>
							Оқу және оқу-әдістеме істері жөніндегі проректор <br>
							(Проректор по учебной и учебно-методической работе) ______________________________________________________
						</td>
					</tr>
				</table>";
}else if($_GET['testing_type'] == 4){

	$query_list_info_testing = mysql_query("SELECT * FROM db_specialties s, db_objects o, db_form_training f, db_faculty d, db_group g
																									WHERE f.id_form_training = '$_GET[statement]'
																									  AND s.id_specialties = '$_GET[specialty]'
																									  AND d.id_faculty = s.id_faculty
																									  AND o.id_objects = '$_GET[object]'
																									  AND g.id_group = '$_GET[group]' ");
	$result_list_info_testing = mysql_fetch_array($query_list_info_testing);

	$query_list_students = mysql_query("SELECT s.fio_student FROM db_students s 
																						              WHERE s.id_specialties = '$_GET[specialty]'
																						                AND s.kurs = '$_GET[kurs]'
																						                AND s.id_group = '$_GET[group]'
																					             ORDER BY s.fio_student ");
	$result_list_students = mysql_fetch_array($query_list_students);

	$semestr = 2 * $_GET['kurs'];

	echo "<br>
			<p align='center'> <b> Шет тілдер және іскерлік карьера университеті <br> (Университет иностранных языков и деловой карьеры) </b> </p>
			<br><br>
			<table width='1000' border='1' align='center' cellspacing='0' cellpadding='0'>
				<tr>
					<td colspan='10' style='padding: 10px;'>
						<p>Факультет: $result_list_info_testing[name_faculty].</p>
						<p>Предмет тестирование: $result_list_info_testing[name_object]</p>
						<p>Специальность: $result_list_info_testing[name].</p>
						<p>$_GET[kurs]-курс, $result_list_info_testing[name_group] ( $result_list_info_testing[name_form_training] )</p>
						<p>Ведомость за: РК1 и РК2.</p>
						<p>Семестр: $semestr</p>
					</td>
				</tr>
        <tr height='30' style='background-color: #ddd; font-family: tahoma; font-size: 14px;' align='center'>
          <td width='50' rowspan='3'>№</td>
          <td width='550' rowspan='3'> ФИО студента </td>
          <td width='500' colspan='6'> Результаты </td>
        </tr>
        <tr height='30' style='background-color: #ddd; font-family: tahoma; font-size: 14px;' align='center'>
          <td width='200' colspan='2'> РК 1 </td>
          <td width='200' colspan='2'> РК 2 </td>
          <td width='100' colspan='2'> Допуск к экзамену </td>
        </tr>
        <tr height='30' style='background-color: #ddd; font-family: tahoma; font-size: 14px;' align='center'>
          <td width='100'> Оценка %  </td>
          <td width='100'> Дата тес. </td>
          <td width='100'> Оценка %  </td>
          <td width='100'> Дата тес. </td>
          <td width='100'> Оценка % </td>
          <td width='100'> Допуск </td>
        </tr>";

 	$i = 0;
	do{
		$i++;

		$query_test_mark = mysql_query("SELECT * FROM db_testing t
																						  WHERE t.fio_student LIKE '%$result_list_students[fio_student]%'
																						    AND t.id_objects = '$_GET[object]' ");
		$result_test_mark       = mysql_fetch_array($query_test_mark);
		
		$total_mark = 0;
		$rk1_mark = 0;
		$rk2_mark = 0;
		$rk1_date = '';
		$rk2_date = '';

		do{
	
			if($result_test_mark['testing_type_id'] == 1 ){ 
				$rk1_mark_max = $result_test_mark['mark']; 
				$rk1_date_max = $result_test_mark['start_date'];

				if($rk1_mark_max > $rk1_mark) $rk1_mark = $rk1_mark_max;
				if($rk1_date_max > $rk1_date) $rk1_date = $rk1_date_max; 
			}
			else if($result_test_mark['testing_type_id'] == 2 ){ 
				$rk2_mark = $result_test_mark['mark']; 
				$rk2_date_max = $result_test_mark['start_date'];

				if($rk2_mark_max > $rk2_mark) $rk2_mark = $rk2_mark_max; 
				if($rk2_date_max > $rk2_date) $rk2_date = $rk2_date_max; 
			}
	
		}while($result_test_mark = mysql_fetch_array($query_test_mark));
	
		if($rk1_mark != '' && $rk2_mark != '' || $rk1_mark == '' && $rk2_mark != '' || $rk1_mark != '' && $rk2_mark == ''){ 
			$total_mark = ($rk1_mark * 0.3) + ($rk2_mark * 0.3);
			$total_mark = round($total_mark);
		}
		else $dopusk = "<font color='red'>Не допуск</font>";

		if($total_mark < 30) $dopusk = "<font color='red'>Не допуск</font>";
		else $dopusk = "<font color='green'>Допуск</font>";
	
		echo "<tr height='35' style='background-color: $tr_color;'>
						<td align='center'> $i </td>
						<td>&nbsp $result_list_students[fio_student] </td>
						<td align='center' style='background-color: #ddd;'> $rk1_mark </td>
						<td align='center'> $rk1_date </td>
						<td align='center' style='background-color: #ddd;'> $rk2_mark </td>
						<td align='center'> $rk2_date </td>
						<td align='center' style='background-color: #ddd;'> $total_mark </td>
						<td align='center'> $dopusk </td>
		   		</tr>";
	}while($result_list_students = mysql_fetch_array($query_list_students));
	
	echo "</table>
				<br><br>
				<table width='850' align='center'>
					<tr height='80'>
						<td>
							Тест қабылдауға жауапты тұлға <br>
							(Подпись ответственного за проведение тестирования) ______________________________________________________
						</td>
					</tr>
					<tr height='80'>
						<td>
							Қабылдау және тіркеу бөлімінің бастығы<br>
							(Начальник отдела приема и регистрации) _________________________________________________________________
						</td>
					</tr>
					<tr height='80'>
						<td>
							Оқу және оқу-әдістеме істері жөніндегі проректор <br>
							(Проректор по учебной и учебно-методической работе) ______________________________________________________
						</td>
					</tr>
				</table>";
}else if($_GET['testing_type'] == 5){

	$query_list_info_testing = mysql_query("SELECT * FROM db_specialties s, db_objects o, db_form_training f, db_faculty d, db_group g
																									WHERE f.id_form_training = '$_GET[statement]'
																									  AND s.id_specialties = '$_GET[specialty]'
																									  AND d.id_faculty = s.id_faculty
																									  AND o.id_objects = '$_GET[object]'
																									  AND g.id_group = '$_GET[group]' ");
	$result_list_info_testing = mysql_fetch_array($query_list_info_testing);

	$query_list_students = mysql_query("SELECT s.fio_student FROM db_students s 
																						              WHERE s.id_specialties = '$_GET[specialty]'
																						                AND s.kurs = '$_GET[kurs]'
																						                AND s.id_group = '$_GET[group]'
																					             ORDER BY s.fio_student ");
	$result_list_students = mysql_fetch_array($query_list_students);

	$semestr = 2 * $_GET['kurs'];

	echo "<br>
			<p align='center'> <b> Шет тілдер және іскерлік карьера университеті <br> (Университет иностранных языков и деловой карьеры) </b> </p>
			<br><br>
			<table width='1000' border='1' align='center' cellspacing='0' cellpadding='0'>
				<tr>
					<td colspan='10' style='padding: 10px;'>
						<p>Факультет: $result_list_info_testing[name_faculty].</p>
						<p>Предмет тестирование: $result_list_info_testing[name_object]</p>
						<p>Специальность: $result_list_info_testing[name].</p>
						<p>$_GET[kurs]-курс, $result_list_info_testing[name_group] ( $result_list_info_testing[name_form_training] )</p>
						<p>Ведомость: Итоговая.</p>
						<p>Семестр: $semestr</p>
					</td>
				</tr>
        <tr height='30' style='background-color: #ddd; font-family: tahoma; font-size: 14px;' align='center'>
          <td width='50' rowspan='3'>№</td>
          <td width='330' rowspan='3'> ФИО студента </td>
          <td width='585' colspan='8'> Результаты </td>
        </tr>
        <tr height='30' style='background-color: #ddd; font-family: tahoma; font-size: 14px;' align='center'>
          <td width='185' colspan='2'> РК 1 </td>
          <td width='185' colspan='2'> РК 2 </td>
          <td width='90' rowspan='2'> Допуск к экзамену </td>
          <td width='185' colspan='2'> Экзамен </td>
          <td width='65' rowspan='2'> Итоговая % </td>
        </tr>
        <tr height='30' style='background-color: #ddd; font-family: tahoma; font-size: 14px;' align='center'>
          <td width='85'> Оценка %  </td>
          <td width='100'> Дата тес. </td>
          <td width='85'> Оценка % </td>
          <td width='100'> Дата тес. </td>
          <td width='85'> Оценка % </td>
          <td width='100'> Дата тес. </td>
        </tr>";

 	$i = 0;
	do{
		$i++;

		$query_test_mark = mysql_query("SELECT * FROM db_testing t
																						  WHERE t.fio_student LIKE '%$result_list_students[fio_student]%'
																						    AND t.id_objects = '$_GET[object]' ");
		$result_test_mark       = mysql_fetch_array($query_test_mark);


		$total_mark = 0;
		$result = 0;
		$rk1_mark = 0;
		$rk2_mark = 0;
		$rk1_date = '';
		$rk2_date = '';
		$exam = 0;
		$exam_date = '';
		$bg_color = '';

		do{

			if($result_test_mark['testing_type_id'] == 1 ){ 
				$rk1_mark_max = $result_test_mark['mark']; 
				$rk1_date_max = $result_test_mark['start_date'];

				if($rk1_mark_max > $rk1_mark) $rk1_mark = $rk1_mark_max;
				if($rk1_date_max > $rk1_date) $rk1_date = $rk1_date_max; 
			}
			else if($result_test_mark['testing_type_id'] == 2 ){ 
				$rk2_mark = $result_test_mark['mark']; 
				$rk2_date_max = $result_test_mark['start_date'];

				if($rk2_mark_max > $rk2_mark) $rk2_mark = $rk2_mark_max; 
				if($rk2_date_max > $rk2_date) $rk2_date = $rk2_date_max; 
			}
			else if($result_test_mark['testing_type_id'] == 3 ){ 
				$exam_max = $result_test_mark['mark']; 
				$exam_date_max = $result_test_mark['start_date'];

				if($exam_max > $exam) $exam = $exam_max;
				if($exam_date_max > $exam_date) $exam_date = $exam_date_max;   
			}	
	
		}while($result_test_mark = mysql_fetch_array($query_test_mark));
	
		if($rk1_mark != '' && $rk2_mark != '' || $rk1_mark == '' && $rk2_mark != '' || $rk1_mark != '' && $rk2_mark == ''){ 
			$total_mark = ($rk1_mark * 0.3) + ($rk2_mark * 0.3);
			$total_mark = round($total_mark);
		}
		if($total_mark != '' && $exam != '') $result = $total_mark + round($exam * 0.4);

		if($result < 50 && $result > 0) $bg_color = "background-color: #ff5c5c;";
		else if($result == 0){$bg_color = "background-color: #001A35; color: white"; $result = "не допуск";}
	
		echo "<tr height='35'>
						<td align='center'> $i </td>
						<td>&nbsp $result_list_students[fio_student] </td>
						<td align='center' style='background-color: #ddd;'> $rk1_mark </td>
						<td align='center'> $rk1_date </td>
						<td align='center' style='background-color: #ddd;'> $rk2_mark </td>
						<td align='center'> $rk2_date </td>
						<td align='center'> $total_mark </td>
						<td align='center' style='background-color: #ddd;'> $exam </td>
						<td align='center'> $exam_date </td>
						<td align='center' style='$bg_color'> $result </td>
		   		</tr>";
	}while($result_list_students = mysql_fetch_array($query_list_students));
	
	echo "</table>
				<br><br>
				<table width='850' align='center'>
					<tr height='80'>
						<td>
							Тест қабылдауға жауапты тұлға <br>
							(Подпись ответственного за проведение тестирования) ______________________________________________________
						</td>
					</tr>
					<tr height='80'>
						<td>
							Қабылдау және тіркеу бөлімінің бастығы<br>
							(Начальник отдела приема и регистрации) _________________________________________________________________
						</td>
					</tr>
					<tr height='80'>
						<td>
							Оқу және оқу-әдістеме істері жөніндегі проректор <br>
							(Проректор по учебной и учебно-методической работе) ______________________________________________________
						</td>
					</tr>
				</table>";
}
?>
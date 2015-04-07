<?php

	include_once 'MainController.php';



	class CatalogController extends MainController {



		public function actionIndex() {
			$id = (int) $_GET['cat_id'];
			//Ищем все записи пренадлежащие данной категории
			$data = Catalog::model()->findAll('id_category=:id', array(':id' => $id));
			$this->render('index', array('data' => $data));
		}



		//Страница товара
		public function actionProduct_page() {
			$id = (int) $_GET['id'];
			$data = Catalog::model()->findByPk($id);
			$get_comment = Comment::model()->findAll('product_id=:id', array(':id' => $id));
			$this->render('product', array('tov' => $data, 'get_comment' => $get_comment));
		}



		//Метод для добавления комментариев
		public function actionAdd_comment() {
			if (!empty($_POST['product_id']) && !empty($_POST['name']) && !empty($_POST['comment']) && !empty($_POST['type'])) {
				//Сохраняем комментарий
				$comment = new Comment;
				$comment->product_id = (int) $_POST['product_id'];
				$comment->name = $_POST['name'];
				$comment->comment = $_POST['comment'];
				$comment->type = (int) $_POST['type'];
				if (!$comment->save()) { //Если данные не сохранены, то выводим описание ошибки
					print_r($comment->getErrors());
				}
				die(json_encode('Комментарий успешно добавлен и после проверки модератором будет опубликован.'));
			}
		}



		//Формируем календарь на 6 дней от текущей даты
		public function actionGet_date() {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$t = strtotime($_GET['date']);
				$date = date("Y-m-d", $t);
				$date44 = date("Y", $t);
				$date43 = date("m", $t);
				$date42 = date("d", $t);
			} else {
				$date = date("Y-m-d");
				$date44 = date("Y");
				$date43 = date("m");
				$date42 = date("d");
			}
			if ($date == '1970-01-01') {
				$date = date("Y-m-d");
				$date42 = date("d");
				$date44 = date("Y");
				$date43 = date("m");
			}
			$date45 = mktime(0, 0, 0, $date43, $date42, $date44);
			$temp0 = date("w", $date45);
			$temp1 = date("W", $date45);
			$begin_of_week = $temp1 * 7;

			$dow[1] = 'Пн';
			$dow[2] = 'Вт';
			$dow[3] = 'Ср';
			$dow[4] = 'Чт';
			$dow[5] = 'Пт';
			$dow[6] = 'Сб';
			$dow[7] = 'Вс';

			$eng_dow[1] = 'Monday';
			$eng_dow[2] = 'Tuesday';
			$eng_dow[3] = 'Wednesday';
			$eng_dow[4] = 'Thursday';
			$eng_dow[5] = 'Friday';
			$eng_dow[6] = 'Saturday';
			$eng_dow[7] = 'Sunday';
			if ($temp0 == 0) {
				$temp0 = 7;
			}
			$data = "<table style='height: 5%; width: 10%;'><tr>";


			for ($i = $temp0 + 1; $i <= 7; $i++) {

				$day_of_year = $begin_of_week + $i;
				$link_date_temp = strtotime($eng_dow[$i], $date45);
				$link_date = date('Y-m-d', $link_date_temp);
				$human_date = date('d.m.y', $link_date_temp);
				$date = Recording::model()->findAll('date=:date and product_id=:id', array(':date' => $link_date, ':id' => $_POST['id']));
				if (count($date) == 2) {
					$data .= "<td style='background:red; font-size:10px;' \";><center>";
				} elseif (count($date) == 1) {
					$data .= "<td style='background:green; cursor:pointer; font-size:10px;' onmouseover=\";style.backgroundColor='green'\"; onclick=\";location.href='/catalog/recorder?id=" . $_POST['id'] . "&date=" . $link_date . "&human_date=" . $human_date . "&time=" . $date[0]['time'] . "'\"; onmouseout=\"style.backgroundColor='green'\"; style=\"; cursor: pointer; \";><center>";
				} else {
					$data .= "<td style='background:lightgrey; cursor:pointer; font-size:10px;' onmouseover=\";style.backgroundColor='grey'\"; onclick=\";location.href='/catalog/recorder?id=" . $_POST['id'] . "&date=" . $link_date . "&human_date=" . $human_date . "'\"; onmouseout=\"style.backgroundColor='lightgrey'\"; style=\"; cursor: pointer; \";><center>";
				}
				$data .= $dow[$i] . "  " . $human_date . " </center></td> ";
			}


			for ($i = 1; $i < $temp0; $i++) {

				$day_of_year = $begin_of_week + $i;
				$link_date_temp = strtotime($eng_dow[$i], $date45);
				$link_date = date('Y-m-d', $link_date_temp);
				$human_date = date('d.m.y', $link_date_temp);
				$date = Recording::model()->findAll('date=:date and product_id=:id', array(':date' => $link_date, ':id' => $_POST['id']));
				if (count($date) == 2) {
					$data .= "<td style='background:red; font-size:10px;' \";><center>";
				} elseif (count($date) == 1) {
					$data .= "<td style='background:green; cursor:pointer; font-size:10px;' onmouseover=\";style.backgroundColor='green'\"; onclick=\";location.href='/catalog/recorder?id=" . $_POST['id'] . "&date=" . $link_date . "&human_date=" . $human_date . "&time=" . $date[0]['time'] . "'\"; onmouseout=\"style.backgroundColor='green'\"; style=\"; cursor: pointer; \";><center>";
				} else {
					$data .= "<td style='background:lightgrey; cursor:pointer; font-size:10px;' onmouseover=\";style.backgroundColor='grey'\"; onclick=\";location.href='/catalog/recorder?id=" . $_POST['id'] . "&date=" . $link_date . "&human_date=" . $human_date . "'\"; onmouseout=\"style.backgroundColor='lightgrey'\"; style=\"; cursor: pointer; \";><center>";
				}
				$data .= $dow[$i] . "  " . $human_date . " </center></td> ";
			}
			die($data);
		}



		public function actionRecorder() {
			$data = RecordingSettings::model()->findAll();
			$this->render('recorder', array('data' => $data));
		}



		public function actionSet_recording() {
			$recording = new Recording();
			$recording->product_id = (int)$_POST['product_id'];
			$recording->date = $_POST['date'];
			$recording->user_name = $_POST['name'];
			$recording->phone = $_POST['phone'];
			$recording->email = $_POST['email'];
			$recording->time = $_POST['time'].':00';
			$recording->comment = $_POST['comment'];
			if (!$recording->save()) { //Если данные не сохранены, то выводим описание ошибки
					print_r($recording->getErrors());
			}else{
				die(json_encode(array('msg'=>'Вы успешно записаны на примерку.')));
			}
		}

	}
	
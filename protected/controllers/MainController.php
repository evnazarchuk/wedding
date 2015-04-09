<?php



	/**
	 * Description of MainController
	 *
	 * @author Evgeniy Nazarchuk
	 */
	class MainController extends Controller {



		public function actionIndex() {
			!empty($_GET['id']) ? $_GET['id'] : $_GET['id'] = 1;
			$data = Page::model()->findByPk((int) $_GET['id']);
			$this->render('main', $data);
		}



		public function actionSearch() {
			empty($_GET['query']) ? exit('Запрос не должен быть пустым') : $query = $_GET['query'];
			$criteria = new CDbCriteria(array(
				'condition' => "name LIKE :match OR description LIKE :match", // DON'T do it this way!
				'params' => array(':match' => '%' . $query . '%')
			));
			$data = Catalog::model()->findAll($criteria);
			$this->render('search', array('data' => $data));
		}
		
		
		public function actionFeedback(){
			$user = $_POST['name'];
			$email = $_POST['email'];
			$phone = $_POST['phone'];
			$msg = $_POST['msg'];
			if(empty($user) || empty($email) || empty($phone)) return false;
			//Отправляем письмо администрации магазина
			$email = Yii::app()->email;
			$email->to = 'nazarchuk87@gmail.com';
			$email->subject = 'Заказ обратного звонка';
			$email->message = "Здравствуйте!<br>Поступил заказ обратного звонка с сайта.<br>Номер телефона клиента:<b>".$phone."<b><br>Сообщение:<br>".$msg;
			if($email->send()){
				die(json_encode('Спасибо что заказали обратный звонок, наш оператор свяжится с Вами в ближайшее время.'));
			}
		}



		//Верхнее меню для сайта
		public function get_items_top_menu() {
			$data_top_menu = Page::model()->findAll();
			$menu_items = array();
			foreach ($data_top_menu as $val) {
				$menu_tems[] = array('label' => $val->page_name, 'url' => Yii::app()->request->baseUrl . '/?id=' . $val->id);
			}
			return $menu_tems;
		}



		//Левое меню для сайта
		public function get_items_left_menu() {
			$data_left_menu = Category::model()->findAll();
			$menu_left_items = array();
			foreach ($data_left_menu as $val) {
				$menu_left_tems[] = array('label' => $val->name, 'url' => Yii::app()->request->baseUrl . '/catalog/?cat_id=' . $val->id);
			}
			return $menu_left_tems;
		}

	}
	
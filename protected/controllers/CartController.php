<?php

	include_once 'MainController.php';



	class CartController extends MainController {



		public function actionIndex() {
			$this->render('index');
		}



		//Добавление товара в корзину
		public function actionAdd2cart() {
			$id = (int) $_POST['id'];
			$name = $_POST['name'];
			$price = (float) $_POST['price'];

			if (isset($_SESSION['cart'][$id])) {//Если существует такой товар в корзине, то увиличеваем его количество
				$_SESSION['cart'][$id]['count'] ++;
			} else {//Иначе добавляем новый товар в корзину
				$_SESSION['cart'][$id] = array();
				$_SESSION['cart'][$id]['name'] = $name;
				$_SESSION['cart'][$id]['price'] = $price;
				$_SESSION['cart'][$id]['count'] = 1;
			}
			die(json_encode($this->_amount_and_quantity_in_basket()));
		}



		//Удаляем товар из корзины
		public function actionRemove_item2cart() {
			$id = (int) $_GET['id'];
			if (isset($_SESSION['cart'][$_GET['id']])) {
				unset($_SESSION['cart'][$_GET['id']]);
				$this->_amount_and_quantity_in_basket();
				die(json_encode('Товар удален из корзины'));
			}
		}



		//Отображаем форму заказа товара
		public function actionOrderform() {
			$this->render('orderform');
		}



		//Подсчитываем общую сумму в корзине и количество
		protected function _amount_and_quantity_in_basket() {
			$sum = 0;
			foreach ($_SESSION['cart'] as $key) {
				$sum += $key['price'] * $key['count'];
			}
			$_SESSION['sum_cart'] = $sum;
			$_SESSION['count_cart'] = count($_SESSION['cart']);

			return array('count' => count($_SESSION['cart']), 'sum' => $sum);
		}

	}
	
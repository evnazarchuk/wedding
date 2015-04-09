$(function () {

});


function del_cart(id) {//Удаление с корзины
	if (confirm('Удалить товар?'))
	{
		$.ajax({//ajax запрос
			type: 'GET', //Тип
			url: '/cart/remove_item2cart', //Куда отправляем запрос
			dataType: 'JSON', //Тип данных которые получаем
			data: {id: id}, //Данные которые отправляем
			success: function (data) {//ajax ответ
				alert(data);//выводим ajax ответ
				window.location.reload();//перегружаем текущую страницу
			}
		});
	}
	return false;

}
function add_cart() {//Добавление в корзину
	var price = $("#price").val();//Получаем цену
	var name = $("#name").val();//Получаем имя
	var id = $("#id").val();//Получаем id
	$.ajax({//ajax запрос
		type: 'POST', //Тип
		url: '/cart/add2cart', //Куда отправляем запрос
		dataType: 'JSON', //Тип данных которые получаем
		data: {id: id, name: name, price: price}, //Данные которые отправляем
		success: function (data) {//ajax ответ
			$('#cart_count').text(data.count);//Выводим количество товаров в корзине на странице
			$('#sum_cart').text(data.sum);//Выводим сумму товаров в корзине на странице
			$('#draw').show();//Отображаем корзину
		}
	});
	return false;
}
function feedback(){
	var name = $("#user_name").val();//Получаем имя
	var email = $("#user_email").val();//Получаем email
	var msg	= $('#msg').val();
	var phone	= $('#user_phone').val();
	if(name == "" || email == "" || phone == ""){
		alert("Поля имя,email и телефон не могут быть пустыми!");
		return false;
	}
	$.ajax({//ajax запрос
		type: 'POST', //Тип
		url: '/main/feedback/', //Куда отправляем запрос
		dataType: 'JSON', //Тип данных которые получаем
		data: {name: name, email: email, msg:msg, phone:phone}, //Данные которые отправляем
		success: function (data) {//ajax ответ
			alert(data);
			window.location.reload();
		}
	});
	return false;
}
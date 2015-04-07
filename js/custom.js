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
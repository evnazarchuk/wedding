<script>
function add_cart(i){//Добавление в корзину
	var price = $("#price_"+i).val();//Получаем цену
	var name = $("#name_"+i).val();//Получаем имя
	var id = $("#id_"+i).val();//Получаем id
	$.ajax({//ajax запрос
		type: 'POST',//Тип
		url: '/cart/add2cart',//Куда отправляем запрос
		dataType: 'JSON',//Тип данных которые получаем
		data:{id:id,name:name,price:price},//Данные которые отправляем
		success:function(data){//ajax ответ
			$('#cart_count').text(data.count);//Выводим количество товаров в корзине на странице
			$('#sum_cart').text(data.sum);//Выводим сумму товаров в корзине на странице
			$('#draw').show();//Отображаем корзину
		}
	});
	return false;
}
</script>
<div id="content">
	<div class="post">
		<div class="entry" style="height:503px;">
			<?php if(!empty($data)){ $i=1; $n=1; foreach($data as $key){ //Выводим товары ?>
				<div style = "margin-left:10px; padding-top:10px; width:130px; float:left;"><a href="/catalog/product_page?id=<?php echo $key->id.'&page='.$key->name;?>">
					<img style = "width:130px; height:150px;" src = '<?php echo $key->img;?>'></a><br>
					<center><span><a href="/catalog/product_page?id=<?php echo $key['id'].'&page='.$key['name'];?>"><?php echo $key['name'];?></a></span></center>
					<p><?php echo $key['price'];?>&nbsp;грн.&nbsp; 
					<input name = "add_to_cart" id="add_to_cart" style="width:60px; height:21px; background:#980F39; color:ffffff" type="submit" value="Купить" onclick="return add_cart('<?php echo $n;?>')"/>
					<form method="POST" action="#" name="form_<?php echo $n;?>">
						<input name="price" type="hidden" value="<?php echo $key->price;?>" id="price_<?php echo $n;?>">
						<input name="name" type="hidden" value="<?php echo $key->name;?>" id="name_<?php echo $n;?>">
						<input name="id" type="hidden" value="<?php echo $key->id;?>" id="id_<?php echo $n;?>">
					</form>
					</p>
				</div>
			<?php $i++;$n++; if($i>4){echo '<br><br><br><br><br><br><br><br><br><br>';$i=1;}} }else{?>
			<p>Категория пуста. 
			<?php } ?>
		</div></p>
	</div>
</div>
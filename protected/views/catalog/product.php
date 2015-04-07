<div id="content" align="justify">
	<div class="post">                        
		<div class="entry">
			<p><?php echo $tov['description']; //Отображаем описание  ?></p>
			<span><img style = "width:300px; height:400px; float:left;" src = '<?php echo $tov['img']; ?>'></span>
			<h2 align="center"><?php echo $tov['name']; //Отображаем имя  ?></h2>
			<h3 align="center"><var>Цена:&nbsp;<?php echo $tov['price']; //Отображаем цену  ?>&nbsp;грн.</var></h3>
			<div align="center">
				<form method="POST" action="#" name="form">
					<input name="price" type="hidden" value="<?php echo $tov['price']; ?>" id="price">
					<input name="name" type="hidden" value="<?php echo $tov['name']; ?>" id="name">
					<input name="id" type="hidden" value="<?php echo $tov['id']; ?>" id="id">
					<input name = "add_to_cart" id="add_to_cart" style="width:60px; height:21px; background:#980F39; color:ffffff" type="submit" value="Купить" onclick="return add_cart()"/><br><br>
					<input name = "recording" id="recording" style="width:150px; height:21px; background:#980F39; color:ffffff" type="submit" value="Запись на примерку" onclick="return get_date()"/>
				</form>
				<div id="call"></div>
			</div>
			<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
			<?php //include_once("blocks/comment.php"); ?>
			<form action="#" method="post" align = "center">
				<p><input style="width:150px; height:30px; margin-left:-150px;" type="text" name="user_name" placeholder = "Ваше имя" id='user_name'>
				<p><textarea style="width:300px; height:100px;" name="comment" placeholder = "Здесь Вы можете оставить отзыв о товаре" id='comment'></textarea>
					<input type="hidden" value='<?php echo $_GET['id']; ?>' id="product_id">
				<p><input style="width:auto; background:#980F39; color:ffffff" type="submit" value="Оставить отзыв" onclick="return add_comment();">
			</form> 
			<br><br><br><div align = "center">
				<?php
					if (!empty($get_comment)) {//Если не пустой массив, то выводим комментарий
						$i = 1;
						foreach ($get_comment as $key) {//Выводим комментарии
							if($key['type'] == 1){
							?>
							<div style="<?php echo $i % 2 ? 'background-color:#FA8597;' : 'background-color:#FF78C9;' ?>margin-top:20px;padding-top:10px;padding-bottom:10px;">
								<span style="color:#000000;"><?php echo $key['name'] . '&nbsp;' . $key['datetime']; ?></span><br>
								<span style="color:#980F39;"><?php echo $key['comment']; ?></span><br>
							</div>
			<?php
							}$i++;
		}
	}
?>
			</div>
			<script>
				
				function add_comment() {//Добавление комментария
					var product_id = $("#product_id").val();//Получаем product_id
					var name = $('#user_name').val();//Получаем имя
					var comment = $('#comment').val();//Получаем комментарий
					if (name == '') {
						$('#user_name').css({'border': '1px solid', 'color': 'red'});
						return false;
					}//Если пустое поле, name то подсвечиваем это поле крассным
					if (comment == '') {
						$('#comment').css({'border': '1px solid', 'color': 'red'});
						return false;
					}//Если пустое поле comment, то подсвечиваем поле красным
					$.ajax({//ajax запрос
						type: 'POST', //Тип
						url: '/catalog/add_comment', //Куда отправляем запрос
						dataType: 'JSON', //Тип данных которые получаем
						data: {product_id: product_id, name: name, comment: comment, type: 2}, //Данные которые отправляем
						success: function (data) {//ajax ответ
							alert(data);//выводим ajax ответ
							window.location.reload();//перегружаем текущую страницу
						}
					});
					return false;
				}
				function get_date(){
					if($('#call').text())
					{
						$('#call').empty();
					}
					else
					{
						$.ajax({
							type: 'POST',
							async: true,
							url: '/catalog/get_date',
							data: {id:'<?php echo $_GET['id'] ?>'},
							dataType: 'html',
							success: function(data){
								$('#call').append(data);
							}
						});
						return false;
					}
					return false;
				}
			</script>

		</div></p>
	</div>
</div>
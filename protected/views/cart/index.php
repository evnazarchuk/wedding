<div id="content" align="justify">
	<div class="post">
		<div class="entry">
			<?php if (!empty($_SESSION['cart'])) { ?>
					<table align="center" border="2" cellpadding="5" cellspacing="0" width="100%">
						<h1 align="center" style = "color:#980F39">Корзина покупок</h1>
						<thead>
							<tr style = "color:#980F39">
								<th>id</th>
								<th>Наименование товара</th>
								<th>Количество</th>
								<th>Цена, грн.</th>
								<th>Удалить</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1;
							$count = 0;
							foreach ($_SESSION['cart'] as $key => $val) { ?>
								<tr>
									<!--<td><?php echo $carts[$count]['id']; ?></td>-->
									<td align="center"><?php echo $i; ?></td>
									<td align="center"><?php echo $val['name']; ?></td>
									<td align="center"><?php echo $val['count']; ?></td>
									<td align="center"><?php echo $val['price']; ?></td>
									<td align="center"><a href="<?php echo $key; ?>" data_id="<?php echo $key; ?>" onclick="return del_cart($(this).attr('data_id'));"><img src="/img/remove.png" /></td>
								</tr>
			<?php $i++;
			$count++;
		} ?>


						</tbody>
					</table>


					<h3 align="center">Итого:  <span id='sum_cart'><?php echo!empty($_SESSION['sum_cart']) ? $_SESSION['sum_cart'] : 0; ?></span> грн.</h3>
					<a href = "/"><input style="width:auto; background:#980F39; color:ffffff" type="submit" value="Вернуться к покупкам"></a>
					<a href = "/cart/orderform"><input style="width:auto; background:#980F39; color:ffffff" type="submit" value="Оформить заказ"></a>
	<?php } else { ?>
					<p>Корзина пуста</p>
	<?php } ?>
		</div></p>
	</div>
</div>
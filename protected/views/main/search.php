<div id="page"><div class="inner_copy"><div class="inner_copy"></div></div>
<!-- start content -->
<div  align="justify">
	<div class="post">
		<p style = "color:#980F39; margin:auto;"><font face="Monotype Corsiva, Arial" size="6">Результаты поиска</font></p>    
		<div class="entry">
			<?php if(!empty($data)){ foreach($data as $key){ ?>
				<li><a href="/catalog/product_page?id=<?php echo $key['id'].'&page='.$key['name'];?>"><?php echo $key['name'];//Выводим название страниц ?></a></li>
			<?php }}else{echo "Поиск не дал результата.";} ?>
		</div>
	</div></p>
</div>
</div>

<div id="content" align="justify">
	<div class="post">
		<h2 class="title" align="center"><font face="Monotype Corsiva, Arial" size="6"><?php echo $data->page_name;?></font></h2>
		<div class="entry">
		<?php if($_GET['id'] !=5){ ?>
		<p>
			
			<?php if(!empty($data->img)){ //Если не пустое, то выводим картинку ?>
			<img src="<?php  echo Yii::app()->request->baseUrl.$data->img; ?>" style = "width:200; height:230;" class="left" />
			<?php }?>
			<p><?php echo $data->description;//Выводим описание страниц ?></p>
		</p>
		<?php }else{  $this->renderPartial('_services');} ?>
		</div>
		<p class="meta"></p>
	</div>
</div>

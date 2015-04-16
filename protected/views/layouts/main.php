<html>
<head>
<title><?php echo $_GET['page']?></title>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/osx.css" rel="stylesheet" type="text/css" media="screen" />
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.11.0.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/custom.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.simplemodal.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/osx.js"></script>
</head>
<body>
<div id="header">
	<div id="logo">
		<h1><a href="http://wedding.loc"><font face="Monotype Corsiva, Arial">Свадебный салон "Валерия"</font></a></h1>
		<html><br><br><br>
	<div style = "width:1120px; height:400px; color:#595252" align="right">
		<strong><img style = "width:50px; height:50px;" align="right" src="<?php echo Yii::app()->request->baseUrl; ?>/images/1.png">Товаров:</strong><span id='cart_count'><?php echo !empty($_SESSION['count_cart']) ? $_SESSION['count_cart'] : 0; ?></span> шт.
		<br/><strong>На сумму:</strong><span id='sum_cart'><?php echo !empty($_SESSION['sum_cart']) ? $_SESSION['sum_cart'] : 0; ?></span> грн.    
		<br/><a style = "color:#8500C3; <?php echo empty($_SESSION['cart']) ?  'display:none;' : ''?>" href='<?php echo Yii::app()->request->baseUrl; ?>/cart' id="draw">Оформить заказ</a>
	</div>
</html>	
	</div>
	<div id="menu">
		<?php $this->widget('zii.widgets.CMenu', array(
    'items'=>$this->get_items_top_menu(),
)); ?>
		<div id="search">
	<form name="search" method="get" action="/main/search">
		<fieldset>
			<input id="s" style="width:auto" type="search" name="query" required/>
			<input id="x" style="width:auto" type="submit" value="Поиск" />
		</fieldset>
	</form>
</div>
	</div>
</div><hr/>
<!-- start page -->
<div id="page"><div class="inner_copy"><div class="inner_copy"></div></div>

<?php echo $content; //Контент ?>
<div id="sidebar">
	<ul>
	<li>
		<font align="center" face="Monotype Corsiva, Arial" size="7"><h2>Каталог</h2></font>
		<ul>
		<?php $this->widget('zii.widgets.CMenu', array(
    'items'=>$this->get_items_left_menu(),
)); ?>
		</ul>
	</li>
</ul>
</div>
<!-- end sidebar -->
	<div style="clear:both"></div>
</div>
<!-- end page -->
<div id="footer">
	<div align = "center">&copy;2015&nbsp;<a href="http://forum.wedding.loc">Форум</a></div>
</div>
</body>
</html>	

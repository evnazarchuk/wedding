<div align="center">
	<input style="width:auto; height:auto; background:#980F39; color:ffffff" id="x" type="submit" value="Обратная связь"  class="osx"/>
</div><br />
<div align="center">
	<input style="width:auto; height:auto; background:#980F39; color:ffffff" id="x_1" type="submit" value="Коррекция и пошив платьев" onclick="correction_dresses(1);"/>
</div>
<div id="osx-modal-content">
	<div id="osx-modal-title">Написать нам</div>

	<div class="close"><a href="#" class="simplemodal-close" style="padding-bottom: 10px; ">x</a></div>
	<div id="osx-modal-data">
		<form method="POST" action="" >
			<input type="text" required placeholder="Имя" id="user_name" name="user_name" style="width: 200px;height: 20px">
			<input type="email" required placeholder="E-mail" id="user_email" name="user_email"  style="width: 200px;height: 20px;margin-top: 10px;">
			<input type="tel" required placeholder="Телефон" id="user_phone" name="user_phone"  style="width: 200px;height: 20px;margin-top: 10px;">
			
			<textarea placeholder="Сообщение" id="msg" name="msg" style="width: 255px;height: 70px;resize:none;margin-top: 10px;"></textarea><br>
			<br><span id="text_msg"></span>
			<input type="submit" style="background:#980F39; color:ffffff" value="Отправить" id="callback" onclick="feedback();return false;">
		</form>
		
	</div>
</div>
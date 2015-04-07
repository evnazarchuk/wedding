<div id="content" align="justify">
	<div class="post">
		<div class="entry">
			<div align = "center" style = "color:#980F39">
				<form method="post" id="formx" action="javascript:void(null);" onsubmit="call()">
					<h1 style = "color:#980F39">Записаться на примерку<br>Дата: <?php echo $_GET['human_date']; ?></h1>
					<h2>Оставьте заявку и мы обязательно перезвоним Вам.</h2>
					<p>Имя*:<br><input type="text" name="name" size="50" required>
					<p>Телефон*:<br><input type="text" name="phone" size="50" required>
						<p>Email:<br><input type="text" name="email" size="50">
						<p>Время:<br>
							<select name="time">
								<?php foreach($data as $key){ ?>
								<?php if(!empty($_GET['time']) && $key['time'] == $_GET['time']){ ?>
								<?php }else{ ?>
								<option><?php echo substr($key['time'],0,5); ?></option>
								<?php } ?>
								<?php } ?>
							</select>
						<p>Комментарий:<br><textarea name="comment"></textarea>
						<input type="hidden" name="product_id" value="<?php echo $_GET['id']; ?>">
						<input type="hidden" name="date" value="<?php echo $_GET['date']; ?>">
					<p><input style="width:auto; background:#980F39; color:ffffff" type="submit" value="Записаться">
				</form> 
			</div>
		</div></p>
	</div>
</div>
<script type="text/javascript" language="javascript">
    function call() {
      var msg   = $('#formx').serialize();
        $.ajax({
          type: 'POST',
          url: '/catalog/set_recording',
		  dataType: 'JSON',
          data: msg,
          success: function(data) {
            alert(data.msg);
			window.location.href = "/";
          },
          error:  function(xhr, str){
                alert('Возникла ошибка: ' + xhr.responseCode);
            }
        });
		return false;
 
    }
</script>
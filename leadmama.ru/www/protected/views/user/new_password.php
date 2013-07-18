<?php
$this->pageTitle = Yii::app()->name . ' - Новый пароль';
?>

<div class="page-block page-block-beige">
    <div class="width" id="page_login">

        <div class="ui-widget form" id="new_password_form">

            <div class="ui-widget-header">
                <h1>Новый пароль</h1>
            </div>

            <div class="ui-widget-content" id="new_password_block">

                <div class="row">
					<label>Новый пароль: </label>
					<input type="password" id="password1">
                </div>
				
				<div class="row">
					<label>Повторите пароль: </label>
					<input type="password" id="password2">
                </div>
  
				<button id="submit">Обновить пароль</button>
				
            </div>
				
        </div>

    </div>
</div>

<script>
$(function(){
	$('#submit').click(function(){
	
		var password1 = $('#password1').val();
		var password2 = $('#password2').val();
		
		if(password1.length == 0){
			alert('Пароль не может быть пустым');
			return false;
		}
		
		if(password1 != password2){
			alert('Пароли не совпадают');
			return false;
		}
		
		$.post('/restore/<?=$user->restore_code?>', {password: password1}, function(){
			alert('Пароль изменен');
			document.location.href = 'http://leadmama.ru/login';
		});
		
		return false;
	});
});
</script>
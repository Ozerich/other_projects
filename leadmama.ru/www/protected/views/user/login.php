<?php
$this->pageTitle = Yii::app()->name . ' - Вход на сайт';
?>

<div class="page-block page-block-beige">
    <div class="width" id="page_login">

        <div class="ui-widget form" id="login_form">

            <div class="ui-widget-header">
                <h1>Войти на сайт</h1>
            </div>

            <div class="ui-widget-content" id="login_block">

                <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'login-form',
                'enableAjaxValidation' => true,
                'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false),
            )); ?>

                <p class="note">Поля со знаком <span class="required">*</span> обязательны для заполнения.</p>

                <div class="row">
                    <?php echo $form->labelEx($model, 'email'); ?>
                    <?php echo $form->textField($model, 'email'); ?>
                    <?php echo $form->error($model, 'email'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model, 'password'); ?>
                    <?php echo $form->passwordField($model, 'password'); ?>
                    <?php echo $form->error($model, 'password'); ?>
                </div>
				
				<div class="row">
					<?=$form->labelEx($model, 'remember');?>
					<?=$form->checkbox($model, 'remember'); ?>
				</div>	
				
                <div class="row submit">
                    <?php echo CHtml::submitButton('Войти'); ?>
                    <button onclick="$('#login_block, #restore_block').toggle(); return false;">Забыли пароль</button>
                </div>

                <?php $this->endWidget(); ?>
				
            </div>
			
			
			
            <div class="ui-widget-content" id="restore_block" style="display: none">

                <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'restore-form',
				'action' => '/restore',
            )); ?>

                <p class="note">Поля со знаком <span class="required">*</span> обязательны для заполнения.</p>

                <div class="row">
                    <label for="restore_email">E-mail: <span class="required">*</span></label>
					<input type="text" id="restore_email"/>
                </div>
            
				
                <div class="row submit">
                    <button onclick="$('#login_block, #restore_block').toggle(); return false;">Войти</button>
                    <?php echo CHtml::submitButton('Восстановить', array('id' => 'restore_submit')); ?>
                </div>

                <?php $this->endWidget(); ?>
				
            </div>
			
			
        </div>

    </div>
</div>

<script>
$(function(){
	$('#restore_submit').click(function(){
	
		var email = $('#restore_email').val();
		if(email.length == 0){
			alert('Заполните поле E-mail');
			return false;
		}
		
		$.post('/restore/', {'email': email}); 
		
		alert('Пароль отправлен на почту');
		$('#restore_email').val('');
		$('#login_block, #restore_block').toggle();
		
		return false;
	});
});
</script>
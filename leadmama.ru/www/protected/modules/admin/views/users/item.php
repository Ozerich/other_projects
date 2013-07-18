<div id="page_user_item">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => '/admin/users/edit/'.($model ? 'id/'.$model->id : ''),
		'htmlOptions' => array('class' => 'admin-form'),
    ));
    ?>

    <div class="row">
        <div class="param">
            <?php echo $form->labelEx($model, 'email'); ?>
            <?php echo $form->textField($model, 'email'); ?>
            <?php echo $form->error($model, 'email'); ?>
        </div>
	</div>
	
	<div class="row">
        <div class="param">
            <?php echo $form->labelEx($model, 'login'); ?>
            <?php echo $form->textField($model, 'login'); ?>
            <?php echo $form->error($model, 'login'); ?>
</div>
    </div>
	
	<div class="row">
	       <div class="param">
		<?php echo $form->labelEx($model, 'type'); ?>
		<?php echo $form->dropDownList($model, 'type', User::$types); ?>
		<?php echo $form->error($model, 'fio'); ?>
		        </div>
</div><div class="row">	
	<div class="param">
		<?php echo $form->labelEx($model, 'fio'); ?>
		<?php echo $form->textField($model, 'fio'); ?>
		<?php echo $form->error($model, 'fio'); ?>
	</div>
	</div>
	
	<div class="row">     <div class="param">
		<?php echo $form->labelEx($model, 'birth_date'); ?>
		<?php echo $form->textField($model, 'birth_date', array('class' => 'datepicker')); ?>
		<?php echo $form->error($model, 'birth_date'); ?>
	</div> </div>

	
	<div class="row">
		<div class="param">
			<label>Новый пароль</label>
			<input type="text" name="new_password"/>
		</div>
	</div>
   
    <div class="row">
        <div class="submit">
            <?php echo CHtml::submitButton('Сохранить'); ?>
        </div>
    </div>

    <? $this->endWidget(); ?>
</div>
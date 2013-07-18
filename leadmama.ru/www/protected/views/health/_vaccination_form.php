<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'vaccination_form',
    'action' => '/medicine/'.(!$model->isNewRecord ? $model->id : ''),
    'htmlOptions' => array('class' => 'popup-form'),
    'enableAjaxValidation' => true,
    'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false),
)); ?>

<div class="row">
    <div class="param double">
        <?php echo $form->labelEx($model, 'date'); ?>
        <?php echo $form->textField($model, 'date', array('class' => 'datepicker', 'tabindex' => '-1')); ?>
        <?php echo $form->error($model, 'date'); ?>
    </div>
</div>

<div class="row">
    <div class="param double">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name'); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>
</div>

<div class="row">
    <div class="param double">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php echo $form->textarea($model, 'description'); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>
</div>

<div class="row submit-row">
    <?php echo CHtml::submitButton('Сохранить'); ?>
</div>

<? $this->endWidget(); ?>
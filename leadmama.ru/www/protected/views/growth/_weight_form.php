<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'weight_form',
    'action' => '/weight/',
    'htmlOptions' => array('class' => 'popup-form'),
    'enableAjaxValidation' => true,
    'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false),
)); ?>

<div class="row">
    <div class="param double">
        <?php echo $form->labelEx($model, 'month'); ?>
        <?php echo $form->dropDownList($model, 'month', BabyWeight::getTextMonths()); ?>
        <?php echo $form->error($model, 'month'); ?>
    </div>
</div>

<div class="row">
    <div class="param double">
        <?php echo $form->labelEx($model, 'value'); ?>
        <?php echo $form->textField($model, 'value', array('placeholder' => 'Например, 7.5')); ?>
        <?php echo $form->error($model, 'value'); ?>
    </div>
</div>

<div class="row submit-row">
    <?php echo CHtml::submitButton('Сохранить'); ?>
</div>

<? $this->endWidget(); ?>
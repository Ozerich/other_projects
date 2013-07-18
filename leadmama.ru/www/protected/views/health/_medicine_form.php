<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'info_form',
    'action' => '/user/medicine_info/',
    'htmlOptions' => array('class' => 'popup-form'),
    'enableAjaxValidation' => true,
    'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false),
)); ?>

<div class="row">
    <div class="param double">
        <?php echo $form->labelEx($model, 'medicine_info'); ?>
        <?php echo $form->textarea($model, 'medicine_info', array('class' => 'cleditor')); ?>
        <?php echo $form->error($model, 'medicine_info'); ?>
    </div>
</div>

<div class="row submit-row">
    <?php echo CHtml::submitButton('Сохранить'); ?>
</div>

<? $this->endWidget(); ?>
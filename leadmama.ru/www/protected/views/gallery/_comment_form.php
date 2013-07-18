<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'comment_form',
    'action' => '/gallery/photo/'.$id,
    'htmlOptions' => array('class' => 'popup-form'),
    'enableAjaxValidation' => true,
    'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false),
)); ?>

<div class="row">
    <div class="param double">
        <?php echo $form->labelEx($model, 'text'); ?>
        <?php echo $form->textarea($model, 'text'); ?>
        <?php echo $form->error($model, 'text'); ?>
    </div>
</div>

<div class="row submit-row">
    <?php echo CHtml::submitButton('Добавить'); ?>
</div>

<? $this->endWidget(); ?>
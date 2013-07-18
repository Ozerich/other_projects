<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'comment_form',
    'action' => '/diary/comment/'.$diary_id,
    'htmlOptions' => array('class' => 'popup-form', 'enctype' => 'multipart/form-data'),
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
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить'); ?>
</div>

<? $this->endWidget(); ?>
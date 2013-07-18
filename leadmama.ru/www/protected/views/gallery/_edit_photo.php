<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'edit_photo',
    'htmlOptions' => array('class' => 'popup-form', 'enctype' => 'multipart/form-data'),
)); ?>


<div class="row">
    <div class="param double">
        <?php echo $form->labelEx($model, 'photo'); ?>
        <?php echo $form->fileField($model, 'photo'); ?>
        <?php echo $form->error($model, 'photo'); ?>
    </div>
</div>


<div class="row submit-row">
    <?php echo CHtml::submitButton('Сохранить'); ?>
</div>

<? $this->endWidget(); ?>
<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'album_form',
    'action' => '/gallery/'.($model->isNewRecord ? '' : $model->id),
    'htmlOptions' => array('class' => 'popup-form', 'enctype' => 'multipart/form-data'),
    'enableAjaxValidation' => true,
    'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false),
)); ?>

<div class="row">
    <div class="param double">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title'); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>
</div>

<? if($model->photo): ?>
<div class="row">
    <div class="old-photo param">
        <label>Текущая обложка:</label>
        <img class="avatar-size" src="<?=$model->getPhoto(); ?>"/>
    </div>
</div>
<? endif; ?>

<div class="row">
    <div class="param double">
        <?php echo $form->labelEx($model, 'photo'); ?>
        <?php echo $form->fileField($model, 'photo'); ?>
        <?php echo $form->error($model, 'photo'); ?>
    </div>
</div>

<div class="row">
    <div class="param double">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php echo $form->textarea($model, 'description', array('class' => 'cleditor')); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>
</div>

<div class="row submit-row">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить'); ?>
</div>

<? $this->endWidget(); ?>
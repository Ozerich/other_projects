<div class="ui-widget popup" data-title="Изменить фотографию" data-width="400" id="edit_photo">
    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'baby_photo_form',
    'action' => '/baby/update/',
    'htmlOptions' => array('class' => 'popup-form', 'enctype' => 'multipart/form-data'),
)); ?>

    <div class="row">
        <div class="old-photo param">
            <label>Текущая фотография:</label>
            <img class="avatar-size" src="<?=$model->getPhoto(); ?>"/>
        </div>
    </div>
    <div class="row">
        <div class="param">
            <label>Новая фотография:</label>
            <?php echo $form->fileField($model, 'photo'); ?>
        </div>
    </div>
    <div class="row">
        <div class="submit">
            <?php echo CHtml::submitButton('Сохранить'); ?>
        </div>
    </div>

    <? $this->endWidget(); ?>
</div>
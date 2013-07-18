<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'photos_form',
    'action' => '/gallery/'.$model->id,
    'htmlOptions' => array('class' => 'popup-form', 'enctype' => 'multipart/form-data'),
)); ?>

<? for($i = 1; $i <= 5; $i++):?>
<div class="row">
    <div class="param">
        <label>Фотография <?=$i?>:</label>
        <input type="file" name="PhotoAlbumPhoto[]"/>
    </div>
</div>
<? endfor; ?>


<div class="row submit-row">
    <?php echo CHtml::submitButton('Добавить'); ?>
</div>

<? $this->endWidget(); ?>
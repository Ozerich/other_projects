<div id="page_page_item">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => '/admin/news/item/'.($model ? 'id/'.$model->id : ''),
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>

    <div class="row">
        <div class="param">
            <?php echo $form->labelEx($model, 'title'); ?>
            <?php echo $form->textField($model, 'title'); ?>
            <?php echo $form->error($model, 'title'); ?>
        </div>
        <div class="param">
            <?php echo $form->labelEx($model, 'date'); ?>
            <?php echo $form->textField($model, 'date', array('class' => 'datepicker')); ?>
            <?php echo $form->error($model, 'date'); ?>
        </div>
    </div>

    <div class="row">
        <div class="param double">
            <?php echo $form->labelEx($model, 'image'); ?>
            <?php echo $form->fileField($model, 'image'); ?>
            <?php echo $form->error($model, 'image'); ?>
        </div>
    </div>

    <div class="row">
        <div class="param double">
            <?php echo $form->labelEx($model, 'text'); ?>
            <? $this->widget('application.extensions.editor.Editor', array('model'=>$model,'attribute'=>'text')); ?>
            <?php echo $form->error($model, 'text'); ?>
        </div>
    </div>

    <div class="row">
        <div class="submit">
            <?php echo CHtml::submitButton('Сохранить'); ?>
        </div>
    </div>

    <? $this->endWidget(); ?>
</div>
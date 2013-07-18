<div id="page_page_item">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => '/admin/pages/item/'.($model ? 'id/'.$model->id : ''),
    ));
    ?>

    <div class="row">
        <div class="param">
            <?php echo $form->labelEx($model, 'title'); ?>
            <?php echo $form->textField($model, 'title'); ?>
            <?php echo $form->error($model, 'title'); ?>
        </div>
        <div class="param">
            <?php echo $form->labelEx($model, 'alias'); ?>
            <?php echo $form->textField($model, 'alias'); ?>
            <?php echo $form->error($model, 'alias'); ?>
        </div>
    </div>

    <div class="row">
        <div class="param double">
            <?php echo $form->labelEx($model, 'meta_keywords'); ?>
            <?php echo $form->textField($model, 'meta_keywords'); ?>
            <?php echo $form->error($model, 'meta_keywords'); ?>
        </div>
    </div>

    <div class="row">
        <div class="param double">
            <?php echo $form->labelEx($model, 'meta_description'); ?>
            <?php echo $form->textarea($model, 'meta_description'); ?>
            <?php echo $form->error($model, 'meta_description'); ?>
        </div>
    </div>

    <div class="row">
        <div class="param double">
            <?php echo $form->labelEx($model, 'text'); ?>
            <? $this->widget('application.extensions.editor.Editor', array('model'=>$model,'attribute'=>'text')); ?>
            <?php echo $form->error($model, 'text'); ?>
        </div>
    </div>
	
	<div class="row" style="margin-top: 10px;">
        <div class="param double">
            <?php echo $form->labelEx($model, 'sidebar'); ?>
            <? $this->widget('application.extensions.editor.Editor', array('model'=>$model,'attribute'=>'sidebar')); ?>
            <?php echo $form->error($model, 'sidebar'); ?>
        </div>
    </div>

    <div class="row">
        <div class="submit">
            <?php echo CHtml::submitButton('Сохранить'); ?>
        </div>
    </div>

    <? $this->endWidget(); ?>
</div>
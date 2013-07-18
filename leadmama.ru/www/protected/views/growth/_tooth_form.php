<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'tooth_form',
    'action' => '/tooth/' . $num,
    'htmlOptions' => array('class' => 'popup-form'),
    'enableAjaxValidation' => true,
    'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false),
)); ?>

<div class="row">
    <div class="param double">
        <?php echo $form->labelEx($model, $param); ?>
        <?php echo $form->textField($model, $param, array('class' => 'datepicker', 'id' => 'BabyTooth_tooth_'.$num.'_popup')); ?>
        <?php echo $form->error($model, $param); ?>
    </div>
</div>


<div class="row submit-row">
    <?php echo CHtml::submitButton('Сохранить'); ?>
</div>

<? $this->endWidget(); ?>


<script>
    jQuery('#tooth_form').yiiactiveform({
        'validateOnSubmit':true,
        'validateOnChange':false,
        'attributes':[{
            'id':'BabyTooth_tooth_<?=$num?>',
            'inputID':'BabyTooth_tooth_<?=$num?>_popup',
            'errorID':'BabyTooth_tooth_<?=$num?>_em_',
            'model':'BabyTooth',
            'name':'tooth_<?=$num?>',
            'enableAjaxValidation':true,
            'status':0
        }]
    });
</script>
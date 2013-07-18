<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'teeth_form',
    'action' => '/teeth/',
    'htmlOptions' => array('class' => 'popup-form'),
    'enableAjaxValidation' => true,
    'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false),
)); ?>

<? for ($i = 1; $i <= 20; $i++): ?>
<? if ($i % 2): ?><div class="row"><? endif; ?>
    <div class="param">
        <?php echo $form->labelEx($model, 'tooth_'.$i); ?>
        <?php echo $form->textField($model, 'tooth_'.$i, array('class' => 'datepicker', 'tabindex' => '-1')); ?>
        <?php echo $form->error($model, 'tooth_'.$i); ?>
    </div>
    <? if ($i % 2 === 0): ?></div><? endif; ?>
<? endfor; ?>

<div class="row submit-row">
    <?php echo CHtml::submitButton('Сохранить'); ?>
</div>

<? $this->endWidget(); ?>
<div class="page" id="page_profile">
    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'profile_form',
    'action' => '/profile',
    'enableAjaxValidation' => true,
    'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false),
)); ?>
    <fieldset>

        <div class="param">
            <?=$form->labelEx($model, 'name');?>
            <?=$form->textField($model, 'name', array('class' => 'input'));?>
            <?=$form->error($model, 'name');?>
        </div>

        <div class="param">
            <?=$form->labelEx($model, 'legal_address');?>
            <?=$form->textField($model, 'legal_address', array('class' => 'input'));?>
            <?=$form->error($model, 'legal_address');?>
        </div>

        <div class="param">
            <?=$form->labelEx($model, 'details');?>
            <?=$form->textarea($model, 'details', array('class' => 'textarea'));?>
            <?=$form->error($model, 'details');?>
        </div>

        <div class="param">
            <?=$form->labelEx($model, 'address'); ?>
            <?=$form->textField($model, 'address', array('class' => 'input'));?>
            <?=$form->error($model, 'address'); ?>
        </div>

        <div class="param">
            <?=$form->labelEx($model, 'form'); ?>
            <span class="value"><?=Company::$forms[$model->form]?></span>
            <?=$form->error($model, 'form'); ?>
            <br clear="all"/>
        </div>


        <div class="param">
            <?=$form->labelEx($model, 'area'); ?>
            <?=$form->dropDownList($model, 'area', Company::$areas, array('class' => 'select'));?>
            <?=$form->error($model, 'area'); ?>
            <br clear="all"/>
        </div>

        <div class="param">
            <?=$form->labelEx($model, 'phone'); ?>

            <div class="phone-row">
                <span>+7</span>

                <div class="cod">
                    <input id="n5" maxlength="3" type="text" class="input input4" value="<?=$model->phone_parts[0]?>">
                </div>
                <span>-</span>
                <input type="text" maxlength="3" class="input input2" value="<?=$model->phone_parts[1]?>">
                <span>-</span>
                <input type="text" maxlength="2" class="input input3 input31" value="<?=$model->phone_parts[2]?>">
                <span>-</span>
                <input type="text" maxlength="2" class="input input3 input32" value="<?=$model->phone_parts[3]?>">

                <?=$form->hiddenField($model, 'phone', array('id' => 'phone_value'));?>
            </div>
            <?=$form->error($model, 'phone'); ?>
        </div>

        <div class="param">
            <?=$form->labelEx($model, 'contact_person'); ?>
            <?=$form->textField($model, 'contact_person', array('class' => 'input'));?>
            <?=$form->error($model, 'contact_person');?>
        </div>



        <div class="buttons">
            <?php echo CHtml::SubmitButton('Сохранить', array('class' => 'button-new')); ?>
        </div>

    </fieldset>

    <? $this->endWidget(); ?>

</div>
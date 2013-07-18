<a href="#" class="close"></a>
<div class="form-company cartochka">
    <span class="h2"><?=$model->isNewRecord ? 'Новая компания' : 'Компания №' . $model->id?></span></span>


    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'company_form_'.($model->isNewRecord ? '' : $model->id),
    'action' => '/companies/item/' . (!$model->isNewRecord ? $model->id : ''),
    'enableAjaxValidation' => true,
    'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false),
)); ?>

    <fieldset>
        <!-- <div class="box">
             <label>Статус:</label>
             <select class="select">
                 <option>Новая</option>
                 <option>Новая 2</option>
                 <option>Новая 3</option>
                 <option>Новая 4</option>
                 <option>Новая 5</option>
                 <option>Новая 6</option>
             </select>
         </div>
         <div class="box">
             <label>Тип аккаунта:</label>
             <select class="select">
                 <option>Социальный пакет</option>
                 <option>Социальный пакет1</option>
                 <option>Социальный пакет2</option>
                 <option>Социальный пакет3</option>
                 <option>Социальный пакет4</option>
                 <option>Социальный пакет5</option>
             </select>
         </div>
         <div class="box">
             <label>Тип пакета:</label>
             <select class="select">
                 <option>Базовый</option>
                 <option>Базовый1</option>
                 <option>Базовый2</option>
                 <option>Базовый3</option>
                 <option>Базовый4</option>
                 <option>Базовый5</option>
             </select>
         </div>-->


        <div class="param">
            <?=$form->labelEx($model, 'email'); ?>
            <?=$form->textField($model, 'email', array('class' => 'input'));?>
            <?=$form->error($model, 'email');?>
        </div>

        <? if ($model->isNewRecord): ?>
        <div class="param">
            <?=$form->labelEx($model, 'password'); ?>
            <?=$form->textField($model, 'password', array('class' => 'input'));?>
            <?=$form->error($model, 'password'); ?>
        </div>
        <? endif; ?>

        <div class="box">
            <?=$form->labelEx($model, 'name');?>
            <?=$form->textField($model, 'name', array('class' => 'input'));?>
            <?=$form->error($model, 'name');?>
        </div>

        <div class="box">
            <?=$form->labelEx($model, 'balance');?>
            <?=$form->textField($model, 'balance', array('class' => 'input'));?>
            <?=$form->error($model, 'balance');?>
        </div>

        <div class="box">
            <?=$form->labelEx($model, 'legal_address');?>
            <?=$form->textField($model, 'legal_address', array('class' => 'input'));?>
            <?=$form->error($model, 'legal_address');?>
        </div>

        <div class="box">
            <?=$form->labelEx($model, 'details');?>
            <?=$form->textarea($model, 'details', array('class' => 'textarea'));?>
            <?=$form->error($model, 'details');?>
        </div>

        <div class="box">
            <?=$form->labelEx($model, 'address'); ?>
            <?=$form->textField($model, 'address', array('class' => 'input'));?>
            <?=$form->error($model, 'address'); ?>
        </div>

        <div class="box">
            <?=$form->labelEx($model, 'form'); ?>
            <?=$form->dropDownList($model, 'form', Company::$forms, array('class' => 'select'));?>
            <?=$form->error($model, 'form'); ?>
            <br clear="all"/>
        </div>


        <div class="box">
            <?=$form->labelEx($model, 'area'); ?>
            <?=$form->dropDownList($model, 'area', Company::$areas, array('class' => 'select'));?>
            <?=$form->error($model, 'area'); ?>
            <br clear="all"/>
        </div>

        <div class="box">
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

        <div class="box">
            <?=$form->labelEx($model, 'contact_person'); ?>
            <?=$form->textField($model, 'contact_person', array('class' => 'input'));?>
            <?=$form->error($model, 'contact_person');?>
        </div>

        <div class="links">
            <?php echo CHtml::SubmitButton('Сохранить', array('class' => 'button-new')); ?>
            <a href="#" class="grey close-btn">Отмена</a>
        </div>

    </fieldset>
    <? $this->endWidget(); ?>

</div>



<?php
$this->pageTitle = Yii::app()->name . ' - Регистрация на сайте';
?>

<div class="page-block page-block-beige">
    <div class="width" id="page_register">

        <div class="ui-widget form register-form">

            <div class="ui-widget-header">
                <h1>Регистрация на сайте</h1>
            </div>

            <div class="ui-widget-content">

                <?php $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'register_form',
                    'enableAjaxValidation' => true,
                    'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false),
                    'htmlOptions' => array('enctype' => 'multipart/form-data'))
            ); ?>

                <p class="note">Поля со знаком <span class="required">*</span> обязательны для заполнения.</p>

                <div class="row">
                    <?php echo $form->labelEx($model, 'email'); ?>
                    <?php echo $form->textField($model, 'email'); ?>
                    <?php echo $form->error($model, 'email'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model, 'login'); ?>
                    <?php echo $form->textField($model, 'login'); ?>
                    <?php echo $form->error($model, 'login'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model, 'password'); ?>
                    <?php echo $form->passwordField($model, 'password'); ?>
                    <?php echo $form->error($model, 'password'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model, 'password2'); ?>
                    <?php echo $form->passwordField($model, 'password2'); ?>
                    <?php echo $form->error($model, 'password2'); ?>
                </div>

				<div class="row">
                    <?php echo $form->labelEx($model, 'type'); ?>
                    <?php echo $form->dropDownList($model, 'type', User::$types); ?>
                    <?php echo $form->error($model, 'fio'); ?>
                </div>
				
                <div class="row">
                    <?php echo $form->labelEx($model, 'fio'); ?>
                    <?php echo $form->textField($model, 'fio'); ?>
                    <?php echo $form->error($model, 'fio'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model, 'birth_date'); ?>
                    <?php echo $form->textField($model, 'birth_date', array('class' => 'datepicker')); ?>
                    <?php echo $form->error($model, 'birth_date'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model, 'avatar'); ?>
                    <?php echo $form->fileField($model, 'avatar'); ?>
                    <?php echo $form->error($model, 'avatar'); ?>
                </div>

                <div class="row">
                    <?if (CCaptcha::checkRequirements()): ?>
                    <?php echo $form->labelEx($model, 'verifyCode'); ?>
                    <div class="captcha">
                        <?$this->widget('CCaptcha')?>
                        <?php echo $form->textField($model, 'verifyCode'); ?>
                        <?php echo $form->error($model, 'verifyCode'); ?>
                    </div>
                    <? endif?>
                </div>

                <input type="hidden" name="invite" value="<?=$invite?>"/>


                <div class="row submit">
                    <?php echo CHtml::submitButton('Зарегистрироваться'); ?>
                </div>

                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>
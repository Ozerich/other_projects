<div id="page_update_baby">


    <div class="page-block page-block-blue">
        <div class="top-bg"></div>
        <div class="width">
		
		<?=$this->renderPartial('//other_baby_header'); ?>
            <div class="ui-widget">
                <div class="ui-widget-header">Ваш ребенок</div>
                <div class="ui-widget-content">
                    <?php $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'baby_form',
                    'htmlOptions' => array('class' => 'site-form', 'enctype' => 'multipart/form-data')
                )); ?>

                    <p class="note">Поля со знаком <span class="required">*</span> обязательны для заполнения.</p>

                    <div class="row">
                        <div class="param">
                            <?php echo $form->labelEx($model, 'name'); ?>
                            <?php echo $form->textField($model, 'name'); ?>
                            <?php echo $form->error($model, 'name'); ?>
                        </div>

                        <div class="param">
                            <?php echo $form->labelEx($model, 'nickname'); ?>
                            <?php echo $form->textField($model, 'nickname'); ?>
                            <?php echo $form->error($model, 'nickname'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="param">
                            <?php echo $form->labelEx($model, 'sex'); ?>
                            <?php echo $form->dropDownList($model, 'sex', Baby::$sex_texts); ?>
                            <?php echo $form->error($model, 'sex'); ?>
                        </div>

                        <div class="param">
                            <?php echo $form->labelEx($model, 'birth_date'); ?>
                            <?php echo $form->textField($model, 'birth_date', array('class' => 'datepicker', 'placeholder' => '25.04.2012')); ?>
                            <?php echo $form->error($model, 'birth_date'); ?>
                        </div>

                    </div>
                    <div class="row">
                        <div class="param">
                            <?php echo $form->labelEx($model, 'mother'); ?>
                            <?php echo $form->textField($model, 'mother'); ?>
                            <?php echo $form->error($model, 'mother'); ?>
                        </div>

                        <div class="param">
                            <?php echo $form->labelEx($model, 'father'); ?>
                            <?php echo $form->textField($model, 'father'); ?>
                            <?php echo $form->error($model, 'father'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="param">
                            <?php echo $form->labelEx($model, 'weight'); ?>
                            <?php echo $form->textField($model, 'weight', array('placeholder' => 'Например, 3.5кг')); ?>
                            <?php echo $form->error($model, 'weight'); ?>
                        </div>

                        <div class="param">
                            <?php echo $form->labelEx($model, 'height'); ?>
                            <?php echo $form->textField($model, 'height', array('placeholder' => 'Например, 84cм')); ?>
                            <?php echo $form->error($model, 'height'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="param">
                            <?php echo $form->labelEx($model, 'hair_type'); ?>
                            <?php echo $form->dropDownList($model, 'hair_type', Baby::$hair_type_texts); ?>
                            <?php echo $form->error($model, 'hair_type'); ?>
                        </div>

                        <div class="param">
                            <?php echo $form->labelEx($model, 'hair_color'); ?>
                            <?php echo $form->textField($model, 'hair_color'); ?>
                            <?php echo $form->error($model, 'hair_color'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="param">
                            <?php echo $form->labelEx($model, 'eye_color'); ?>
                            <?php echo $form->textField($model, 'eye_color'); ?>
                            <?php echo $form->error($model, 'eye_color'); ?>
                        </div>

                        <div class="param">
                            <?php echo $form->labelEx($model, 'photo'); ?>
                            <?php echo $form->fileField($model, 'photo'); ?>
                            <?php echo $form->error($model, 'photo'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="param">
                            <?php echo $form->labelEx($model, 'birth_time'); ?>
                            <?php echo $form->textField($model, 'birth_time', array('placeholder' => 'Например, 10:45')); ?>
                            <?php echo $form->error($model, 'birth_time'); ?>
                        </div>

                        <div class="param">
                            <?php echo $form->labelEx($model, 'was_near'); ?>
                            <?php echo $form->textField($model, 'was_near'); ?>
                            <?php echo $form->error($model, 'was_near'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="param">
                            <?php echo $form->labelEx($model, 'birth_place'); ?>
                            <?php echo $form->textField($model, 'birth_place'); ?>
                            <?php echo $form->error($model, 'birth_place'); ?>
                        </div>

                        <div class="param">
                            <?php echo $form->labelEx($model, 'similar_to'); ?>
                            <?php echo $form->textField($model, 'similar_to'); ?>
                            <?php echo $form->error($model, 'similar_to'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="param">
                            <?php echo $form->labelEx($model, 'doctor'); ?>
                            <?php echo $form->textField($model, 'doctor'); ?>
                            <?php echo $form->error($model, 'doctor'); ?>
                        </div>

                        <div class="param">
                            <?php echo $form->labelEx($model, 'alter_name'); ?>
                            <?php echo $form->textField($model, 'alter_name'); ?>
                            <?php echo $form->error($model, 'alter_name'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="param double">
                            <?php echo $form->labelEx($model, 'description'); ?>
                            <?php echo $form->textArea($model, 'description'); ?>
                            <?php echo $form->error($model, 'description'); ?>
                        </div>
                    </div>

                    <br clear="all"/>

                    <div class="submit">
                        <?php echo CHtml::submitButton('Сохранить'); ?>
                    </div>

                    <? $this->endWidget(); ?>
                </div>
            </div>


        </div>
    </div>
</div>
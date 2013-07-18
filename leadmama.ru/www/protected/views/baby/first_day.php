<div id="page_baby" class="page page-block page-block-yellow">

    <div class="page-block page-block-blue">
        <div class="top-bg"></div>
        <div class="width">
		
		<?=$this->renderPartial('//other_baby_header'); ?>
            <div class="right-banner">
                <a href="/page/services" class="print-photo">Печать фотодневника</a>
                <div class="right-banner-image"><?=Page::model()->find("alias='right_banner'")->text; ?></div>
            </div>
            <div class="name">
                <h2>Первый день</h2>
                <? if (!$is_guest): ?>  <a href="#" class="but popup-link" data-popup="update_popup"><img
                    src="/images/img7.png" alt=""/><span>Редактировать</span></a>
                <? endif; ?>
            </div>
            <div class="opis">
                <div class="ramka-photo">
                    <div class="pic">
                        <img src="<?=$model->getPhoto();?>" alt=""/>
                        <span class="ramka"></span>
                    </div>
                    <? if (!$is_guest): ?>      <a href="#" class="popup-link" data-popup="edit_photo">Изменить
                    фотографию</a>  <? endif; ?>
                </div>

                <div class="text-bg text-bg2">
                    <img class="cl" src="/images/img9.gif" alt="">
                    <dl class="inform">
                        <dt>Имя:</dt>
                        <dd><?=$model->name?></dd>
                        <dt>Nickname</dt>
                        <dd><?=$model->nickname?></dd>
                        <dt>Дата рождения:</dt>
                        <dd><?=$model->birth_date?></dd>
                        <dt>Время рождения:</dt>
                        <dd><?=$model->birth_time?></dd>
                        <? if (!empty($model->birth_place)): ?>
                        <dt>Место рождения:</dt>
                        <dd><?=$model->birth_place?></dd>
                        <? endif; ?>
                        <? if (!empty($model->doctor)): ?>
                        <dt>Доктор:</dt>
                        <dd><?=$model->doctor?></dd>
                        <? endif; ?>
                        <? if (!empty($model->weight)): ?>
                        <dt>Вес:</dt>
                        <dd><?=$model->weight?> кг.</dd>
                        <? endif; ?>
                        <? if (!empty($model->height)): ?>
                        <dt>Рост:</dt>
                        <dd><?=$model->height?> см.</dd>
                        <? endif; ?>
                    </dl>
                    <dl class="inform">
                        <dt>Тип волос:</dt>
                        <dd><?=Baby::$hair_type_texts[$model->hair_type]?></dd>
                        <? if (!empty($model->hair_color)): ?>
                        <dt>Цвет волос:</dt>
                        <dd><?=$model->hair_color?></dd>
                        <? endif; ?>
                        <? if (!empty($model->eye_color)): ?>
                        <dt>Цвет глаз:</dt>
                        <dd><?=$model->eye_color?></dd>
                        <? endif; ?>
                        <? if (!empty($model->was_near)): ?>
                        <dt>Кто был рядом?</dt>
                        <dd><?=$model->was_near?></dd>
                        <? endif; ?>
                        <? if (!empty($model->similar_to)): ?>
                        <dt>На кого был похож ребенок?</dt>
                        <dd><?=$model->similar_to?></dd>
                        <? endif; ?>
                        <? if (!empty($model->alter_name)): ?>
                        <dt>Альтернативные имена:</dt>
                        <dd><?=$model->alter_name?></dd>
                        <? endif; ?>
                        <? if (!empty($model->description)): ?>
                        <dt>Воспоминия о рождении:</dt>
                        <dd><?=$model->description?></dd>
                        <? endif; ?>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>

<? if (!$is_guest): ?>
<div class="ui-widget popup" data-title="Редактировать ребенка" data-width="800" id="update_popup">

    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'baby_form',
    'htmlOptions' => array('class' => 'popup-form'),
    'enableAjaxValidation' => true,
    'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false),
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
            <?php echo $form->labelEx($model, 'birth_date'); ?>
            <?php echo $form->textField($model, 'birth_date', array('class' => 'datepicker')); ?>
            <?php echo $form->error($model, 'birth_date'); ?>
        </div>

        <div class="param">
            <?php echo $form->labelEx($model, 'birth_time'); ?>
            <?php echo $form->textField($model, 'birth_time'); ?>
            <?php echo $form->error($model, 'birth_time'); ?>
        </div>

    </div>

    <div class="row">
        <div class="param">
            <?php echo $form->labelEx($model, 'birth_place'); ?>
            <?php echo $form->textField($model, 'birth_place'); ?>
            <?php echo $form->error($model, 'birth_place'); ?>
        </div>

        <div class="param">
            <?php echo $form->labelEx($model, 'doctor'); ?>
            <?php echo $form->textField($model, 'doctor'); ?>
            <?php echo $form->error($model, 'doctor'); ?>
        </div>
    </div>

    <div class="row">
        <div class="param">
            <?php echo $form->labelEx($model, 'weight'); ?>
            <?php echo $form->textField($model, 'weight'); ?>
            <?php echo $form->error($model, 'weight'); ?>
        </div>

        <div class="param">
            <?php echo $form->labelEx($model, 'height'); ?>
            <?php echo $form->textField($model, 'height'); ?>
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
            <?php echo $form->labelEx($model, 'was_near'); ?>
            <?php echo $form->textField($model, 'was_near'); ?>
            <?php echo $form->error($model, 'was_near'); ?>
        </div>
    </div>

    <div class="row">
        <div class="param">
            <?php echo $form->labelEx($model, 'similar_to'); ?>
            <?php echo $form->textField($model, 'similar_to'); ?>
            <?php echo $form->error($model, 'similar_to'); ?>
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

<? $this->renderPartial('//baby/_update_photo_form', array('model' => $model)) ?>

<? endif; ?>
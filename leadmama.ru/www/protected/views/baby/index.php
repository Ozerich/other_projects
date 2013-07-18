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
                <h2>О малыше</h2>
                <? if (!$is_guest): ?>
                <a href="#" class="but popup-link" data-popup="update_popup"><img
                        src="/images/img7.png" alt=""/><span>Редактировать</span></a>
                <? endif; ?>
            </div>
            <div class="opis">
                <div class="ramka-photo">
                    <div class="pic">
                        <img src="<?=$model->getPhoto();?>" alt=""/>
                        <span class="ramka"></span>
                    </div>
                    <? if (!$is_guest): ?><a href="#" class="popup-link" data-popup="edit_photo">Изменить
                    фотографию</a><? endif; ?>
                </div>
                <div class="text-bg text-bg2">
                    <img class="cl" src="/images/img9.gif" alt=""/>
                    <dl class="inform">
                        <dt>Имя:</dt>
                        <dd><?=$model->name?></dd>
                        <dt>Nickname</dt>
                        <dd><?=$model->nickname?></dd>
                        <dt>Пол:</dt>
                        <dd><?=Baby::$sex_texts[$model->sex]?></dd>
                        <dt>Возраст:</dt>
                        <dd><?=$model->getTextAge()?></dd>
                        <dt>Дата рождения:</dt>
                        <dd><?=$model->birth_date?></dd>
                        <? if (!empty($model->mother)): ?>
                        <dt>Мама:</dt>
                        <dd><?=$model->mother?></dd>
                        <? endif; ?>
                        <? if (!empty($model->father)): ?>
                        <dt>Папа:</dt>
                        <dd><?=$model->father?></dd>
                        <? endif; ?>
                        <? if (!empty($model->weight)): ?>
                        <dt>Вес:</dt>
                        <dd><?=$model->weight?></dd>
                        <? endif; ?>
                        <? if (!empty($model->height)): ?>
                        <dt>Рост:</dt>
                        <dd><?=$model->height?></dd>
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
                        <dt>Греческий Знак Зодиака:</dt>
                        <dd><?=$model->getGreeceSign()?></dd>
                        <dt>Китайский Знак Зодиака:</dt>
                        <dd><?=$model->getChinaSign();?></dd>
                        <dt>Камень:</dt>
                        <dd><?=$model->getStone();?></dd>
                        <dt>Цветок:</dt>
                        <dd><?=$model->getFlower();?></dd>
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
            <?php echo $form->labelEx($model, 'sex'); ?>
            <?php echo $form->dropDownList($model, 'sex', Baby::$sex_texts); ?>
            <?php echo $form->error($model, 'sex'); ?>
        </div>

        <div class="param">
            <?php echo $form->labelEx($model, 'birth_date'); ?>
            <?php echo $form->textField($model, 'birth_date', array('class' => 'datepicker')); ?>
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

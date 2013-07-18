<div class="page-header">
    <span><?=$model->isNewRecord === false ? 'Объявление №' . $model->id : 'Новое объявление'?></span>
</div>

<div class="page" id="advert_page">
    <div class="left-aside">
        <span class="h2">Конструктор</span>

        <fieldset class="designer">

            <div class="box">
                <label>Тип объявления:</label>
                <? if ($model->isNewRecord): ?>
                <select id="advert_type_select" class="select">
                    <? foreach (Advert::GetAllTypes() as $value => $label): ?>
                    <option value="<?=$value?>"><?=$label?></option>
                    <? endforeach; ?>
                </select>
                <? else: ?>
                <span class="value"><?=$model->type_text?></span>
                <? endif; ?>
            </div>

            <? $c = 0;
            $types = $model->isNewRecord ? Advert::GetAllTypes() : array($model->type => $model->type_text);
            foreach ($types as $id => $t): $model = $model->isNewRecord ? new Advert($id) : $model; ?>

                <?php $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'advert_form_' . $id,
                    'action' => '/item' . ($model->isNewRecord ? '' : '/' . $model->id) . (isset($folder) && $folder !== null ? '?folder=' . $folder : ''),
                    'enableAjaxValidation' => true,
                    'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false),
                    'htmlOptions' => array('enctype' => 'multipart/form-data')
                )); ?>

                <div class="advert-type-block" style="display: <?=$c++ == 0 ? 'block' : 'none'?>"
                     id="advert_block_<?=$id?>">

                    <? foreach ($model->attributeLabels() as $param => $label): ?>
                    <div class="box">
                        <label for="<?=$id . $param?>"><?=$label?></label>

                        <? if ($param == 'appeal'): ?>
                        <?=
                        $form->dropDownList($model, $param, Advert::$appeals, array('class' => 'select'))
                        ; ?>
                        <? elseif ($param == 'short_description' || $param == 'description'): ?>
                        <?=
                        $form->textarea($model, $param, array('class' => 'textarea'))
                        ; ?>

                        <? elseif ($param == 'phone' || $param == 'phone_2'): ?>

                        <div class="phone-row">
                            <span>+7</span>

                            <div class="cod">
                                <input id="n5" maxlength="3" type="text" class="input input4"
                                       value="<?=$model->phone_parts[0]?>">
                            </div>
                            <span>-</span>
                            <input type="text" maxlength="3" class="input input2" value="<?=$model->phone_parts[1]?>">
                            <span>-</span>
                            <input type="text" maxlength="2" class="input input3 input31"
                                   value="<?=$model->phone_parts[2]?>">
                            <span>-</span>
                            <input type="text" maxlength="2" class="input input3 input32"
                                   value="<?=$model->phone_parts[3]?>">
                            <?= $form->hiddenField($model, $param)
                            ; ?>
                        </div>


                        <? elseif ($param == 'photo'): ?>
                        <div class="photo-param">
                            <? if (!$model->isNewRecord && $model->photo): ?>
                            <div class="image">
                                <img src="<?=$model->photo_url?>"/>
                            </div>
                            <? endif; ?>

                            <?=
                            $form->fileField($model, $param, array('class' => 'but', 'title' => $model->photo ? 'Загрузить новый' : 'Загрузить'))
                            ; ?>
                        </div>

                        <? elseif ($param == 'photos'): ?>
                        <div class="gallery photo-param">
                            <? foreach ($model->getPhotos() as $photo): ?>
                            <div class="image">
                                <img src="<?=$photo->url?>"/>
                            </div>
                            <? endforeach; ?>
                            <input type="file" class="but" name="photos[]" title="Загрузить">
                        <span class="link new-photo">+ <a href="#">Добавить еще
                            фото</a></span>
                        </div>

                        <? else: ?>

                        <?=
                        $form->textField($model, $param, array('class' => 'input ' . ($param == 'datetime' ? 'datetime' : '')))
                        ; ?>
                        <? endif; ?>
                        <?=$form->error($model, $param);?>


                    </div>

                    <? endforeach; ?>

                    <input type="hidden" name="color_1" value="<?=!$model->isNewRecord ? $model->color_1 : '3a3a3a'?>"/>
                    <input type="hidden" name="color_2" value="<?=!$model->isNewRecord ? $model->color_2 : '3a3a3a'?>"/>
                    <input type="hidden" name="color_3" value="<?=!$model->isNewRecord ? $model->color_3 : '3a3a3a'?>"/>

                    <input type="hidden" name="Advert[type]" value="<?=$id?>"/>

                    <? if (isset($folder) && $folder !== null): ?>
                    <input type="hidden" name="folder" value="<?=$folder?>"/>
                    <? endif; ?>

                    <?php echo CHtml::SubmitButton('Сохранить и отправить на модерацию', array('class' => 'button-new')); ?>
                </div>


                <? $this->endWidget(); ?>

                <? endforeach; ?>

        </fieldset>
        </form>
    </div>


    <div class="right-aside">
        <span class="h2">Просмотр</span>

        <div class="color-box">

            <div class="color">
                <div class="customWidget">
                    <div class="colorSelector2">
                        <div data-param="color_1" style="background-color:<?=!$model->isNewRecord && $model->color_1 ? '#'.$model->color_1 : '#3a3a3a'?>"></div>
                    </div>
                </div>
                <p>Цвет<br> фона</p>
            </div>

            <div class="color">
                <div class="customWidget">
                    <div class="colorSelector2">
                        <div data-param="color_2" style="background-color:<?=!$model->isNewRecord && $model->color_2 ? '#'.$model->color_2 : '#3a3a3a'?>"></div>
                    </div>
                </div>
                <p>Цвет<br> текста</p>
            </div>

            <div class="color">
                <div class="customWidget">
                    <div class="colorSelector2">
                        <div data-param="color_3" style="background-color:<?=!$model->isNewRecord && $model->color_3 ? '#'.$model->color_3 : '#3a3a3a'?>"></div>
                    </div>
                </div>
                <p>Цвет<br> заголовков</p>
            </div>


            <a href="#" class="but">Загрузить</a>
        </div>

        <div class="photo-block">
            <div class="photo">
                <img src="/images/img01.jpg" alt="">
            </div>
            <div class="opis">
                <a href="#" class="black">Создать QR-код</a>

                <div class="qr">
                    <img src="/images/img02.jpg" alt="">

                    <form action="#">
                        <fieldset>
                            <select class="select4">
                                <option>Формат</option>
                                <option>Формат1</option>
                                <option>Формат2</option>
                            </select>

                            <div class="box">
                                <input type="text" class="input">
                                <span>px</span>
                            </div>
                            <a href="#" class="but">Скачать QR-код</a>
                            <span class="link"><a href="#">Оформить код</a></span>
                            <span class="link"><a href="#">HTML для сайта</a></span>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
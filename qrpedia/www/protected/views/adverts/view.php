<div class="page-header">
    <span>Объявление № <?=$model->id?></span>
</div>

<div class="page" id="advert_page">
    <div class="left-aside">
        <span class="h2">Конструктор</span>

        <fieldset class="designer">

            <div class="box">
                <label>Тип объявления:</label>
                <span class="value"><?=$model->type_text?></span>
            </div>

                <div class="advert-type-block" id="advert_block_<?= $model->type ?>">

                    <? foreach ($model->attributeLabels() as $param => $label): ?>
                        <div class="box">
                            <label for="<?= $model->type . $param ?>"><?=$label?></label>

                            <? if ($param == 'appeal'): ?>
                                <span class="value"><?=Advert::$appeals[$model->appeal]?></span>
                            <? elseif ($param == 'short_description' || $param == 'description'): ?>
                                <span class="value"><?=$model->$param?></span>
                            <? elseif ($param == 'phone' || $param == 'phone_2'): ?>
                                <span class="value"><?=$model->$param?></span>
                            <? elseif ($param == 'photo'): ?>
                                <div class="photo-param">

                                    <? if ($model->photo): ?>
                                        <div class="image">
                                            <img src="<?= $model->photo_url ?>"/>
                                        </div>
                                    <? endif; ?>
                                </div>

                            <? elseif ($param == 'photos'): ?>
                                <div class="gallery photo-param">
                                    <? foreach ($model->getPhotos() as $photo): ?>
                                        <div class="image">
                                            <img src="<?= $photo->url ?>"/>
                                        </div>
                                    <? endforeach; ?>
                                </div>

                            <? else: ?>
                                <span class="value"><?=$model->$param?></span>

                            <? endif; ?>


                        </div>

                    <? endforeach; ?>

                    <label>QR</label>
                    <span class="value">
                        <img src="<?=$model->getQRCodeUrl();?>"/>
                    </span>

                </div>


        </fieldset>
    </div>
</div>
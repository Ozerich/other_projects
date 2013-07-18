<div id="page_photoalbum" class="page page-block page-block-yellow">
	<div class="page-block page-block-blue">
    
        <div class="width">

<?=$this->renderPartial('//other_baby_header'); ?>
            <div class="right-banner">
                <a href="/page/services" class="print-photo">Печать фотодневника</a>
                <div class="right-banner-image"><?=Page::model()->find("alias='right_banner'")->text; ?></div>
            </div>

            <div class="name">
                <h2><?=$model->title?></h2>
                <? if (!$is_guest): ?>
                <a class="but popup-link" data-popup="edit_album">Редактировать альбом</a>
                <a class="but popup-link" data-popup="new_photos">Добавить фотографии</a>
                <? endif; ?>
            </div>

            <p class="photoalbum-description"><?=$model->description?></p>

            <? if (empty($model->photos)): ?>
            <div class="no-photos">Нет фотографий</div>
            <? else: foreach ($model->photos as $photo): ?>
            <div class="photo-item">
                <a href="/gallery/photo/<?=$photo->id?>"><img class="photo-img" src="<?=$photo->getPhoto();?>"/></a>
            </div>
            <? endforeach; endif; ?>
        </div>
    </div>
</div>

<? if (!$is_guest): ?>

<div class="ui-widget popup" id="edit_album" data-open="<?=$model->getErrors() ? 1 : 0?>"
     data-title="Редактировать альбом"
     data-width="500">
    <? $this->renderPartial('//gallery/_album_form', array('model' => $model)); ?>
</div>

<div class="ui-widget popup" id="new_photos" data-open="<?=$model->getErrors() ? 1 : 0?>" data-title="Новые фотографии"
     data-width="500">
    <? $this->renderPartial('//gallery/_photos_form', array('model' => $model)); ?>
</div>
<? endif; ?>
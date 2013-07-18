<div id="page_photoalbums" class="page page-block page-block-yellow">

    <div class="page-block page-block-blue">
        <div class="width ">

	<?=$this->renderPartial('//other_baby_header'); ?>
            <div class="right-banner">
                <a href="/page/services" class="print-photo">Печать фотодневника</a>
                <div class="right-banner-image"><?=Page::model()->find("alias='right_banner'")->text; ?></div>
            </div>

            <div class="name">
                <h2>Фотоальбомы</h2>
                <? if(!$is_guest): ?>
                    <a class="but popup-link" data-popup="new_album" href="#">Новый альбом</a>
                <? endif; ?>
            </div>

            <div class="photoalbums-list">
                <? if (!isset($items) || empty($items)): ?>
                <p class="no-photoalbums">Нет фотоальбомов</p>
                <? else: foreach ($items as $item): ?>
                <div class="photoalbum-item">

                    <div class="item-photo">
                        <a href="/gallery/view/<?=$item->id?>">
                            <img src="<?=$item->getPhoto();?>">
                            <span class="ramka"></span>
                        </a>
                    </div>

                    <div class="item-content">
                        <h3><a href="/gallery/view/<?=$item->id?>"><?=$item->title?></a></h3>

                        <p>(<?=count($item->photos)?> фото)</p>
                <? if(!$is_guest): ?>
                        <a onclick="return confirm('Вы уверены, что хотите удалить альбом?');" class="but new_img"
                           href="/gallery/delete/<?=$item->id?>">Удалить альбом</a>
                <? endif; ?>
                    </div>

                </div>
                <? endforeach; endif; ?>
            </div>

        </div>
    </div>
</div>


    <? if(!$is_guest): ?>
<div class="ui-widget popup" id="new_album" data-open="<?=$model->getErrors() ? 1 : 0?>" data-title="Новый альбом"
     data-width="500">
    <? $this->renderPartial('//gallery/_album_form', array('model' => $model)); ?>
</div>

<? endif; ?>
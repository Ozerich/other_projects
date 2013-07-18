<div id="page_teeth" class="page page-block page-block-yellow">
	<div class="page-block page-block-blue">
    
        <div class="top-bg"></div>


        <div class="width">

	<?=$this->renderPartial('//other_baby_header'); ?>
            <div class="right-banner">
                <a href="/page/services" class="print-photo">Печать фотодневника</a>
                <div class="right-banner-image"><?=Page::model()->find("alias='right_banner'")->text; ?></div>
            </div>

            <p class="page-description">Появление первого зубика у малыша – одно из самых ожидаемых, волнительных и радостных событий для всех членов семьи. Ваш малыш взрослеет. Обычно зубы прорезываются, когда ребёнку исполняется полгода. Но время появления зубов сильно варьируется в зависимости от особенностей организма малыша и его родителей. С помощью электронного дневника вы можете быстро внести даты появления зубов вашего малыша.</p>
        </div>

    </div>

    <div class="width">


        <div class="name">
            <h2>Зубы</h2>
            <? if (!$is_guest): ?>      <a class="but popup-link" data-popup="new_teeth">Редактировать</a><? endif; ?>
        </div>


        <div class="teeth-map">

            <ul class="params left">
                <? $count = 0; foreach (BabyTooth::model()->attributeLabels() as $param => $label): ?>
                <? if (strpos($param, 'tooth') === false) continue;
                $count++;
                if ($count % 2):?>
                    <li class="tooth-<?=$count?>">
                        <? if ($is_guest): ?>
                        <a href="#" onclick="return false"><?=$label?></a>
                        <? else: ?>
                        <a href="/tooth/<?=$count?>" class="ajax-popup-link" data-title="Редактировать зуб"
                           data-width="250"><?=$label?></a>
                        <? endif; ?>
                        <span><?=$model->$param ? $model->$param : 'Пока не появились'?></span>
                    </li>
                    <? endif; ?>
                <? endforeach; ?>
            </ul>

            <div class="map"></div>

            <ul class="params right">
                <? $count = 0; foreach (BabyTooth::model()->attributeLabels() as $param => $label): ?>
                <? if (strpos($param, 'tooth') === false) continue;
                $count++;
                if ($count % 2 == 0):?>
                    <li class="tooth-<?=$count?>">
                        <? if ($is_guest): ?>
                        <a href="#" onclick="return false"><?=$label?></a>
                        <? else: ?>
                        <a href="/tooth/<?=$count?>" class="ajax-popup-link" data-title="Редактировать зуб"
                           data-width="250"><?=$label?></a>
                        <? endif; ?>
                        <span><?=$model->$param ? $model->$param : 'Пока не появились'?></span>
                    </li>
                    <? endif; ?>
                <? endforeach; ?>
            </ul>
        </div>


    </div>

</div>


<? if (!$is_guest): ?>
<div class="ui-widget popup" id="new_teeth" data-open="<?=$model->getErrors() ? 1 : 0?>" data-title="Редактировать"
     data-width="600">
    <? $this->renderPartial('//growth/_teeth_form', array('model' => $model)); ?>
</div>

<? endif; ?>
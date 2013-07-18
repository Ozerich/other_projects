<div id="page_height" class="page page-block page-block-yellow">
	<div class="page-block page-block-blue">
        <div class="top-bg"></div>


        <div class="width">

	<?=$this->renderPartial('//other_baby_header'); ?>
    
            <div class="right-banner">
                <a href="/page/services" class="print-photo">Печать фотодневника</a>
                <div class="right-banner-image"><?=Page::model()->find("alias='right_banner'")->text; ?></div>
            </div>

            <p class="page-description">
			
						С помощью графиков вы сможете следить за тем, как малыш набирает вес и рост. На протяжении первых нескольких месяцев ребенок будет очень быстро расти и набирать вес. После года рост замедлится. <br/><br/>
		<b>График роста</b><br/>
Введите рост малыша (кнопка редактировать) напротив его возраста. График обновляется автоматически после ввода показаний. Единицы измерения – сантиметры и месяцы.
</p>
			
			</p>
        </div>

    </div>

    <div class="width">

        <div class="name">
            <h2>Рост</h2>
            <? if(!$is_guest):?>   <a class="but popup-link" data-popup="new_height">Редактировать</a><?endif; ?>
        </div>

        <div class="chart">
            <div class="loading"></div>
            <div id="chart" data-url="/height/chart/<?=$baby_id?>"></div>
        </div>


    </div>

</div>


<? if(!$is_guest):?>

<div class="ui-widget popup" id="new_height" data-open="<?=$model->getErrors() ? 1 : 0?>" data-title="Редактировать"
     data-width="250">
    <? $this->renderPartial('//growth/_height_form', array('model' => $model)); ?>
</div><?endif; ?>
<div id="page_diary">

    <div class="page-block page-block-blue">
        <div class="top-bg"></div>
        <div class="width">

		<?=$this->renderPartial('//other_baby_header'); ?>
            <div class="right-banner">
                <a href="/page/services" class="print-photo">Печать фотодневника</a>
                <div class="right-banner-image"><?=Page::model()->find("alias='right_banner'")->text; ?></div>
            </div>

            <? if (!$is_guest): ?>
            <a href="#" class="link plus popup-link" id="new_message_button" data-popup="new_message">Новое
                сообщение</a>
            <? endif; ?>
            <h1 class="page-name">Дневник</h1>

            <? /*if (count($items) > 0): ?>
            <div class="diary-list">
                <? $this->renderPartial('_item', array('item' => $items[0], 'is_guest' => $is_guest)); ?>
            </div>
            <? endif;*/ ?>

        </div>


	
	<?
	
	$this->widget('zii.widgets.CListView', array(
    'dataProvider'=> new CArrayDataProvider($items),
	'ajaxUpdate' => false,
    'itemView'=>'_item',   
	'viewData' => array( 'is_guest' => $is_guest),
	'template' => "{pager}\n{items}\n{pager}",
	'emptyText' => 'Нет записей',
	'pager' => array(
		'header' => ''
	),
));
	
	?>
	    </div>
<? /*

    <? if (count($items) > 1): ?>

    <div class="page-block page-block-yellow">
        <div class="width">

            <div class="diary-list">
                <? $this->renderPartial('_item', array('data' => $items[1], 'is_guest' => $is_guest)); ?>
				
				
				
            </div>

        </div>

    </div>

    <? endif; ?>


    <? if (count($items) > 2): ?>

    <div class="page-block page-block-pink">
        <div class="width">

            <div class="diary-list">
                <? $this->renderPartial('_item', array('data' => $items[2], 'is_guest' => $is_guest)); ?>
            </div>

        </div>

    </div>

    <? endif; ?>


    <? if (count($items) > 3): ?>

    <div class="page-block page-block-yellow">

        <div class="width">

            <div class="diary-list">
                <? for ($i = 3; $i < count($items); $i++): ?>
                <? $this->renderPartial('_item', array('dat' => $items[$i], 'is_guest' => $is_guest)); ?>
                <? endfor; ?>
            </div>

        </div>

    </div>

    <? endif; ?>
	*/?>



<? if (!$is_guest): ?>
<div class="ui-widget popup" id="new_message" data-open="<?=$model->getErrors() ? 1 : 0?>" data-title="Новое собщение"
     data-width="800">
    <? $this->renderPartial('//diary/_form', array('model' => $model)); ?>
</div>

<div class="ui-widget popup" id="milestones_window" data-title="Этапы" data-width="700">
    <div id="tabs_wrapper">
        <div id="tabs_container">
            <ul id="tabs">
                <? foreach (DiaryMilestoneTab::model()->findAll() as $ind => $tab): ?>
                <li <?=$ind == 0 ? 'class="active"' : '' ?>><a href="#tab<?=($ind + 1)?>"><?=$tab->name?></a></li>
                <? endforeach; ?>
                <li><a href="#tab_custom">Другой</a></li>
            </ul>
        </div>
        <div id="tabs_content_container">
            <? foreach (DiaryMilestoneTab::model()->findAll() as $ind => $tab): ?>
            <div id="tab<?=($ind + 1)?>" style="display: <?=$ind == 0 ? 'block' : 'none'?>" class="tab_content">
                <? if (count($tab->milestones) <= 10): ?>

                <div class="one-column">
                    <? foreach ($tab->milestones as $milestone): ?>
                    <label class="milestone" for="milestone_<?=$milestone->id?>">
                        <input data-id="<?=$milestone->id?>" type="checkbox" id="milestone_<?=$milestone->id?>"/>
                        <?=$milestone->name?>
                    </label>
                    <? endforeach; ?>
                </div>

                <? else: ?>
                <div class="two-column">
                    <div class="left">
                        <? $i = -1;
                        while ($i++ < count($tab->milestones) / 2): ?>

                            <label class="milestone" for="milestone_<?=$tab->milestones[$i]->id?>">
                                <input data-id="<?=$tab->milestones[$i]->id?>" type="checkbox"
                                       id="milestone_<?=$tab->milestones[$i]->id?>"/>
                                <?=$tab->milestones[$i]->name?>
                            </label>

                            <? endwhile; ?>

                    </div>
                    <div class="right">
                        <? while ($i++ < count($tab->milestones) - 1): ?>

                        <label class="milestone" for="milestone_<?=$tab->milestones[$i]->id?>">
                            <input data-id="<?=$tab->milestones[$i]->id?>" type="checkbox"
                                   id="milestone_<?=$tab->milestones[$i]->id?>"/>
                            <?=$tab->milestones[$i]->name?>
                        </label>

                        <? endwhile; ?>
                    </div>
                </div>
                <? endif; ?>
                <br clear="all"/>

            </div>
            <? endforeach; ?>

            <div id="tab_custom" style="display: none" class="tab_content">
                <label>Создайте свой этап или событие:</label>
                <input id="custom_milestone" type="text"/>
            </div>
        </div>
    </div>

    <div class="buttons">
        <button id="submit_milestone">Сохранить</button>
        <button class="popup-close">Закрыть</button>
    </div>
</div>
<? endif; ?>

<div class="ui-widget popup" id="new_comment" data-open="<?=$comment_model->getErrors() ? 1 : 0?>"
     data-title="Новый комментарий" data-width="500">
    <? $this->renderPartial('//diary/_comment_form', array('model' => $comment_model, 'diary_id' => $model->id)); ?>
</div>

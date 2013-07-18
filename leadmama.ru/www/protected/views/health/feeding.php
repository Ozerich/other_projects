<div id="page_feeding" class="page page-block page-block-yellow">

    <div class="page-block page-block-blue">
        <div class="top-bg"></div>


        <div class="width">

		<?=$this->renderPartial('//other_baby_header'); ?>
            <div class="right-banner">
                <a href="/page/services" class="print-photo">Печать фотодневника</a>
                <div class="right-banner-image"><?=Page::model()->find("alias='right_banner'")->text; ?></div>
            </div>

            <p class="page-description">В этом разделе вы можете записывать заметки про кормление вашего малыша, начиная с рождения. С первых дней вы можете рассказать про вид вскармливания (естественное, смешанное, искусственное) и его режим (по часам, по требованию, свободное). Малыш растет и вы уже можете написать про первый прикорм, укажите дату и возраст, что, как, сколько, реакция вашего малыша, подробности процесса и последствия. </p>
        </div>

    </div>

    <div class="width sidebar-width">

        <div class="name name2">
            <h2>Кормление</h2>
            <? if (!$is_guest): ?> <a href="#" class="but add popup-link"
                                      data-popup="new_feeding">Добавить</a><? endif;?>
        </div>


        <div class="feeding-list text-bg">
            <? if (empty($items)): ?>
            <p class="no-feedings">Нет записей</p>
            <? else: foreach ($items as $item): ?>
            <div class="feeding-item">
                <span class="date"><?=$item->date?></span>

                <p class="text"><?=$item->text?></p>
                <? if (!$is_guest): ?>    <a href="/feeding/edit/<?=$item->id?>" class="but edit-icon ajax-popup-link"
                                             data-title="Редактировать кормление" data-width="500">Редактировать</a>
                <a href="/feeding/delete/<?=$item->id?>" onclick="return confirm('Вы уверены,что хотите удалить?');"
                   class="but">Удалить</a>
                <? endif; ?>
            </div>
            <? endforeach; endif; ?>
        </div>

    </div>

</div>

<? if (!$is_guest): ?>
<div class="ui-widget popup" id="new_feeding" data-open="<?=$model->getErrors() ? 1 : 0?>"
     data-title="Добавить кормление" data-width="450">
    <? $this->renderPartial('//health/_feeding_form', array('model' => $model)); ?>
</div>
<? endif; ?>
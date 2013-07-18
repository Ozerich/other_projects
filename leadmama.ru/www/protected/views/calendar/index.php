<div id="page_calendar" class="page page-block page-block-yellow">

    <div class="page-block page-block-blue">
        <div class="top-bg"></div>


        <div class="width">

		<?=$this->renderPartial('//other_baby_header'); ?>
            <div class="right-banner">
                <a href="/page/services" class="print-photo">Печать фотодневника</a>
                <div class="right-banner-image"><?=Page::model()->find("alias='right_banner'")->text; ?></div>
            </div>

            <p class="page-description">Используйте календарь, чтобы наглядно увидеть главные события в жизни малыша.</p>
        </div>

    </div>

    <div class="width sidebar-width">

        <div class="name">
            <h2>График роста</h2>
            <? if (!$is_guest): ?><a class="but popup-link" data-popup="add_calendar">Добавить</a><? endif; ?>
        </div>


        <div class="table-graph">
            <div class="calendar">
                <em class="month-name"></em>
                <ul class="list" id="days">
                    <li class="odd"><span class="data"></span></li>
                    <? for ($i = 1; $i <= 48; $i++): $start = $i % 2 ? 150 : 75; ?>
                    <li <?=($i % 2 === 0) ? 'class="odd"' : ''?>>
                        <span class="data"><?=$i?> месяц</span>
                        <? foreach ($events[$i] as $event): ?>
                        <div class="item" style="top:<?=$start?>px; left:6px;">
                            <img src="/images/img5.png" alt=""/>
                            <strong><?=$event?></strong>
                        </div>
                        <? $start += 150; endforeach; ?>
                    </li>
                    <? endfor; ?>
                    <li><span class="data"></span></li>
                </ul>
            </div>
        </div>

    </div>
</div>
<? if (!$is_guest): ?>
<div class="ui-widget popup" id="add_calendar" data-title="Добавление записи" data-width="300">
    <form class="popup-form" action="/calendar/" method="POST">
        <div class="row">
            <div class="param double">
                <label for="select">Тип записи:</label>
                <select id="select" name="type">
                    <option value="diary">Запись в дневнике</option>
                    <option value="height">Запись о росте</option>
                    <option value="weight">Запись о весе</option>
                    <option value="teeth">Запись о зубе</option>
                </select>
            </div>
        </div>
        <div class="row submit-row">
            <?php echo CHtml::submitButton('Перейти'); ?>
        </div>
    </form>

</div><? endif; ?>
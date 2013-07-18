<div id="page_medicine" class="page page-block page-block-yellow">

    <div class="page-block page-block-blue">
        <div class="top-bg"></div>


        <div class="width">

		<?=$this->renderPartial('//other_baby_header'); ?>
            <div class="right-banner">
                <a href="/page/services" class="print-photo">Печать фотодневника</a>
                <div class="right-banner-image"><?=Page::model()->find("alias='right_banner'")->text; ?></div>
            </div>

            <p class="page-description">
			
			В этом разделе вы можете вести заметки о здоровье малыша.  
			В разделе <b>Общая информация</b> вы можете указать адрес и телефон поликлиники, различные телефоны медицинских учреждений. Также можно вносить записи про педиатра, контактные данные и часы приема. 
			<b>Медицинские записи</b> вы можете использовать для описания болезней малыша – начало болезни, осмотр врача, назначения (названия лекарств, дозы и правила приема). 
			Раздел <b>Прививки</b> позволяет записывать информацию о плановых прививках малыша, от какой болезни, название, серия и номер дозы. Запишите подробности о том, как ребенок перенес прививку и когда необходимо сделать следующую.
			
			</p>
        </div>

    </div>


    <div class="width">


        <div class="info-block">

            <div class="name name2">
                <h2>Общая информация</h2>
                <? if (!$is_guest): ?>
                <a href="/user/medicine_info" class="but edit-icon ajax-popup-link"
                   data-title="Редактировать общую информацию" data-width="500">Редактировать</a>
                <? endif; ?>
            </div>

            <div class="text-bg text">
                <?=Yii::app()->user->getBaby()->medicine_info;?>
            </div>
        </div>
    </div>

    <div class="page-block page-block-pink medical-records-row">
        <div class="width">

            <div class="medical-records-block">
                <div class="name name2">
                    <h2>Медицинские записи</h2>
                    <? if (!$is_guest): ?>  <a href="#" class="but add popup-link"
                                               data-popup="new_record">Добавить</a> <? endif; ?>
                </div>

                <div class="record-list text-bg">
                    <? if (empty($records)): ?>
                    <p class="no-records">Нет записей</p>
                    <? else: foreach ($records as $record): ?>
                    <div class="record-item">
                        <span class="date"><?=$record->date?></span>

                        <p class="text"><?=$record->text?></p>
                        <? if (!$is_guest): ?>    <a href="/medicine/edit/<?=$record->id?>"
                                                     class="but edit-icon ajax-popup-link"
                                                     data-title="Редактировать запись"
                                                     data-width="500">Редактировать</a>
                        <a href="/medicine/delete/<?=$record->id?>"
                           onclick="return confirm('Вы уверены,что хотите удалить?');"
                           class="but">Удалить</a>
                        <? endif; ?>
                    </div>
                    <? endforeach; endif; ?>
                </div>
            </div>

        </div>
    </div>

    <div class="width">

        <div class="vaccinations-block">
            <div class="name name2">
                <h2>Прививки</h2>
                <? if (!$is_guest): ?>      <a href="#" class="but add popup-link"
                                               data-popup="new_vaccination">Добавить</a> <? endif; ?>
            </div>

        <div class="vaccinations-list">
            <? if (empty($vaccinations)): ?>
            <p class="no-vaccinations">Нет записей</p>
            <? else: ?>
        <table>
            <thead>
            <tr>
                <th>Дата</th>
                <th>Название вакцины</th>
                <th>Подробности</th>
                <? if (!$is_guest): ?>
                <th class="column-actions">Действия</th><? endif; ?>
            </tr>
            </thead>
            <? foreach ($vaccinations as $vaccination): ?>
                <tr>
                    <td><?=$vaccination->date?></td>
                    <td><?=$vaccination->name?></td>
                    <td><?=$vaccination->description?></td>
                    <? if (!$is_guest): ?>
                    <td class="column-actions">
                        <a href="/vaccination/edit/<?=$vaccination->id?>" class="but edit-icon ajax-popup-link"
                           data-title="Редактировать прививку" data-width="500">Редактировать</a>
                        <a href="/vaccination/delete/<?=$vaccination->id?>"
                           onclick="return confirm('Вы уверены,что хотите удалить?');"
                           class="but">Удалить</a>
                    </td><? endif; ?>
                </tr>

            </div>
            <? endforeach; ?>
            </table>
            <?endif; ?>
        </div>
    </div>
</div>
</div>
<? if (!$is_guest): ?>
<div class="ui-widget popup" id="new_record" data-open="<?=$record_model->getErrors() ? 1 : 0?>"
     data-title="Добавить медецинскую запись" data-width="450">
    <? $this->renderPartial('//health/_record_form', array('model' => $record_model)); ?>
</div>

<div class="ui-widget popup" id="new_vaccination" data-open="<?=$vaccination_model->getErrors() ? 1 : 0?>"
     data-title="Добавить прививку" data-width="450">
    <? $this->renderPartial('//health/_vaccination_form', array('model' => $vaccination_model)); ?>
</div>
<? endif; ?>

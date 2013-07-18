<div class="page-header">

    <span><?=Yii::app()->user->model()->name?></span>

    <div class="page-header-right">
        <? if (Yii::app()->user->model()->package_name !== null): ?>
        <a href="/item" class="ajax button" id="btn_new_advert"><img src="/images/button-img2.gif" alt="">Новое
            объявление</a>
        <? else: ?>
        <a href="#buy_package_form" class="button popup-button"><img src="/images/button-img2.gif" alt="">Купить
            пакет</a>
        <? endif; ?>
    </div>
</div>

<div class="left-col">
    <dl>
        <? if (Yii::app()->user->model()->package_name !== null): ?>
        <dt>Осталось объявлений:</dt>
        <dd><?=Yii::app()->user->model()->package_count_remaining?></dd>
        <? endif; ?>
    </dl>

    <ul class="project" id="advert_tree">

        <li class="folder" data-id="0"><a href="#">Без папки</a><i class="loader"></i></li>
        <? if ($folders) foreach ($folders as $folder): ?>
        <li class="folder" data-id="<?=$folder['id']?>"><a href="#"><?=$folder['name']?></a><i class="loader"></i>
            <ul style="display: none">

                <? foreach ($folder['children'] as $child): ?>
                <li class="folder" data-id="<?=$child['id']?>"><a href="#"><?=$child['name']?></a><i class="loader"></i>
                </li>
                <? endforeach; ?>

                <li>
                    <input type="text" placeholder="Создать папку" class="dob"/>
                    <span class="plus"></span>
                    <i class="loader"></i>
                </li>

            </ul>
        </li>
        <? endforeach; ?>
        <li class="new-folder-line">
            <input type="text" placeholder="Создать папку" class="dob"/>
            <span class="plus"></span>
            <i class="loader"></i>
        </li>
    </ul>

</div>

<div class="right-col">
    <div id="folder_content_loading" class="page-loader-background"></div>
    <div id="folder_content">

        <div class="folder-list">

        </div>

        <div class="folder-move-block">
            <select>
                <option value="-">Выберите папку...</option>
                <option value="0">Без папки</option>
                <? if ($folders) foreach ($folders as $folder): ?>
                <option value="<?=$folder['id']?>"><?=$folder['name']?></option>
                <? foreach ($folder['children'] as $child): ?>
                    <option value="<?=$child['id']?>"> ---- <?=$child['name']?></option>
                <? endforeach; ?>
                <? endforeach; ?>
            </select>
            <button class="button-new" id="folder_move_submit">Переместить</button>
        </div>
    </div>
</div>

<? if (Yii::app()->user->model()->package_name === null): ?>
<div class="popup" id="buy_package_form">
    <a href="#" class="close"></a>
    <span class="h2">Купить пакет</span></span>

    <form action="#">

        <div class="param">
            <label>Пакет:</label>
            <select class="select">
                <? foreach (Package::model()->findAll() as $package): ?>
                <option data-count="<?=$package->count?>" data-types="<?=$package->types_text?>"
                        data-period="<?=$package->days?> дней" data-price="<?=$package->price?> $"
                        value="<?=$package->id?>"><?=$package->name?></option>
                <? endforeach; ?>
            </select>
        </div>

        <div class="param param-count">
            <label>Количество объявлений:</label>
            <span></span>
        </div>

        <div class="param param-types">
            <label>Доступные типы объявлений:</label>
            <span></span>
        </div>

        <div class="param param-period">
            <label>Период действия объявлений:</label>
            <span></span>
        </div>

        <div class="param param-price">
            <label>Цена пакета:</label>
            <span></span>
        </div>

        <div class="param">
            <button class="button-new" id="package_buy_submit">Купить</button>
            <div class="loader"></div>
            <div class="error">Недостаточно средств</div>
        </div>
    </form>
</div>

<script>
    $('#buy_package_form').find('.select').live('change',function () {
        var $option = $(this).find('option:selected');

        $(['types', 'period', 'price', 'count']).each(function () {
            $('#buy_package_form').find('.param.param-' + this.toString()).find('span').html($option.data(this.toString()));
        });
    }).trigger('change');
</script>

<? endif; ?>

<script>
    Folders.loadFolder(<?=$selected_folder?>, true);
</script>
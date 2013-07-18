<tr>
    <td><span><?=$data->id?></span></td>
    <td>21.12.2012</td>
    <td><a class="name ajax-popup-button" href="/companies/item/<?=$data->id?>"><?=$data->name?></a></td>
    <td><?=$data->balance?>$</td>
    <td><?=Company::$forms[$data->form]?></td>
    <td>
        <? if(!empty($data->package_name)): ?>
        <a href="#" class="grey"><?=$data->package_name?></a>
        <? else: ?>
            Не активирован
        <? endif; ?>
    </td>
    <td><?=Company::$areas[$data->area]?></td>

    <td>
        <? if($data->status == 'new'): ?>
            <span class="red">Новая</span>
        <? elseif($data->status == 'disabled'): ?>
            <span class="red">Отключена</span>
        <? elseif($data->status == 'active'): ?>
            <span class="green">Активна</span>
        <? else: ?>
            <span>Неизвестный</span>
        <? endif; ?>
    </td>

    <td>
        <? if($data->status == 'new'): ?>
            <a href="#" class="button">Принять</a>
            <a href="#" class="link">Отклонить</a>
        <? elseif($data->status == 'disabled'): ?>
            <a href="#" class="button">Включить</a>
            <a href="#" class="link">Удалить</a>
        <? elseif($data->status == 'active'): ?>
            <a href="#" class="link">Статистика</a>
            <a href="#" class="link">Отключить</a>
        <? endif; ?>
    </td>
</tr>
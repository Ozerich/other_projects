<tr>
    <td><span><?=$data->id?></span></td>
    <td><?=$data->company->name?></td>
    <td><?=$data->type_text?></td>

    <td>
        <a href="/item/view/<?=$data->id?>" class="ajax button">Просмотр</a>
        <a href="/item/<?=$data->id?>" class="ajax button">Редактировать</a>
        <a href="#" class="link">Удалить</a>
    </td>
</tr>
<div id="news_page">
    <table class="admin-list">
        <thead>
        <tr>
            <th class="column-id">ID</th>
            <th class="column-url">URL</th>
            <th class="column-title">Заголовок</th>
            <th class="column-actions">Действия</th>
        </tr>
        </thead>
        <tbody>
        <? if (empty($items)): ?>
        <tr class="empty">
            <td colspan="4">Нету страниц</td>
        </tr>
            <? else: foreach ($items as $item): ?>
        <tr>
            <td class="column-id"><?=$item->id?></td>
            <td class="column-url"><?=$item->alias?></td>
            <td class="column-title"><?=$item->title?></td>
            <td class="column-actions">
                <a href="/admin/pages/item/id/<?=$item->id?>" class="edit-btn btn"></a>
                <a href="<?=$item->getLink();?>" class="view-btn btn"></a>
                <a onclick="return confirm('Вы уверены, что хотите удалить страницу?');"
                   href="/admin/pages/delete/id/<?=$item->id?>" class="delete-btn btn"></a>
            </td>
        </tr>
            <? endforeach; endif; ?>
        </tbody>
    </table>
</div>

<?
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_table_item',

    'template' => "<table>
    <tbody>
    <tr>
        <th>ID</th>
        <th>Компания</th>
        <th>Тип объявления</th>
        <th>Действия</th>
    </tr>{items}

    </tbody>
</table>\n{summary}\n{pager}",

    'summaryText' => '<p class="summary"><span>Показано</span> {start}-{end} объявлений из {count}</p>'
));
?>
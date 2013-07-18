<div id="news_page">

			<? $this->widget('zii.widgets.CListView', array(
					'dataProvider'=>$dataProvider,
					'itemView'=>'_user_row',
					'template' => '    <table class="admin-list">
        <thead>
        <tr>
            <th class="column-id">ID</th>
            <th class="column-url">Email</th>
            <th class="column-title">Логин</th>
            <th class="column-actions">Действия</th>
        </tr>
        </thead>
        <tbody>{items}        </tbody>
    </table><br/>
{pager}'));			?>
</div>

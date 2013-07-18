<tr>
            <td class="column-id"><?=$data->id?></td>
            <td class="column-url"><?=$data->email?></td>
            <td class="column-title"><?=$data->login?></td>
            <td class="column-actions">
				<? if($data->baby): ?>
				<a target="_blank" href="/diary/<?=$data->baby->id?>" class="diary-btn btn"></a>
				<? endif; ?> 
				<a href="/admin/users/edit/id/<?=$data->id?>" class="edit-btn btn"></a>
                <a onclick="return confirm('Вы уверены, что хотите удалить пользователя?');"
                   href="/admin/users/delete/id/<?=$data->id?>" class="delete-btn btn"></a>
			</td>

</td>
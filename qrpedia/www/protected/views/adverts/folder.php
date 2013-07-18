<? if ($items): ?>
<div class="folder">
    <div class="folder-title">
        <span class="h3 folder-name"><?=$folder ? $folder->name : 'Без папки'?></span>

        <? if ($folder): ?>
        <input type="text" class="new-folder-name" style="display: none" value="<?=$folder->name?>"/>
        <a href="#" class="icon icon-folder-save" style="display: none"></a>

        <a href="#" class="icon icon-folder-edit"></a>
        <a href="#" class="icon icon-folder-delete"></a>
        <? endif; ?>
    </div>

    <table>
        <tbody>
        <tr>
            <th class="checkbox-cell"></th>
            <th class="th1"></th>
            <th class="th2"></th>
            <th class="th3"></th>
        </tr>

            <? foreach ($items as $item): ?>
            <? $this->renderPartial('_advert', array('model' => $item)); ?>
            <? endforeach; ?>
        </tbody>
    </table>
</div>
<? endif; ?>
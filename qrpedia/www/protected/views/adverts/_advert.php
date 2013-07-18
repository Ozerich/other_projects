<tr class="even">
    <td class="checkbox-cell"><input data-id="<?=$model->id?>" type="checkbox"/></td>
    <td><img class="qr-image" src="<?=$model->getQRCodeUrl();?>" alt=""></td>
    <td>
        <a href="/adverts/<?=$model->id?>" class="h4">ID<?=$model->id?></a>
        <dl>
            <dt>Тип объявления:</dt>
            <dd><?=$model->type_text?></dd>
            <dt>Статус:</dt>
            <dd>активно</dd>
        </dl>
        <a href="<?=Yii::app()->params['qrcodes_dir'].$model->qrfile?>" target="_blank" class="but">Скачать QR-код</a>
    </td>
    <td>
        <div class="links">
            <div>
                <span><a href="/item/<?=$model->id?>">Изменить</a></span>
                <span><a href="#">Статистика</a></span>
            </div>
        </div>
    </td>
</tr>
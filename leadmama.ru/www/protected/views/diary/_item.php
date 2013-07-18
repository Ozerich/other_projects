
    <div class="page-block page-block-<?=$index == 2 ? 'pink' : ($index == 0 ? 'blue' : 'yellow')?>">
        <div class="width">
            <div class="diary-list">



<? $date_count = $data->getDateCount(); ?>
<div class="diary-item" data-id="<?=$data->id?>">

    <div class="left">

        <i class="star"></i>

        <span class="date"><?=$data->date?></span>

        <div class="date-stars-wr">

            <div class="date-stars">

                <div class="day"><span><?=$date_count['years'];?></span> <em>г</em></div>
                <div class="month"><span><?=$date_count['months'];?></span> <em>мес</em></div>
                <div class="year"><span><?=$date_count['days'];?></span> <em>дн</em></div>

            </div>

        </div>

    </div>

    <div class="item-content">

        <? if (!empty($data->photo)): ?>
        <a href="<?=$data->getPhoto();?>"  class="highslide" onclick="return hs.expand(this)"><img class="item-photo" src="<?=$data->getPhoto();?>"/></a>
        <? endif; ?>

        <h3><a href="/diary/item/<?=$data->id?>"><?=$data->title?></a></h3>

        <? if ($data->milestones): ?>
        <p class="milestones">Этапы: </p>

        <ul class="milestones-list">
            <? foreach ($data->milestones_text as $milestone): ?>
            <li><?=$milestone?></li>
            <? endforeach; ?>
            <? if ($data->custom_milestone): ?>
            <li><?=$data->custom_milestone?></li>
            <? endif; ?>
        </ul>
        <? endif; ?>

        <p><?=$data->text?></p>

        <ul class="link-list">
            <li><a href="#">Опубликовал <?=$data->baby->user->email?></a></li>
            <li><a href="/diary/item/<?=$data->id?>"><?=count($data->comments)?> Комментариев</a></li>
        </ul>

        <a href="/diary/comment/<?=$data->id?>" class="but popup-link" data-popup="new_comment">Новый
            комментарий</a>
      <? if(!$is_guest): ?>
        <a href="/diary/edit/<?=$data->id?>" class="but edit-icon ajax-popup-link"
           data-title="Редактировать сообщение в дневнике" data-width="800">Редактировать</a>
        <a href="/diary/delete/<?=$data->id?>" class="but edit-icon"
           onclick="return confirm('Вы уверены, что хотите удалить запись в дневнике')">Удалить</a>
      <? endif; ?>

    </div>

</div>




</div></div></div>
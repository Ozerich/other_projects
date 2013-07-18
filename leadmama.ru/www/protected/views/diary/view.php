<div id="page_diary">

    <div class="page-block page-block-blue">
        <div class="top-bg"></div>
        <div class="width">

		<?=$this->renderPartial('//other_baby_header'); ?>
            <div class="right-banner">
                <a href="/page/services" class="print-photo">Печать фотодневника</a>
                <div class="right-banner-image"><?=Page::model()->find("alias='right_banner'")->text; ?></div>
            </div>

            <h3><?=$model->title?></h3>
        <? if ($model->photo): ?>
        <div class="photo">
			<a href="<?=$model->getPhoto();?>"  class="highslide" onclick="return hs.expand(this)"><img class="item-photo" src="<?=$model->getPhoto();?>"/></a>
		</div>
		<? endif; ?>
        <p><?=$model->text?></p>


    <a class="but new-comment popup-link" href="#" data-popup="new_comment">Добавить комментарий</a>

    <div class="text-bg comments-list">
        <? if(empty($model->comments)): ?>
            <p class="no-comments">Нет комментариев</p>
        <? else: ?>
            <? foreach($model->comments as $comment): ?>
                <div data-id="<?=$comment->id?>" class="comment-item">
                    <span class="date"><?=$comment->datetime?></span>
                    <p><?=$comment->text?></p>

                    <? if($comment->user_id == Yii::app()->user->id): ?>
                        <a class="but" href="/diary/delete_comment/<?=$comment->id?>" onclick="return confirm('Вы действительно хотите удалить комментарий?');">Удалить</a>
                    <? endif; ?>
                </div>
            <? endforeach; ?>
        <? endif; ?>
    </div>
</div>
</div>
</div>


<div class="ui-widget popup" id="new_comment" data-open="<?=$comment_model->getErrors() ? 1 : 0?>" data-title="Новый комментарий" data-width="500">
    <? $this->renderPartial('//diary/_comment_form', array('model' => $comment_model, 'diary_id' => $model->id)); ?>
</div>
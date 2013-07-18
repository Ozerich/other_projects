<div id="page_photo" class="page page-block page-block-yellow">
	<div class="page-block page-block-blue">
    
        <div class="width ">

<?=$this->renderPartial('//other_baby_header'); ?>
            <div class="name top-buttons">
                <? if ($prev !== null): ?><a class="but prev"
                                             href="/gallery/photo/<?=$prev?>">Предыдущая</a><? endif; ?>
                <? if (!$is_guest): ?>
                <a class="but edit popup-link" data-popup="edit_photo" href="/gallery/photo/<?=$model->id?>">Редактировать</a>
                <? endif; ?>
                <? if ($next !== null): ?><a class="but next" href="/gallery/photo/<?=$next?>">Следующая</a><? endif; ?>
            </div>

            <div class="photo">
                <img src="<?=$model->getPhoto();?>"/>
            </div>

            <div class="name">
                <h2>Комментарии</h2>
                <a class="but popup-link" data-popup="new_comment" href="#">Добавить комментарий</a>
                <a class="but next_img" href="/gallery/like/<?=$model->id?>">Нравится (<?=$model->likes?>)</a>
            </div>

            <div class="comments-list">
                <? if (empty($model->comments)): ?>
                <p class="no-comments">Нет комментариев</p>
                <? else: foreach ($model->comments as $comment): ?>
                <div class="comment">
                    <div class="comment-header">
                        <span class="user-name"><?=$comment->user->login?></span>
                        <span class="datetime"><?=$comment->datetime?></span>
                        <br clear="all"/>
                    </div>
                    <p class="comment-text"><?=$comment->text?></p>
                </div>
                <? endforeach; endif; ?>
            </div>


        </div>
    </div>
</div>

<div class="ui-widget popup" id="new_comment" data-open="<?=$comment_model->getErrors() ? 1 : 0?>"
     data-title="Новый комментарий" data-width="500">
    <? $this->renderPartial('//gallery/_comment_form', array('id' => $model->id, 'model' => $comment_model)); ?>
</div>

<? if (!$is_guest): ?>
<div class="ui-widget popup" id="edit_photo" data-open="<?=$model->getErrors() ? 1 : 0?>" data-title="Изменить картинку"
     data-width="300">
    <? $this->renderPartial('//gallery/_edit_photo', array('model' => $model)); ?>
</div>

<? endif; ?>
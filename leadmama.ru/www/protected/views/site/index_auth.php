<div class="page-block page-block-blue">
    <div class="top-bg"></div>

    <div class="width" id="page_dashboard">

			<? if(Yii::app()->user->model()->type == 1): ?>
        <h1 class="page-name">Ваш малыш</h1>

        <div class="child-row">

            <div class="ramka-photo">
                <? if (Yii::app()->user->hasChild()): ?><a href="/baby/">       <? endif; ?>
                <div class="pic">
                    <img src="<?=Yii::app()->user->hasChild() ? Yii::app()->user->getBaby()->getPhoto() : Yii::app()->params['nophoto_baby']?>"
                         alt="">
                    <span class="ramka"></span>
                </div>
                <? if (Yii::app()->user->hasChild()): ?>  </a>   <? endif; ?>
            </div>

            <? if (Yii::app()->user->hasChild()): ?>
            <div class="info">
                <label>Имя: </label>
                <span><?=Yii::app()->user->getBaby()->name?></span>
                <label>Дата рождения: </label>
                <span><?=Yii::app()->user->getBaby()->birth_date?></span>
                <a href="#" class="open-access popup-link" data-popup="open_access"></a>
            </div>


            <div class="buttons">
                <a href="/diary/" class="button diary-button">Дневник</a>
                <a href="/gallery/" class="button gallery-button">Галерея</a>
                <a href="/baby/" class="button baby-button">О малыше</a>
                <a href="/growth/" class="button growth-button">Развитие</a>
                <a href="/health/" class="button health-button">Здоровье</a>
                <a href="/calendar/" class="button height-button">Рост</a>

                <a href="/page/services" class="services-button">
                    <img src="/images/img12.jpg" alt="">
                    <span class="text">Печать фотодневника</span>
                </a>

            </div>

            <? else: ?>

            <p class="no-child">
                Вы не добавили информацию о вашем ребенке. Пройдите по ссылке для добавление ребенка
                <a href="/baby/update/">Добавить ребенка</a>
            </p><? endif; ?>
			
			 <aside class="news-block">

            <div class="news-top-bg">

                <div class="bg-sidebar">
                    <em class="left-bg"></em>
                    <em class="right-bg"></em>

                    <div class="news-content">
                        <h3 class="block-title">Новости</h3>

                        <ul class="news">
						
							<? foreach($news as $news_item): ?>
						
                            <li>
                                <? if($news_item->getImage()): ?>
									<a href="/news/<?=$news_item->id?>"><img src="<?=$news_item->getImage();?>"></a>
								<? endif; ?>

                                <div>
                                    <a class="news-title" href="/news/<?=$news_item->id?>"><?=$news_item->title?></a>
                                    <span class="date"><?=$news_item->date?></span>
                                </div>

                            </li>
							
							<? endforeach; ?>

                        </ul>

                        <a class="bullet" href="/news">все новости</a>

                    </div>
                </div>

            </div>

            <div class="news-bottom-bg"></div>

        </aside>
		
        </div>
		
		<? endif; ?>

        <? $open_babies = Yii::app()->user->model()->getOpenBabies(); ?>


        <? if ($open_babies): ?>
        <h1 class="page-name">Другие малыши</h1>

		<div class="child-row child-list">
        <? foreach ($open_babies as $baby): ?>
            <div class="child-item">

                <div class="ramka-photo">
                    <a href="/baby/<?=$baby->id?>">
                        <div class="pic">
                            <img src="<?=$baby->getPhoto() ? $baby->getPhoto() : Yii::app()->params['nophoto_baby']?>"
                                 alt="">
                            <span class="ramka"></span>
                        </div>
					</a>
                </div>

                <div class="info">
                    <label>Имя: </label>
                    <span><?=$baby->name?></span>
                    <label>Дата рождения: </label>
                    <span><?=$baby->birth_date?></span>
					<p class="tooltip">Нажмите на фотографию малыша для просмотра</p>
                </div>

            </div>
            <? endforeach; ?>
			<br clear="all"/>
			</div>
        <? endif; ?>
    </div>
</div>

<? if (Yii::app()->user->hasChild()): ?>
<div class="ui-widget popup" id="open_access"
     data-title="Открыть для просмотра ребенка" data-width="450">

    <div class="loader">
        <div></div>
    </div>

    <div class="form-block">
        <div class="block">
            <label for="is_email"><input type="checkbox" id="is_email" checked="checked" name="is_email"/>Новый
                пользователь</label>

            <div class="row">
                <label>Е-mail пользователя:</label>
                <input type="text" name="email"/>
            </div>
            <span class="error" id="email_access_error"></span>
        </div>

        <div class="block">
            <label for="is_login"><input type="checkbox" id="is_login" name="is_login"/>Зарегистрированный
                пользователь</label>

            <div class="row" style="display: none">
                <label>Логин или e-mail пользователя:</label>
                <input type="text" name="login"/>
            </div>
            <span class="error" id="login_access_error"></span>
        </div>

        <input type="hidden" name="baby_id" value="<?=Yii::app()->user->getBaby()->id?>"/>

        <div class="row submit-row">
            <?php echo CHtml::submitButton('Открыть'); ?>
        </div>
    </div>

    <div class="success-message" style="display: none">
        <p>

        </p>

        <div class="row submit-row">
            <button onclick="$('#open_access').dialog('close');">
                Закрыть
            </button>
        </div>
    </div>

</div>
<? endif; ?>
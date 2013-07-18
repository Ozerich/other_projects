<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'diary_form',
    'action' => '/diary/' . ($model->baby_id ? $model->baby_id : Yii::app()->user->getBaby()->id),
    'htmlOptions' => array('class' => 'popup-form diary-form', 'enctype' => 'multipart/form-data'),
    'enableAjaxValidation' => true,
    'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false),
)); ?>

<div class="row">

    <div class="param">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title'); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>

    <div class="param">
        <?php echo $form->labelEx($model, 'date'); ?>
        <?php echo $form->textField($model, 'date', array('class' => 'datepicker', 'id' => $model->isNewRecord ? 'date' : '')); ?>
        <?php echo $form->error($model, 'date'); ?>
    </div>

</div>

<div class="row">
    <div class="param double">
        <label>Этапы:</label>
        <ul id="milestones_list" class="milestones-list">
            <? foreach($model->milestones_text as $milestone): ?>
                <li><?=$milestone?></li>
            <? endforeach; ?>
            <? if ($model->custom_milestone): ?>
            <li><?=$model->custom_milestone?></li>
            <? endif; ?>
        </ul>
        <button class="add-milestone popup-link" id="open_milestones" data-popup="milestones_window">Добавить этап</button>
        <input type="hidden" name="milestones" value="<?=$model->milestones?>"/>
        <input type="hidden" name="custom_milestone" value="<?=$model->custom_milestone?>"/>
    </div>
</div>

<? if ($model->photo): ?>
<div class="row">
    <div class="old-photo param">
        <label>Текущая фотография:</label>
        <img class="avatar-size" src="<?=$model->getPhoto(); ?>"/>
    </div>
</div>
<? endif; ?>

<div class="row">
    <div class="param double">
        <?php echo $form->labelEx($model, 'photo'); ?>
        <?php echo $form->fileField($model, 'photo'); ?>
        <?php echo $form->error($model, 'photo'); ?>
    </div>
</div>

<div class="row">
    <div class="param double">
        <?php echo $form->labelEx($model, 'text'); ?>
        <?php
            $mobile_browser = '0';
     
            if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
                $mobile_browser++;
            }
             
            if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
                $mobile_browser++;
            }    
             
            $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
            $mobile_agents = array(
                'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
                'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
                'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
                'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
                'newt','noki','oper','palm','pana','pant','phil','play','port','prox',
                'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
                'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
                'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
                'wapr','webc','winw','winw','xda ','xda-');
             
            if (in_array($mobile_ua,$mobile_agents)) {
                $mobile_browser++;
            }
             
            if (strpos(strtolower($_SERVER['ALL_HTTP']),'OperaMini') > 0) {
                $mobile_browser++;
            }
             
            if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'windows') > 0) {
                $mobile_browser = 0;
            }
             
            if ($mobile_browser > 0) {
               echo $form->textarea($model, 'text');
            }
            else {
               echo $form->textarea($model, 'text', array('class' => 'cleditor'));
            }   
        ?>
        <?php echo $form->error($model, 'text'); ?>
    </div>
</div>

    <?php echo CHtml::hiddenField('id', $model->id); ?>
<div class="row submit-row">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить'); ?>
</div>

<? $this->endWidget(); ?>

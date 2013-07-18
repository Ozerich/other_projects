<!DOCTYPE html>
<html>
<head>
    <meta charset=utf-8>
    <title>login</title>
    <link rel="stylesheet/less" type="text/css" href="/css/all.less"/>
    <link rel="stylesheet" type="text/css" href="/css/smoothness/jquery-ui-1.10.1.min.css"/>
    <link rel="stylesheet" type="text/css" href="/css/jquery-ui-timepicker-addon.css"/>
    <link rel="stylesheet" type="text/css" href="/colorpicker/css/colorpicker.css"/>

    <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>


    <script type="text/javascript" src="/js/jquery-ui-1.10.1.min.js"></script>
    <script type="text/javascript" src="/js/jquery.ui.datepicker-ru.js"></script>
    <script type="text/javascript" src="/js/jquery-ui-timepicker-addon.js"></script>

    <script type="text/javascript" src="/js/html5shiv.js"></script>
    <script type="text/javascript" src="/js/less-1.3.3.min.js"></script>

    <script type="text/javascript" src="/js/jquery.main.js"></script>
    <script type="text/javascript" src="/js/jquery.form.js"></script>
    <script type="text/javascript" src="/colorpicker/js/colorpicker.js"></script>

    <script src="/js/login.js"></script>

</head>
<body class="login">
<div class="login-block">
    <a href="#" class="logo"></a>

    <form action="/login" method="post" id="login_form">
        <fieldset>
            <div class="param">    <input type="text" placeholder="Логин" name="login" class="input"></div>
<div class="param">  <input type="password" placeholder="Пароль" name="password" class="input"></div>

            <div class="links">
                <input type="submit" class="button-new" value="Войти">
                <a href="#" class="link restore-open-button">Забыли пароль?</a>
            </div>
            <a href="#" class="black register-open-button">Зарегистрироваться</a>
        </fieldset>
    </form>

    <form action="/restore" method="post" id="restore_form" style="display: none">
        <fieldset>
            <input type="text" class="input" name="email" placeholder="Ваш e-mail"/>

            <div class="links">
                <input type="submit" class="button-new" value="Восстановить">
                <a href="#" class="link login-open-button">Войти</a>
            </div>
            <a href="#" class="black register-open-button">Зарегистрироваться</a>
        </fieldset>
    </form>

    <div id="restore_success_form" style="display: none">
        <fieldset>
            <p>Письмо с новым паролем ушло на почту</p>

            <div class="links">
                <input type="submit" class="button-new  login-open-button" value="Войти">
            </div>
        </fieldset>
    </div>

    <?php $model = new Company(); $form = $this->beginWidget('CActiveForm', array(
    'id' => 'register_form',
    'action' => '/register',
    'enableAjaxValidation' => true,
    'htmlOptions' => array('style' => 'display: none'),
    'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false),
)); ?>
    <fieldset>

        <div class="param">
            <?=$form->labelEx($model, 'name');?>
            <?=$form->textField($model, 'name', array('class' => 'input'));?>
            <?=$form->error($model, 'name');?>
        </div>

        <div class="param">
            <?=$form->labelEx($model, 'legal_address');?>
            <?=$form->textField($model, 'legal_address', array('class' => 'input'));?>
            <?=$form->error($model, 'legal_address');?>
        </div>

        <div class="param">
            <?=$form->labelEx($model, 'details');?>
            <?=$form->textarea($model, 'details', array('class' => 'textarea'));?>
            <?=$form->error($model, 'details');?>
        </div>

        <div class="param">
            <?=$form->labelEx($model, 'address'); ?>
            <?=$form->textField($model, 'address', array('class' => 'input'));?>
            <?=$form->error($model, 'address'); ?>
        </div>

        <div class="param">
            <?=$form->labelEx($model, 'form'); ?>
            <?=$form->dropDownList($model, 'form', Company::$forms, array('class' => 'select'));?>
            <?=$form->error($model, 'form'); ?>
            <br clear="all"/>
        </div>


        <div class="param">
            <?=$form->labelEx($model, 'area'); ?>
            <?=$form->dropDownList($model, 'area', Company::$areas, array('class' => 'select'));?>
            <?=$form->error($model, 'area'); ?>
            <br clear="all"/>
        </div>

        <div class="param">
            <?=$form->labelEx($model, 'phone'); ?>
            <div class="phone-row">
                <span>+7</span>

                <div class="cod">
                    <input id="n5" maxlength="3" type="text" class="input input4">
                </div>
                <span>-</span>
                <input type="text" maxlength="3" class="input input2">
                <span>-</span>
                <input type="text" maxlength="2" class="input input3 input31">
                <span>-</span>
                <input type="text" maxlength="2" class="input input3 input32">
                <?=$form->hiddenField($model, 'phone', array('id' => 'phone_value'));?>
            </div>
            <?=$form->error($model, 'phone'); ?>
        </div>

        <div class="param">
            <?=$form->labelEx($model, 'email'); ?>
            <?=$form->textField($model, 'email', array('class' => 'input'));?>
            <?=$form->error($model, 'email');?>
        </div>

        <div class="param">
            <?=$form->labelEx($model, 'password'); ?>
            <?=$form->passwordField($model, 'password', array('class' => 'input'));?>
            <?=$form->error($model, 'password'); ?>
        </div>

        <div class="param">
            <?=$form->labelEx($model, 'contact_person'); ?>
            <?=$form->textField($model, 'contact_person', array('class' => 'input'));?>
            <?=$form->error($model, 'contact_person');?>
        </div>

        <div class="links">
            <?php echo CHtml::submitButton('Зарегистироваться', array('class' => 'button-new')); ?>
            <a href="#" class="link login-open-button">Войти</a>
        </div>

    </fieldset>

    <? $this->endWidget(); ?>
</div>
</body>
</html>

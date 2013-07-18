<?php

class SiteController extends Controller
{
    public $layout = "main";

    public function actionIndex()
    {
        $this->redirect(Yii::app()->user->isAdmin() ? '/companies' : '/adverts');
    }
}
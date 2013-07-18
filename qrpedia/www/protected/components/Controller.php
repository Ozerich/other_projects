<?php

class Controller extends CController
{
    public $layout = '//layouts/main';

    public $menu = array();

    public $breadcrumbs = array();

    protected $ajax = false;

    public function beforeAction($action)
    {
        $guest_actions = array('login', 'register', 'restore');

        if (Yii::app()->user->isGuest && !in_array($action->getId(), $guest_actions)) {
            $this->redirect('/login');
        }

        if (!Yii::app()->user->isGuest && in_array($action->getId(), $guest_actions)) {
            $this->redirect('/');
        }

        if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
            $this->layout = 'none';
            $this->ajax = true;
        }
        else{
            $this->layout = 'main';
            $this->ajax = false;
        }

        if($this->ajax){
            Yii::app()->clientScript->corePackages = array();
        }


        return true;
    }
}
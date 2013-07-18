<?php

class AdminModule extends CWebModule
{
    public function init()
    {
        $this->setImport(array(
            'admin.components.*',
        ));

        $this->layoutPath = Yii::getPathOfAlias('admin.views.layouts');
        $this->layout = 'main';
    }

    public function beforeControllerAction($controller, $action)
    {
        if (parent::beforeControllerAction($controller, $action)) {
            return true;
        } else
            return false;
    }
}

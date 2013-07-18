<?php

class WebUser extends CWebUser
{
    private $_model;
    private $isAdmin;

    public function model()
    {
        return $this->loadUser(Yii::app()->user->id);
    }

    public function isAdmin()
    {
        return Yii::app()->user->getState('isAdmin');
    }

    public function setAdminState($isAdmin)
    {
        $this->isAdmin = $isAdmin;
    }

    protected function loadUser($id = null)
    {
        if ($this->_model === null) {
            if ($id !== null) {
                $this->_model = $this->isAdmin ? Admin::model()->findByPk($id) : Company::model()->findByPk($id);
            }
        }
        return $this->_model;
    }
}

?>
<?php

class WebUser extends CWebUser
{

    private $_model;

    function isAdmin()
    {
        return intval($this->model()->is_admin) == 1;
    }

    public function getName()
    {
        return $this->model()->login;
    }

    public function hasChild()
    {
        return $this->model()->baby !== null;
    }

    public function getAvatar()
    {
        $user = $this->model();
        return empty($user->avatar) ? Yii::app()->params['nophoto_user'] : Yii::app()->params['upload_user_dir'] . $user->avatar;
    }

    public function model()
    {
        return $this->loadUser(Yii::app()->user->id);
    }

    public function getBaby()
    {
        return $this->model()->baby;
    }

    // Load user model.
    protected function loadUser($id = null)
    {
        if ($this->_model === null) {
            if ($id !== null)
                $this->_model = User::model()->findByPk($id);
        }
        return $this->_model;
    }
}

?>
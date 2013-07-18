<?php

class AdminController extends CController
{
    public $layout = 'main';

    public $page_name = '';
	
	public function beforeAction($action){
		if(Yii::app()->user->isGuest || !Yii::app()->user->isAdmin()){
			throw new CHttpException(404);
		};
		return true;
	}

    protected function uploadFile($model, $param, $file_param, $upload_dir)
    {
        $file = CUploadedFile::getInstance($model, $file_param);

        if (!$file) {
            return FALSE;
        }

        $filename = $file->getName();
        $file_ext = strpos($filename, '.') !== FALSE ? substr($filename, strrpos($filename, '.') + 1) : '';

        $filename = uniqid().".".strtolower($file_ext);

        $upload_dir = YiiBase::getPathOfAlias('webroot').$upload_dir;

        if(!file_exists($upload_dir))
        {
            mkdir($upload_dir);
            chmod($upload_dir, 0777);
        }
        $model->$param = $filename;

        return $model->save() && $file->saveAs($upload_dir.$filename);

    }
}
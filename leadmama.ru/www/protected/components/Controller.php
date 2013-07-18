<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/main';
    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();
    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();


    public $list_tabs = array();
	
	public $active_tab = '';


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



        return $model->validate(array($param)) && $model->save(FALSE) && $file->saveAs($upload_dir.$filename);

    }
}
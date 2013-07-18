<?
class Editor extends CInputWidget
{                       
    public $model;
    public $attribute;
    public $name;
    public $value;
    public $config;
    public $editorHtmlOptions;
    public function run()
    {
        //$this->config['toolbar']='Full';
         /*
          $this->config['width']=500;
          $this->config['height']=500;
          $this->config['toolbar']='Basic';
          $this->config['toolbar'] = array(
              array( 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike' ),
              array( 'Image', 'Link', 'Unlink', 'Anchor' )
          );
         */
        parent::run();
        $baseDir = dirname(__FILE__);
        $assets = Yii::app()->getAssetManager()->publish($baseDir.DIRECTORY_SEPARATOR.'assets');
        //Yii::import($assets.'.ckeditor.CKEditor');
        //Yii::import($assets.'.ckfinder.core.CKFinder');  
        $ass=explode('assets/', $assets);
        $assets=$ass[1];
        require_once('assets/'.$assets.'/ckeditor/CKEditor.php');
        require_once('assets/'.$assets.'/ckfinder/core/CKFinder.php');   
        $ckeditor = new CKEditor();
        $ckeditor->basePath = Yii::app()->baseUrl.'/assets/'.$assets.'/ckeditor/';
        CKFinder::SetupCKEditor($ckeditor, Yii::app()->baseUrl.'/assets/'.$assets.'/ckfinder/');
        
        echo '<div id="editor" '.$this->editorHtmlOptions.'>';
        if($this->model)
            $ckeditor->editor(get_class($this->model)."[{$this->attribute}]", $this->model[$this->attribute], $this->config);
        else
            $ckeditor->editor($this->name, $this->value, $this->config);
        echo '<div style="clear:both"></div></div>';
    }
}
?>
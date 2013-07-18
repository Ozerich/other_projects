<?php

class GalleryController extends BaseBabyController
{	
	public function __construct($action){
		$this->active_tab = 'gallery';
		parent::__construct($action);
	}
	
    public function beforeAction($action)
    {
        if (Yii::app()->user->hasChild()) {
            $this->list_tabs = array(
                array(
                    'link' => '/gallery/',
                    'label' => 'Мои альбомы',
                    'active' => true
                )
            );
        }
        return parent::beforeAction($action);
    }

    public function actionIndex($baby_id = 0)
    {
        $model = new PhotoAlbum();
        $this->is_guest = $baby_id && Yii::app()->user->getBaby()->id != $baby_id;
if($this->is_guest){
	$this->list_tabs = array(
                array(
                    'link' => '/gallery/'.$baby_id,
                    'label' => 'Все альбомы',
                    'active' => true
                )
            );
}

        $baby = Baby::model()->findByPk($baby_id ? $baby_id : Yii::app()->user->getBaby()->id);
		$this->baby = $baby;
		
		if($this->is_guest){
			$this->menu_baby = $baby->id;
		}
		
        if (!$baby) {
            if ($baby_id == 0) {
                $this->render('//no_baby');
                return;
            }
            throw new CHttpException(404);
        }

        if (isset($_POST['PhotoAlbum'])) {
            $model->attributes = $_POST['PhotoAlbum'];
        }

        if (isset($_POST['ajax'])) {
            if ($_POST['ajax'] == 'album_form') {
                echo CActiveForm::validate($model);
            }

            Yii::app()->end();
        }

        if (isset($_POST['PhotoAlbum'])) {
            $model->baby_id = Yii::app()->user->getBaby()->id;
            if ($model->save()) {
                $this->uploadFile($model, 'photo', 'photo', Yii::app()->params['upload_gallery_dir']);
                $this->redirect('/gallery/view/' . $model->id);
            }
        }

        $items = PhotoAlbum::model()->findAllByAttributes(array(
            'baby_id' => $baby->id,
        ));

        $this->render('index', array('model' => $model, 'items' => $items, 'is_guest' => $this->is_guest));
    }


    public function actionDelete($id = 0)
    {
        $item = PhotoAlbum::model()->findByPk($id);
        if (!$item) {
            throw new CHttpException(404, "Access denied");
        }

        $item->delete();
        $this->redirect(Yii::app()->getRequest()->getUrlReferrer());
    }

    public function actionView($id = 0)
    {
        $model = PhotoAlbum::model()->findByPk($id);

        if (!$model) {
            throw new CHttpException(404, "Access denied");
        }

        $this->is_guest = $model->baby_id != Yii::app()->user->getBaby()->id;
		$this->baby = Baby::model()->findByPk($model->baby_id);
		
		if($this->is_guest){
			$this->menu_baby = $model->baby_id;
		}

        if (!$this->is_guest) {
            if (isset($_FILES['PhotoAlbumPhoto'])) {
                $images = CUploadedFile::getInstancesByName('PhotoAlbumPhoto');


                foreach ($images as $image) {
                    $filename = $image->getName();
                    $file_ext = strpos($filename, '.') !== FALSE ? substr($filename, strrpos($filename, '.') + 1) : '';

                    $filename = uniqid() . "." . strtolower($file_ext);

                    $upload_dir = YiiBase::getPathOfAlias('webroot') . Yii::app()->params['upload_gallery_dir'];

                    if (!file_exists($upload_dir)) {
                        mkdir($upload_dir);
                        chmod($upload_dir, 0777);
                    }

                    if ($image->saveAs($upload_dir . $filename)) {
                        $model = new PhotoAlbumPhoto();
                        $model->photoalbum_id = $id;
                        $model->photo = $image;
                        if ($model->validate()) {
                            $model->photo = $filename;
                            $model->save();
                        }
                    }
                }


                $this->redirect(Yii::app()->getRequest()->getUrlReferrer());
            }

            if (isset($_POST['PhotoAlbum'])) {
                $model->attributes = $_POST['PhotoAlbum'];
            }

            if (isset($_POST['ajax'])) {
                if ($_POST['ajax'] == 'album_form') {
                    echo CActiveForm::validate($model);
                }

                Yii::app()->end();
            }

            if (isset($_POST['PhotoAlbum'])) {
                $model->baby_id = Yii::app()->user->getBaby()->id;
                if ($model->save()) {
                    $this->uploadFile($model, 'photo', 'photo', Yii::app()->params['upload_gallery_dir']);
                    $this->redirect(Yii::app()->getRequest()->getUrlReferrer());
                }
            }

        }

        $this->render('view', array('model' => $model, 'is_guest' => $this->is_guest));
    }

    public function actionPhoto($id = 0)
    {

        $model = PhotoAlbumPhoto::model()->findByPk($id);
        if (!$model) {
            throw new CHttpException(404, "Access denied");
        }

        $this->is_guest = $model->photoalbum->baby_id != Yii::app()->user->getBaby()->id;
		$this->baby = Baby::model()->findByPk($model->photoalbum->baby_id);

        $comment_model = new PhotoAlbumPhotoComment();

        if (isset($_POST['PhotoAlbumPhotoComment'])) {
            $comment_model->attributes = $_POST['PhotoAlbumPhotoComment'];
        }

        if (isset($_POST['PhotoAlbumPhoto'])) {
            $model->attributes = $_POST['PhotoAlbumPhoto'];
        }

        if (isset($_POST['ajax'])) {
            if ($_POST['ajax'] == 'comment_form') {
                echo CActiveForm::validate($comment_model);
            }

            Yii::app()->end();
        }

        if (isset($_POST['PhotoAlbumPhotoComment'])) {
            $comment_model->photoalbum_photo_id = $id;
            $comment_model->user_id = Yii::app()->user->id;
            if ($comment_model->save()) {
                $this->redirect(Yii::app()->getRequest()->getUrlReferrer());
            }
        }

        if (isset($_POST['PhotoAlbumPhoto'])) {
            if ($model->save()) {
                $this->uploadFile($model, 'photo', 'photo', Yii::app()->params['upload_gallery_dir']);
                $this->redirect(Yii::app()->getRequest()->getUrlReferrer());
            }
        }

        $prev = $next = null;

        $photos = PhotoAlbumPhoto::model()->findAllByAttributes(array('photoalbum_id' => $model->photoalbum_id));
        foreach ($photos as $_photo) {

            if ($_photo->id > $model->id && ($next === null || $_photo->id < $next)) {
                $next = $_photo->id;
            }

            if ($_photo->id < $model->id && ($prev === null || $_photo->id > $prev)) {
                $prev = $_photo->id;
            }

        }

        $this->render('photo', array('model' => $model, 'comment_model' => $comment_model, 'next' => $next, 'prev' => $prev, 'is_guest' => $this->is_guest));
    }


    public function actionLike($id = 0)
    {
        $model = PhotoAlbumPhoto::model()->findByPk($id);
        if (!$model) {
            throw new CHttpException(404, "Access denied");
        }

        if (UserLike::like(Yii::app()->user->id, $id)) {
            $model->likes = $model->likes + 1;
            $model->save();
        }

        $this->redirect(Yii::app()->getRequest()->getUrlReferrer());
    }

}
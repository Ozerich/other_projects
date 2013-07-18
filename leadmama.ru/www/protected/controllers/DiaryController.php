<?php

class DiaryController extends BaseBabyController
{
	public function __construct($action){
		
		$this->active_tab = 'diary';
		parent::__construct($action);
	}
	
    public function actionComment($id = 0)
    {

        if (isset($_POST['DiaryComment'])) {
            $comment_model = new DiaryComment();
            $comment_model->attributes = $_POST['DiaryComment'];
        }

        if (isset($_POST['ajax'])) {

            if ($_POST['ajax'] === 'comment_form') {
                echo CActiveForm::validate($comment_model);
            }

            Yii::app()->end();
        }

        $diary = Diary::model()->findByPk($id);
        if (!$diary) {
            throw new CHttpException(404);
        }


        if (isset($_POST['DiaryComment'])) {
            $comment_model->user_id = Yii::app()->user->id;
            $comment_model->diary_id = $id;

            if ($comment_model->save()) {
                $this->redirect(Yii::app()->getRequest()->getUrlReferrer());
            }
        }

        throw new CHttpException(404);
    }

    public function actionItem($id = 0)
    {
        $diary = Diary::model()->findByPk($id);
        if (!$diary) {
            throw new CHttpException(404);
        }

		$this->is_guest = $diary->baby_id != Yii::app()->user->getBaby()->id;
		if($this->is_guest){
			$this->menu_baby = $diary->baby_id;
		}

		$this->baby = Baby::model()->findByPk($diary->baby_id);
        $this->render('view', array('model' => $diary, 'comment_model' => new DiaryComment()));
    }

    public function actionIndex($id = 0)
    {
        $baby = Baby::model()->findByPk($id > 0 ? $id : Yii::app()->user->getBaby()->id);
		
		$this->baby = $baby;
        if (!$baby) {
            if ($id == 0) {
                $this->render('//no_baby');
                return;
            }
            throw new CHttpException(404);
        }

        $this->is_guest = $baby->id != Yii::app()->user->getBaby()->id;
		if($this->is_guest){
			$this->menu_baby = $baby->id;
		}

        $items = Diary::get($baby->id);

        if ($this->is_guest) {
            $this->render('index', array('items' => $items, 'is_guest' => $this->is_guest, 'comment_model' => new DiaryComment()));
        } else {

            $diary_model = new Diary();

		
            if (isset($_POST['Diary'])) {
                if(isset($_POST['id']) && $_POST['id'])
                    $diary_model = Diary::model()->findByPk($_POST['id']);

                $diary_model->attributes = $_POST['Diary'];
            }


            if (isset($_POST['ajax'])) {

                if ($_POST['ajax'] === 'diary_form') {
                    echo CActiveForm::validate($diary_model);
                }

                Yii::app()->end();
            }


            if (isset($_POST['Diary'])) {
                $diary_model->baby_id = $diary_model->isNewRecord ? $id : $diary_model->baby_id;
                $diary_model->milestones = $_POST['milestones'];
                $diary_model->custom_milestone = $_POST['custom_milestone'];
                if ($diary_model->save()) {
                    $this->uploadFile($diary_model, 'photo', 'photo', Yii::app()->params['upload_diary_dir']);
                    $this->redirect('/diary/');
                }
            }

            $this->render('index', array('items' => $items, 'is_guest' => $this->is_guest, 'model' => $diary_model, 'comment_model' => new DiaryComment()));
        }

    }

    public function actionEdit($id = 0)
    {
        $model = Diary::model()->findByPk($id);

        if (!$model) {
            throw new CHttpException(404, "Access denied");
        }

        $this->renderPartial('_form', array('model' => $model));
    }

    public function actionDelete($id = 0)
    {
        $item = Diary::model()->findByPk($id);

        if (!$item || $item->baby->user->id != Yii::app()->user->id) {
            throw new CHttpException(404, "Access denied");
        }

        $item->delete();
        $this->redirect(Yii::app()->getRequest()->getUrlReferrer());
    }

    public function actionDelete_comment($id = 0)
    {
        $item = DiaryComment::model()->findByPk($id);
        if (!$item) {
            throw new CHttpException(404, "Access denied");
        }

        $item->delete();
        $this->redirect(Yii::app()->getRequest()->getUrlReferrer());
    }

}
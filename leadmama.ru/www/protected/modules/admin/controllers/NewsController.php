<?php

class NewsController extends AdminController
{
    public function actionIndex()
    {
        $this->page_name = 'Управление новостями';

        $items = News::model()->findAll();

        $this->render('index', array('items' => $items));
    }

    public function actionItem($id = 0)
    {
        $model = new News();

        if ($id != 0) {
            $model = News::model()->findByPk($id);
        }

        if (isset($_POST['News'])) {
            $model->attributes = $_POST['News'];
            if ($model->save()) {
                $this->uploadFile($model, 'image', 'image', Yii::app()->params['upload_news_dir']);
                $this->redirect('/admin/news/');
            }
        }

        $this->page_name = 'Новая новость';

        $this->render('item', array('model' => $model));
    }

    public function actionDelete($id = 0)
    {
        $model = News::model()->findByPk($id);

        if ($model) {
            $model->delete();
        }

        $this->redirect('/admin/news');
    }
}
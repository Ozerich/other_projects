<?php

class PagesController extends AdminController
{
    public function actionIndex()
    {
        $this->page_name = 'Управление страницами';

        $items = Page::model()->findAll();

        $this->render('index', array('items' => $items));
    }

    public function actionItem($id = 0)
    {
        $this->page_name = 'Новая страница';

        $model = new Page();

        if ($id != 0) {
            $model = Page::model()->findByPk($id);
        }

        if (isset($_POST['Page'])) {
            $model->attributes = $_POST['Page'];
            if ($model->save()) {
                $this->redirect('/admin/pages/');
            }
        }

        $this->render('item', array('model' => $model));
    }

    public function actionDelete($id = 0)
    {
        $model = Page::model()->findByPk($id);

        if ($model) {
            $model->delete();
        }

        $this->redirect('/admin/pages');
    }

}
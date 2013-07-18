<?php

class CompaniesController extends Controller
{

    public function beforeAction(CAction $action)
    {
        if (!Yii::app()->user->isAdmin()) {
            throw new CHttpException(404);
        }

        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Company');

        for ($i = 152; $i < 250; $i++) {
            $model = new Company();
            $model->email = 'email_'.$i."@mail.ru";
            $model->name = uniqid();
            $model->legal_address = '1';
            $model->password = '1';
            $model->contact_person = '1';
            $model->address = '1';
            $model->save();

        }

        $this->render('index', array('dataProvider' => $dataProvider));
    }


    public function actionItem($id = 0)
    {
        $model = $id == 0 ? new Company() : Company::model()->findByPk($id);
        if (!$model) {
            throw new CHttpException(404);
        }

        if ($_POST) {

            $model->attributes = $_POST['Company'];

            if (isset($_POST['ajax'])) {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }

            $model->save();
            $this->redirect('/companies/');

        } else {
            $this->render('_item_form', array('model' => $model));
        }
    }

}
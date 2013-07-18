<?php
class ProfileController extends Controller
{
    public function actionIndex()
    {
        $company = Yii::app()->user->model();

        if ($_POST) {

            $company->attributes = $_POST['Company'];


            if (isset($_POST['ajax']) && $_POST['ajax'] == 'profile_form') {
                echo CActiveForm::validate($company);
                Yii::app()->end();
            }

            if ($company->save()) {
                $this->redirect('/profile/');
            }
        }

        $this->render('index', array('model' => $company));
    }

    public function actionBuy_Package()
    {
        if ($_POST) {
            $id = Yii::app()->request->getPost('id');
            $package = Package::model()->findByPk($id);

            if (!$package) {
                echo 'Пакет не найден';
                Yii::app()->end();
            }

            $user = Yii::app()->user->model();

            if ($user->balance < $package->price) {
                echo 'Не хватает денег на счету';
                Yii::app()->end();
            }

            $user->balance -= $package->price;

            $user->package_name = $package->name;
            $user->package_types = $package->types;
            $user->package_days = $package->days;
            $user->package_count_remaining = $package->count;
            $user->package_date = date('Y-m-d');

            $user->save();


            echo '0';
            Yii::app()->end();
        } else {
            throw new CHttpException(404);
        }
    }
}
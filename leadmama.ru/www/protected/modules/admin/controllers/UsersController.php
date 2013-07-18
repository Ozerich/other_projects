<?php

class UsersController extends AdminController
{
    public function actionIndex()
    {
        $this->page_name = 'Управление пользователями';
		
        $this->render('index', array('dataProvider' => new CActiveDataProvider('User')));
    }

    public function actionDelete($id = 0)
    {
		$user = User::model()->findByPk($id);
		
		if($user){
			$user->delete();
		}
		
		$this->redirect('/admin/users');
	}
	
	public function actionEdit($id){
		$user = User::model()->findByPk($id);
		
		if(!$user){
			throw new CHttpException(404);
		}
		
		if($_POST){
			$user->attributes = $_POST['User'];
			
			if(isset($_POST['new_password']) && strlen($_POST['new_password']) > 0)
			{
				$user->password = Yii::app()->request->getPost('new_password');
				$user->need_update_password = true;
			}
			else{
				$user->need_update_password = false;
			}
			
			if($user->save()){
				$this->redirect('/admin/users');
			}
		}
		
		$this->render('item', array('model' => $user));
	}

}
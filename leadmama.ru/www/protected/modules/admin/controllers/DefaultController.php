<?php

class DefaultController extends AdminController
{
	public function actionIndex()
	{
        $this->redirect('/admin/pages');
	}
}
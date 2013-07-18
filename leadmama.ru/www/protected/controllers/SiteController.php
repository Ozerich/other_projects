<?php

class SiteController extends Controller
{
    public $layout = 'page';

    public function actionIndex()
    {
        $this->layout = 'main';
        $this->render('index', array('news' => News::model()->findAll()));
    }
	
	public function actionNews_list(){
	
		$this->list_tabs = array(array(
            'link' => '/news',
            'label' => 'Новости',
			'active' => true,
        ));
	
		$this->layout = 'main';
		$this->render('news_list', array('news' => News::model()->findAll()));
	}

    public function actionNews($id = 0)
    {
		$news = News::model()->findByAttributes(array('id' => $id));
		if (!$news) {
			throw new CHttpException(404, "News is no found");
		}
		
		$this->list_tabs = array(array(
            'link' => '/news',
            'label' => 'Новости',
        ));

		$this->render('news', array('news' => $news));
		
    }

    public function actionPage($alias = "")
    {
        $page = Page::model()->findByAttributes(array('alias' => $alias));
        if (!$page) {
            throw new CHttpException(404, "Page is no found");
        }

        $this->list_tabs = array(array(
            'link' => '/page/'.$alias,
            'label' => $page->title,
            'active' => true
        ));

        $this->render('page', array('page' => $page));
    }
}
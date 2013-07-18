<?php

class AdvertsController extends Controller
{
    public function actionIndex()
    {
        if (Yii::app()->user->isAdmin()) {

            $this->render('admin_index', array('dataProvider' => new CActiveDataProvider('Advert')));

        } else {
            $folders = Folder::getTree();

            $this->render('index', array('folders' => $folders, 'selected_folder' => Yii::app()->request->getQuery('folder', 0)));
        }
    }

    public function actionAdd_folder()
    {
        if ($_POST) {
            $name = Yii::app()->request->getPost('name');
            $parent = Yii::app()->request->getPost('parent');

            $folder = new Folder();
            $folder->name = $name;
            $folder->parent_id = $parent;
            $folder->user_id = Yii::app()->user->getId();

            if ($folder->save()) {
                echo $folder->id;
            } else {
                echo '0';
            }

            Yii::app()->end();

        } else {
            throw new CHttpException(404);
        }
    }

    public function actionLoad_folder()
    {
        if ($_POST) {
            $id = Yii::app()->request->getPost('id');

            $items = array();
            $folder = null;

            if ($id != 0) {
                $folder = Folder::model()->findByPk($id);
                if (!$folder) {
                    throw new CHttpException(404);
                }

                if ($folder->parent_id != 0) {
                    $items = Advert::model()->findAllByAttributes(array(
                        'user_id' => Yii::app()->user->id,
                        'folder_id' => $folder->id
                    ));
                } else {

                    $children = Folder::model()->findAllByAttributes(array(
                        'parent_id' => $folder->id,
                    ));

                    $children_ids = array();
                    foreach ($children as $child) {
                        $children_ids[] = $child->id;
                    }

                    $items_all = Advert::model()->findAllByAttributes(array(
                        'user_id' => Yii::app()->user->id
                    ));

                    $items = array();
                    foreach ($items_all as $item) {
                        if ($item->folder_id == $folder->id || in_array($item->folder_id, $children_ids)) {
                            $items[] = $item;
                        }
                    }
                }

            } else {
                $items = Advert::model()->findAllByAttributes(array(
                    'user_id' => Yii::app()->user->id,
                    'folder_id' => 0
                ));
            }


            $this->renderPartial('folder', array('folder' => $folder, 'items' => $items));
            Yii::app()->end();
        } else {
            throw new CHttpException(404);
        }
    }

    public function actionSave_folder()
    {
        if ($_POST) {

            $id = Yii::app()->request->getPost('id');
            $name = Yii::app()->request->getPost('name');

            $folder = Folder::model()->findByPk($id);
            $folder->name = $name;
            $folder->save();

            Yii::app()->end();
        } else {
            throw new CHttpException(404);
        }
    }

    public function actionDelete_folder()
    {
        if ($_POST) {
            $id = Yii::app()->request->getPost('id');

            $folder = Folder::model()->findByPk($id);
            $folder->delete();

            Yii::app()->end();
        } else {
            throw new CHttpException(404);
        }
    }

    public function actionMove()
    {
        if ($_POST) {

            $items = Yii::app()->request->getPost('items');
            $folder = Yii::app()->request->getPost('folder');

            $items = $items ? explode(',', $items) : array();

            foreach ($items as $item_id) {
                $advert = Advert::model()->findByPk($item_id);
                if ($advert) {
                    $advert->folder_id = $folder;
                    $advert->save();
                }
            }

            echo '0';
            Yii::app()->end();
        } else {
            throw new CHttpException(404);
        }
    }


    public function actionView($id = 0)
    {
        $model = Advert::model()->findByPk($id);

        if (!$model) {
            throw new CHttpException(404);
        }

        $this->render('view', array('model' => $model));
    }

    public function actionItem($id = 0, $folder = null)
    {
        if ($_POST) {

            $model = $id ? Advert::model()->findByPk($id) : new Advert($_POST['Advert']['type']);
            if (!$model) {
                throw new CHttpException(404);
            }

            $model->attributes = $_POST['Advert'];

            if (isset($_POST['ajax'])) {

                if (strpos($_POST['ajax'], 'advert_form') !== false) {
                    echo CActiveForm::validate($model);
                    Yii::app()->end();
                }

            }

            $model->date_added = date('Y-m-d H:i:s');

            if ($model->validate()) {

                if ($model->isNewRecord) {
                    $model->folder_id = Yii::app()->request->getPost('folder', 0);
                }

                $upload_dir = YiiBase::getPathOfAlias('webroot') . Yii::app()->params['upload_dir'];

                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir);
                    chmod($upload_dir, 0777);
                }

                $photo = CUploadedFile::getInstance($model, 'photo');
                if ($photo) {
                    $filename = uniqid() . "." . $photo->getExtensionName();
                    $model->photo = $filename;
                    $photo->saveAs($upload_dir . $filename);
                }

                if ($model->isNewRecord) {
                    Yii::app()->user->model()->package_count_remaining--;
                    Yii::app()->user->model()->save();
                }

                $model->color_1 = Yii::app()->request->getPost('color_1', $model->color_1);
                $model->color_2 = Yii::app()->request->getPost('color_2', $model->color_2);
                $model->color_3 = Yii::app()->request->getPost('color_3', $model->color_3);


                $url = $_SERVER['HTTP_HOST'] . "/adverts/" . $model->id;
                $qrfilename = $model->id . '_qr.png';
                Yii::import('ext.qrcode.QRCode');
                $code = new QRCode($url);
                $code->create(YiiBase::getPathOfAlias('webroot') . Yii::app()->params['qrcodes_dir'] . $qrfilename);

                $model->qrfile = $qrfilename;

                $model->save();


                $photos = CUploadedFile::getInstancesByName('photos');
                foreach ($photos as $photo) {
                    if ($photo) {
                        $filename = uniqid() . "." . $photo->getExtensionName();
                        $photo->saveAs($upload_dir . $filename);

                        $photoModel = new AdvertPhoto();
                        $photoModel->advert_id = $model->id;
                        $photoModel->file = $filename;
                        $photoModel->save();
                    }
                }


                $this->redirect('/adverts?folder=' . $model->folder_id);
            } else {
                $this->render('item', array('model' => $model, 'folder' => $folder));
            }

        } else {
            $model = new Advert();

            if ($id) {
                $model = Advert::model()->findByPk($id);
                if (!$model) {
                    throw new CHttpException(404);
                }
            }

            $this->render('item', array('model' => $model, 'folder' => $folder));
        }
    }

}
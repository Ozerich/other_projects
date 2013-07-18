<?php

class Folder extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'folders';
    }

    public function rules()
    {
        return array(
            array('user_id, name', 'required'),
            array('parent_id, user_id', 'length', 'max' => 10),
            array('name', 'length', 'max' => 255),

            array('id, parent_id, user_id, name', 'safe', 'on' => 'search'),
        );
    }


    public function relations()
    {
        return array();
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'parent_id' => 'Parent',
            'user_id' => 'User',
            'name' => 'Name',
        );
    }

    public static function getTree()
    {
        $folders = array();

        $folders_all = Folder::model()->findAllByAttributes(array('user_id' => Yii::app()->user->id));

        foreach ($folders_all as $folder) {
            if ($folder->parent_id == 0) {
                $folders[$folder->id] = array(
                    'id' => $folder->id,
                    'name' => $folder->name,
                    'children' => array(),
                );
            }
        }

        foreach ($folders_all as $folder) {
            if ($folder->parent_id != 0) {
                if (isset($folders[$folder->parent_id])) {
                    $folders[$folder->parent_id]['children'][] = array(
                        'id' => $folder->id,
                        'name' => $folder->name
                    );
                }
            }
        }


        return $folders;
    }

}
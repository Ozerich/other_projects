<?php

/**
 * This is the model class for table "diary_comments".
 *
 * The followings are the available columns in table 'diary_comments':
 * @property string $id
 * @property string $pos
 * @property string $name
 *
 * The followings are the available model relations:
 * @property DiaryMilestone $milestones
 */
class DiaryMilestoneTab extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DiaryComment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'diary_milestones_tabs';
	}

	public function relations()
	{
		return array(
			'milestones' => array(self::HAS_MANY, 'DiaryMilestone', 'tab'),
		);
    }

}
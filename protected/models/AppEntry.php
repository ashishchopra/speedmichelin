<?php

/**
 * This is the model class for table "app_entry".
 *
 * The followings are the available columns in table 'app_entry':
 * @property integer $id
 * @property string $uid
 * @property string $img_src
 * @property string $caption
 * @property string $status
 * @property integer $points
 * @property string $create_time
 */
class AppEntry extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AppEntry the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'app_entry';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid, img_src, caption, status, points, create_time', 'required'),
			array('points', 'numerical', 'integerOnly'=>true),
			array('uid', 'length', 'max'=>100),
			array('img_src, caption', 'length', 'max'=>200),
			array('status', 'length', 'max'=>7),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, uid, img_src, caption, status, points, create_time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'uid' => 'Uid',
			'img_src' => 'Img Src',
			'caption' => 'Caption',
			'status' => 'Status',
			'points' => 'Points',
			'create_time' => 'Create Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('uid',$this->uid,true);
		$criteria->compare('img_src',$this->img_src,true);
		$criteria->compare('caption',$this->caption,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('points',$this->points);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
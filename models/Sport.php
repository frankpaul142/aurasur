<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sport".
 *
 * @property integer $id
 * @property string $name
 * @property string $picture
 * @property string $status
 * @property string $title_picture
 *
 * @property Race[] $races
 */
class Sport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sport';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'picture', 'status', 'title_picture'], 'required'],
            [['status'], 'string'],
            [['name'], 'string', 'max' => 30],
            [['picture', 'title_picture'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'picture' => 'Picture',
            'status' => 'Status',
            'title_picture' => 'Title Picture',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRaces()
    {
        return $this->hasMany(Race::className(), ['sport_id' => 'id']);
    }
}

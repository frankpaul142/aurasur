<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gallery".
 *
 * @property integer $id
 * @property integer $race_id
 * @property string $picture
 *
 * @property Race $race
 */
class Gallery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gallery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['race_id', 'picture'], 'required'],
            [['race_id'], 'integer'],
            [['picture'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'race_id' => 'Race ID',
            'picture' => 'Picture',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRace()
    {
        return $this->hasOne(Race::className(), ['id' => 'race_id']);
    }
}

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
 *
 * @property Race[] $races
 */
class Sport extends \yii\db\ActiveRecord
{
    public $bn;
    public $title;

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
            [['name', 'status','color'], 'required'],
            [['picture','bn','title'],'required','on'=>'create'],
            [['status'], 'string'],
            [['name'], 'string', 'max' => 30],
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
            'name' => 'Nombre',
            'picture' => 'Imagen',
            'status' => 'Status',
            'color'=>'Color',
            'bn'=>'Imagen B/N',
            'title'=>'Imagen Titulo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRaces()
    {
        return $this->hasMany(Race::className(), ['sport_id' => 'id'])->orderBy('date');
    }
}

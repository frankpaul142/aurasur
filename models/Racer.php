<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "racer".
 *
 * @property integer $id
 * @property integer $category_id
 * @property integer $race_id
 * @property integer $user_id
 * @property string $position_category
 * @property string $position_general
 * @property string $time1
 * @property string $time2
 * @property string $creation_date
 *
 * @property User $user
 * @property Category $category
 * @property Race $race
 */
class Racer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'racer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'race_id', 'user_id', 'creation_date','place','payment'], 'required'],
            [['place'],'string','max'=>100],
            [['category_id', 'race_id', 'user_id', 'position_category', 'position_general'], 'integer'],
            [['time1', 'time2', 'creation_date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Categoría',
            'race_id' => 'Carrera',
            'user_id' => 'Deportista',
            'position_category' => 'Posición Categoría',
            'position_general' => 'Posición General',
            'time1' => 'Tiempo Chip',
            'time2' => 'Tiempo Disparo',
            'creation_date' => 'Creation Date',
            'place'=>'Lugar de Inscripción',
            'payment'=>'Forma de Pago',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRace()
    {
        return $this->hasOne(Race::className(), ['id' => 'race_id']);
    }
}

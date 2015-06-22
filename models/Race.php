<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "race".
 *
 * @property integer $id
 * @property integer $sport_id
 * @property string $name
 * @property string $place
 * @property string $date
 * @property double $cost
 * @property string $description
 * @property string $attachment1
 * @property string $attachment2
 * @property string $picture
 * @property string $status
 * @property string $creation_date
 *
 * @property Categories[] $categories
 * @property Category[] $categories0
 * @property Gallery[] $galleries
 * @property Sport $sport
 * @property Racer[] $racers
 */
class Race extends \yii\db\ActiveRecord
{
	public $sponsor;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'race';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sport_id', 'name', 'place', 'date', 'cost', 'description', 'status', 'creation_date'], 'required'],
            [['picture'],'required','on'=>'create'],
            [['sport_id'], 'integer'],
            [['date', 'creation_date'], 'safe'],
            [['cost'], 'number'],
            [['description', 'status'], 'string'],
            [['name', 'place'], 'string', 'max' => 100],
            [['picture','sponsor'],'file','extensions'=>'jpg,png'],
            [['attachment1', 'attachment2'], 'file','extensions'=>'pdf'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sport_id' => 'Deporte',
            'name' => 'Nombre',
            'place' => 'Lugar',
            'date' => 'Fecha',
            'cost' => 'Costo',
            'description' => 'Descripcion',
            'attachment1' => 'Adjunto 1',
            'attachment2' => 'Adjunto 2',
            'picture' => 'Imagen Carrera',
            'status' => 'Status',
            'creation_date' => 'Creation Date',
			'sponsor'=>'Auspiciantes',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories0()
    {
        return $this->hasMany(Categories::className(), ['race_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable('categories', ['race_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGalleries()
    {
        return $this->hasMany(Gallery::className(), ['race_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSport()
    {
        return $this->hasOne(Sport::className(), ['id' => 'sport_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRacers()
    {
        return $this->hasMany(Racer::className(), ['race_id' => 'id']);
    }
}

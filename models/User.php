<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $creation_date
 * @property string $identity
 *
 * @property UserHasModule[] $userHasModules
 * @property Module[] $modules
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */

    public $authKey;
    public $accessToken;
    public $confirmPassword;

    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'lastname', 'username', 'sex', 'birthdate', 'identity', 'cellphone', 'address', 'size', 'password', 'status', 'creation_date'], 'required'],
            [['confirmPassword'], 'required', 'on'=>'register'],
            [['sex', 'size', 'status'], 'string'],
            [['birthdate', 'creation_date'], 'safe'],
            [['name', 'lastname', 'contact_name'], 'string', 'max' => 60],
            [['username', 'address', 'medical_history', 'password'], 'string', 'max' => 255],
            [['identity'], 'string', 'max' => 15],
           	[['cellphone', 'contact_phone'], 'string', 'max' => 10],
           	[['insurance'], 'string', 'max' => 50],
           	[['policy'], 'string', 'max' => 30],
           	[['blood_type'], 'string', 'max' => 4],
           	[['recent_injuries', 'surgeries', 'allergies'], 'string', 'max' => 200],
            [['username'], 'unique'],
            [['username'], 'email'],
            [['confirmPassword'],'compare','compareAttribute'=>'password', 'message'=>'No coinciden las contraseñas'],
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" No está implementado.');
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * Finds user by password reset token
     *
     * @param  string      $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            // token expired
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token
        ]);
    }


    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Email',
            'name' => 'Nombres',
            'lastname' => 'Apellidos',
            'cellphone' => 'Número celular',
            'address' => 'Dirección',
            'password' => 'Contraseña',
            'confirmPassword' => 'Confirmar Contraseña',
            'sex'=>'Sexo',
            'birthdate'=>'Fecha de Nacimiento',
            'identity'=>'Cédula / Pasaporte',
            'size'=>'Talla de camiseta',
            'contact_name' => 'Nombre',
           	'contact_phone' => 'Teléfono',
           	'insurance' => 'Aseguradora',
           	'policy' => 'No Póliza',
           	'blood_type' => 'Tipo de Sangre',
           	'medical_history' => 'Antecedentes Médicos',
           	'recent_injuries' => 'Lesiones Recientes',
           	'surgeries' => 'Cirugías',
           	'allergies' => 'Alergias',
           	'status' => 'Status',
           	'creation_date' => 'Fecha de Creación',
        ];
    }
    public function getIsAdmin()
    {
        $return = false;
        if($this->type=='ADMIN')
            $return=true;
        return $return;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserHasModules()
    {
        return $this->hasMany(UserHasModule::className(), ['user_id' => 'id']);
    }
        /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $this->hashPassword($password);
    }

    public function hashPassword($password){

        return hash('sha256',$password);
    }
    
    public function generateAuthKey()
    {
        $this->auth_key = Security::generateRandomKey();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Security::generateRandomKey() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRacers()
    {
        return $this->hasMany(Racer::className(), ['user_id' => 'id']);
    }
}

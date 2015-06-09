<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Iniciar Sesión';
?>
<div class="home-cont-right background-is">
    <div class="cont-iniciarsesion">
        <h1>Accede a tu perfil</h1><br/>
        <?php if (Yii::$app->session->hasFlash('registrado')){ ?>
		    <div class="alert alert-success">
			    Tu perfil ha sido creado. Confirma tu email antes de iniciar sesión
		    </div>
	    <?php } ?>
        <?php $form = ActiveForm::begin([
	        'id' => 'login-form',
	        'options' => ['class' => 'form-horizontal'],
	        'fieldConfig' => [
	            'template' => "{input}{error}",
	        ],
	    ]); ?>
	    	<?= $form->field($model, 'username', ['inputOptions'=>['placeholder'=>'Escribe tu usuario']]) ?>
	    	<?= $form->field($model, 'password', ['inputOptions'=>['placeholder'=>'Escribe tu contraseña']])->passwordInput() ?>
	    	<?= Html::submitButton('INGRESAR', ['name' => 'login-button']) ?>
        <?php ActiveForm::end(); ?>
        <a href="<?= Yii::getAlias('@web') ?>/user/create">Nuevo Usuario?. Registrate Aquí</a>
    </div>   
</div>

<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;

$this->title='Registra tu perfil';
?>
<div class="home-cont-right background-is">
 	<div class="cont-registraperfil">
    	<h1>Registra tu perfil</h1>
        <span>Datos personales</span>
        <?php if (Yii::$app->session->hasFlash('errorRegistro')){ ?>
		    <div class="alert alert-danger">
			    <?= Yii::$app->session->getFlash('errorRegistro') ?>
		    </div>
	    <?php } ?>
        <?php $form = ActiveForm::begin([
	        'id' => 'login-form',
	        'options' => ['class' => 'form-horizontal'],
	        'fieldConfig' => [
	            'template' => '{label}<div class=\"col-lg-3\">{input}</div><div class=\"col-lg-8\">{error}</div>',
	        ],
	    ]); ?>
        	<?= $form->field($model, 'name', ['inputOptions'=>['placeholder'=>'Escribe aquí']]) ?>
        	<?= $form->field($model, 'lastname', ['inputOptions'=>['placeholder'=>'Escribe aquí']]) ?>
        	<?= $form->field($model, 'email', ['inputOptions'=>['placeholder'=>'Escribe aquí']]) ?>
            <?= $form->field($model, 'sex')->dropDownList([ 'MALE' => 'Masculino', 'FEMALE' => 'Femenino', ], ['prompt' => 'Escoge']) ?>
            <?= $form->field($model, 'birthdate')->widget(DatePicker::className(),['removeButton'=>false, 'pluginOptions'=>['format'=>'yyyy-mm-dd']]) ?>
            <?= $form->field($model, 'identity', ['inputOptions'=>['placeholder'=>'Escribe aquí']]) ?>
            <?= $form->field($model, 'cellphone', ['inputOptions'=>['placeholder'=>'Escribe aquí']]) ?>
            <?= $form->field($model, 'address', ['inputOptions'=>['placeholder'=>'Escribe aquí']]) ?>
            <?= $form->field($model, 'size')->dropDownList([ 'XS' => 'XS', 'S' => 'S', 'M' => 'M', 'L' => 'L', 'XL' => 'XL' ], ['prompt' => 'Escoge']) ?>
            <?= $form->field($model, 'password', ['inputOptions'=>['placeholder'=>'Escribe aquí']])->passwordInput() ?>
            <?= $form->field($model, 'confirmPassword', ['inputOptions'=>['placeholder'=>'Escribe aquí']])->passwordInput() ?>
            <?= Html::submitButton('Siguiente') ?>
        <?php ActiveForm::end(); ?>
    </div>   
</div>

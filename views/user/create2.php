<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title='Registra tu perfil';
?>
<div class="home-cont-right background-is">
 	<div class="cont-registraperfil">
    	<h1>Registra tu perfil</h1>
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
            <span>Contactos personales</span>
        	<?= $form->field($model, 'contact_name', ['inputOptions'=>['placeholder'=>'Escribe aquí']]) ?>
        	<?= $form->field($model, 'contact_phone', ['inputOptions'=>['placeholder'=>'Escribe aquí']]) ?>
            <span>Seguro Médico</span>
        	<?= $form->field($model, 'insurance', ['inputOptions'=>['placeholder'=>'Escribe aquí']]) ?>
            <?= $form->field($model, 'policy', ['inputOptions'=>['placeholder'=>'Escribe aquí']]) ?>
            <span>Datos Médicos</span>
            <?= $form->field($model, 'blood_type', ['inputOptions'=>['placeholder'=>'Escribe aquí']]) ?>
            <?= $form->field($model, 'medical_history', ['inputOptions'=>['placeholder'=>'Escribe aquí']]) ?>
            <?= $form->field($model, 'recent_injuries', ['inputOptions'=>['placeholder'=>'Escribe aquí']]) ?>
            <?= $form->field($model, 'surgeries', ['inputOptions'=>['placeholder'=>'Escribe aquí']]) ?>
            <?= $form->field($model, 'allergies', ['inputOptions'=>['placeholder'=>'Escribe aquí']]) ?>
            <?= Html::submitButton('Registrarse') ?>
        <?php ActiveForm::end(); ?>
    </div>   
</div>

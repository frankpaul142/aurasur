<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;


$this->title = 'Inscribir corredor';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs('
var mas=false;
$("#div_mas_info").hide();
$("#mas_info").click(function(ev){
	ev.preventDefault();
	if(!mas){
		$("#div_mas_info").show();
		$(this).text("- Menos Información");
		mas=true;
	}
	else{
		$("#div_mas_info").hide();
		$(this).text("+ Más Información");
		mas=false;
	}
});
');
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="user-form">
	    <?php if (Yii::$app->session->hasFlash('errorRacer')) {
	        echo '<div class="alert alert-danger" role="alert">'.Yii::$app->session->getFlash('errorRacer').'</div>';
	    } ?>
	    <?php if (Yii::$app->session->hasFlash('racerCreated')) {
	        echo '<div class="alert alert-success" role="alert">Corredor inscrito satisfactoriamente</div>';
	    } ?>
	    
	    <?php $form = ActiveForm::begin(); ?>

	    <?= $form->field($user, 'identity')->textInput(['maxlength' => true]) ?>

	    <?= $form->field($user, 'name')->textInput(['maxlength' => true]) ?>

	    <?= $form->field($user, 'lastname')->textInput(['maxlength' => true]) ?>

	    <?= $form->field($user, 'username')->textInput(['maxlength' => true]) ?>

	    <?= $form->field($user, 'sex')->dropDownList([ 'MALE' => 'HOMBRE', 'FEMALE' => 'MUJER', ], ['prompt' => '']) ?>

	    <?= $form->field($user, 'birthdate')->widget(DatePicker::className(),['removeButton'=>false, 'pluginOptions'=>['format'=>'yyyy-mm-dd']]) ?>

	    <?= $form->field($user, 'cellphone')->textInput(['maxlength' => true]) ?>

	    <?= $form->field($user, 'address')->textInput(['maxlength' => true]) ?>

	    <?= $form->field($user, 'size')->dropDownList([ 'XS' => 'XS', 'S' => 'S', 'M' => 'M', 'L' => 'L', 'XL' => 'XL', ], ['prompt' => '']) ?>

	    <?= $form->field($racer, 'race_id')->dropDownList(ArrayHelper::map($races,'id','name'), ['prompt' => '','onchange'=>'
	    	$.post("'.Yii::$app->urlManager->createUrl('admin/user/categories?id=').'"+$(this).val(),function(data){
	    		$("#select_category").html(data);
	    	});
	    ']) ?>

	    <?= $form->field($racer, 'category_id')->dropDownList([],['id'=>'select_category']) ?>

	    <?= $form->field($racer, 'place')->textInput(['maxlength' => true]) ?>

	    <?= $form->field($racer, 'payment')->dropDownList(['EFECTIVO' => 'EFECTIVO','TARJETA'=>'TARJETA','PAYPAL'=>'PAYPAL'], ['prompt' => '']) ?>

	    <div class="form-group">
	    	<button id="mas_info" class="btn btn-default">+ Más información</button>
	    </div>
	    <div id="div_mas_info">
	    <?= $form->field($user, 'contact_name')->textInput(['maxlength' => true]) ?>

	    <?= $form->field($user, 'contact_phone')->textInput(['maxlength' => true]) ?>

	    <?= $form->field($user, 'insurance')->textInput(['maxlength' => true]) ?>

	    <?= $form->field($user, 'policy')->textInput(['maxlength' => true]) ?>

	    <?= $form->field($user, 'blood_type')->textInput(['maxlength' => true]) ?>

	    <?= $form->field($user, 'medical_history')->textInput(['maxlength' => true]) ?>

	    <?= $form->field($user, 'recent_injuries')->textInput(['maxlength' => true]) ?>

	    <?= $form->field($user, 'surgeries')->textInput(['maxlength' => true]) ?>

	    <?= $form->field($user, 'allergies')->textInput(['maxlength' => true]) ?>
	    </div>

	    <div class="form-group">
	        <?= Html::submitButton('Inscribir', ['class' => 'btn btn-success']) ?>
	    </div>

	    <?php ActiveForm::end(); ?>

	</div>

</div>
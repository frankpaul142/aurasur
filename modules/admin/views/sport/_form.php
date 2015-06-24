<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\color\ColorInput;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Sport */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sport-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <input type="hidden" name="pictureChanged" value="false" id="pictureChanged">
	<?php if($model->isNewRecord){
		$pluginOptions=[
			'showUpload'=>false,
			'initialPreviewShowDelete'=>true,
			'previewFileType'=>'image',
		];
	}
	else{
		$pluginOptions=[
			'showUpload'=>false, 
			'initialPreview'=>[Html::img(Yii::getAlias('@web')."/img/".$model->picture, ['class'=>'file-preview-image', 'alt'=>$model->picture])], 
			'initialPreviewShowDelete'=>true,
			'previewFileType'=>'image',
		];
	} ?>
	<?= $form->field($model, 'picture')->widget(FileInput::classname(),[
		'options'=>[
			'accept'=>'image/*'
		],
		'pluginOptions'=>$pluginOptions,
		'pluginEvents'=>[
			'fileclear'=>'function(){$("#pictureChanged").val("true")}',
			'fileloaded'=>'function(){$("#pictureChanged").val("true")}',
		]
	]) ?>

	<input type="hidden" name="bnChanged" value="false" id="bnChanged">
	<?php if($model->isNewRecord){
		$pluginOptions=[
			'showUpload'=>false,
			'initialPreviewShowDelete'=>true,
			'previewFileType'=>'image',
		];
	}
	else{
		$pluginOptions=[
			'showUpload'=>false, 
			'initialPreview'=>[Html::img(Yii::getAlias('@web')."/img/bn/".$model->picture, ['class'=>'file-preview-image', 'alt'=>$model->picture])], 
			'initialPreviewShowDelete'=>true,
			'previewFileType'=>'image',
		];
	} ?>
	<?= $form->field($model, 'bn')->widget(FileInput::classname(),[
		'options'=>[
			'accept'=>'image/*'
		],
		'pluginOptions'=>$pluginOptions,
		'pluginEvents'=>[
			'fileclear'=>'function(){$("#bnChanged").val("true")}',
			'fileloaded'=>'function(){$("#bnChanged").val("true")}',
		]
	]) ?>

	<input type="hidden" name="titleChanged" value="false" id="titleChanged">
	<?php if($model->isNewRecord){
		$pluginOptions=[
			'showUpload'=>false,
			'initialPreviewShowDelete'=>true,
			'previewFileType'=>'image',
		];
	}
	else{
		$pluginOptions=[
			'showUpload'=>false, 
			'initialPreview'=>[Html::img(Yii::getAlias('@web')."/img/titulo/".$model->picture, ['class'=>'file-preview-image', 'alt'=>$model->picture])], 
			'initialPreviewShowDelete'=>true,
			'previewFileType'=>'image',
		];
	} ?>
	<?= $form->field($model, 'title')->widget(FileInput::classname(),[
		'options'=>[
			'accept'=>'image/*'
		],
		'pluginOptions'=>$pluginOptions,
		'pluginEvents'=>[
			'fileclear'=>'function(){$("#titleChanged").val("true")}',
			'fileloaded'=>'function(){$("#titleChanged").val("true")}',
		]
	]) ?>

    <?= $form->field($model, 'color')->widget(ColorInput::classname(),[
    	'options'=>['placeholder'=>'Selecciona un color...'],
    ]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'ACTIVE' => 'ACTIVE', 'INACTIVE' => 'INACTIVE', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

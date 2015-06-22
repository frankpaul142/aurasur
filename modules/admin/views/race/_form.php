<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\tinymce\TinyMce;
use kartik\datetime\DateTimePicker;
use kartik\file\FileInput;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Race */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="race-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

	<?= $form->field($model, 'sport_id')->dropDownList(ArrayHelper::map($sports,'id','name'),['prompt'=>'']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'place')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date')->widget(DateTimePicker::className(), [
		'removeButton'=>false,
		'pluginOptions'=>[
			'autoclose'=>true,
			'format'=>'yyyy-mm-dd hh:ii'
		]
	]) ?>

    <?= $form->field($model, 'cost')->textInput() ?>

	<?= $form->field($model, 'description')->widget(TinyMce::className(), [
		'options' => ['rows' => 9],
		'language' => 'es',
		'clientOptions' => [
			'plugins' => [
				"advlist autolink lists link charmap print preview anchor",
				"searchreplace visualblocks code fullscreen",
				"insertdatetime media table contextmenu paste",
				"image"
			],
			'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | image | fullscreen"
		]
	]);?>

    <input type="hidden" name="attachment1Changed" value="false" id="attachment1Changed">
    <?php if($model->isNewRecord || $model->attachment1==''){
		$pluginOptions=[
			'showUpload'=>false,
			'initialPreviewShowDelete'=>true,
			'previewFileType'=>'any',
		];
	}
	else{
		$pluginOptions=[
			'showUpload'=>false, 
			'initialPreview'=>"<div class='file-preview-text'><h2><i class='glyphicon glyphicon-file'></i></h2>".$model->attachment1."</div>", 
			'initialPreviewShowDelete'=>true,
			'previewFileType'=>'any',
		];
	} ?>
	<?= $form->field($model, 'attachment1')->widget(FileInput::classname(),[
		'options'=>[
			'accept'=>'application/pdf'
		],
		'pluginOptions'=>$pluginOptions,
		'pluginEvents'=>[
			'fileclear'=>'function(){$("#attachment1Changed").val("true")}',
			'fileloaded'=>'function(){$("#attachment1Changed").val("true")}',
		]
	]) ?>

    <input type="hidden" name="attachment2Changed" value="false" id="attachment2Changed">
	<?= $form->field($model, 'attachment2')->widget(FileInput::classname(),[
		'options'=>[
			'accept'=>'application/pdf'
		],
		'pluginOptions'=>[
			'showUpload'=>false,
		],
		'pluginEvents'=>[
			'fileclear'=>'function(){$("#attachment2Changed").val("true")}',
			'fileloaded'=>'function(){$("#attachment2Changed").val("true")}',
		]
	]) ?>

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
			'initialPreview'=>[Html::img(Yii::getAlias('@web')."/img/carrera/".$model->picture, ['class'=>'file-preview-image', 'alt'=>$model->picture])], 
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
	
	<input type="hidden" name="sponsorChanged" value="false" id="sponsorChanged">
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
			'initialPreview'=>[Html::img(Yii::getAlias('@web')."/img/carrera/auspiciante/".$model->picture, ['class'=>'file-preview-image', 'alt'=>$model->picture])], 
			'initialPreviewShowDelete'=>true,
			'previewFileType'=>'image',
		];
	} ?>
	<?= $form->field($model, 'sponsor')->widget(FileInput::classname(),[
		'options'=>[
			'accept'=>'image/*'
		],
		'pluginOptions'=>$pluginOptions,
		'pluginEvents'=>[
			'fileclear'=>'function(){$("#sponsorChanged").val("true")}',
			'fileloaded'=>'function(){$("#sponsorChanged").val("true")}',
		]
	]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'PENDING' => 'PENDING', 'FINISHED' => 'FINISHED', 'INACTIVE' => 'INACTIVE', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'categories')->widget(Select2::classname(),[
    	'data'=>$categories,
    	'language'=>'es',
    	'options'=>['multiple'=>true]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\tinymce\TinyMce;
use kartik\datetime\DateTimePicker;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Race */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="race-form">

    <?php $form = ActiveForm::begin(); ?>

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

    <?= $form->field($model, 'attachment1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'attachment2')->textInput(['maxlength' => true]) ?>

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

    <?= $form->field($model, 'status')->dropDownList([ 'PENDING' => 'PENDING', 'FINISHED' => 'FINISHED', 'INACTIVE' => 'INACTIVE', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

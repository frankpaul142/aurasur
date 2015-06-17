<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Race */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="race-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sport_id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'place')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'cost')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'attachment1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'attachment2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'picture')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'PENDING' => 'PENDING', 'FINISHED' => 'FINISHED', 'INACTIVE' => 'INACTIVE', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'creation_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">
    <?php if (Yii::$app->session->hasFlash('errorUser')) {
        echo Yii::$app->session->getFlash('errorUser');
    } ?>
    
    <?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'type')->dropDownList([ 'ADMIN' => 'ADMIN', 'RACER' => 'RACER', 'ORGANIZER' => 'ORGANIZER', 'SALE' => 'SALE', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sex')->dropDownList([ 'MALE' => 'MALE', 'FEMALE' => 'FEMALE', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'birthdate')->widget(DatePicker::className(),['removeButton'=>false, 'pluginOptions'=>['format'=>'yyyy-mm-dd']]) ?>

    <?= $form->field($model, 'identity')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cellphone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'size')->dropDownList([ 'XS' => 'XS', 'S' => 'S', 'M' => 'M', 'L' => 'L', 'XL' => 'XL', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'contact_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'insurance')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'policy')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'blood_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'medical_history')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'recent_injuries')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'surgeries')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'allergies')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'ACTIVE' => 'ACTIVE', 'INACTIVE' => 'INACTIVE', 'CONFIRMING' => 'CONFIRMING', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

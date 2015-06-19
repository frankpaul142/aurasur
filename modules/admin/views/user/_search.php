<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'lastname') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'sex') ?>

    <?php // echo $form->field($model, 'birthdate') ?>

    <?php // echo $form->field($model, 'identity') ?>

    <?php // echo $form->field($model, 'cellphone') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'size') ?>

    <?php // echo $form->field($model, 'password') ?>

    <?php // echo $form->field($model, 'contact_name') ?>

    <?php // echo $form->field($model, 'contact_phone') ?>

    <?php // echo $form->field($model, 'insurance') ?>

    <?php // echo $form->field($model, 'policy') ?>

    <?php // echo $form->field($model, 'blood_type') ?>

    <?php // echo $form->field($model, 'medical_history') ?>

    <?php // echo $form->field($model, 'recent_injuries') ?>

    <?php // echo $form->field($model, 'surgeries') ?>

    <?php // echo $form->field($model, 'allergies') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'creation_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

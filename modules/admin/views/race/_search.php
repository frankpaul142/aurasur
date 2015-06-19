<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RaceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="race-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'sport_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'place') ?>

    <?= $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'cost') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'attachment1') ?>

    <?php // echo $form->field($model, 'attachment2') ?>

    <?php // echo $form->field($model, 'picture') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'creation_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

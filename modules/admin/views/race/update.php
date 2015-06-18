<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Race */

$this->title = 'Update Race: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Races', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="race-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'sports'=>$sports,
    ]) ?>

</div>

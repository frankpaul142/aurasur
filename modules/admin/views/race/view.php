<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Race */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Races', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="race-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'sport_id',
            'name',
            'place',
            'date',
            'cost',
            'description:ntext',
            'attachment1',
            'attachment2',
            'picture',
            'status',
            'creation_date',
        ],
    ]) ?>

</div>

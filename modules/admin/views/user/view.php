<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <?php if(Yii::$app->session->hasFlash('userCreated')){
        echo 'La contraseña guardada es la cédula/pasaporte';
    } ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?php if(Yii::$app->user->identity->isAdmin) { ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    <?php } else { ?>
        <?= Html::a('Crear Otro', ['create'], ['class' => 'btn btn-primary']) ?>
    <?php } ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
			'type',
            'name',
            'lastname',
            'username',
            'sex',
            'birthdate',
            'identity',
            'cellphone',
            'address',
            'size',
            'contact_name',
            'contact_phone',
            'insurance',
            'policy',
            'blood_type',
            'medical_history',
            'recent_injuries',
            'surgeries',
            'allergies',
            'status',
            'creation_date',
        ],
    ]) ?>

</div>

<?php
/* @var $this yii\web\View */
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

$this->title=$model->name;

$this->registerJs('
	$("#btn-resultado").click(function(){
	   $("#info-carrera").fadeIn();
	   $(".tit-competencias label").fadeIn();
	   $(".tit-competencias select").fadeIn();
	   $("#info-galeria").hide();
	}); 
	$("#btn-galeria").click(function(){
	   $("#info-galeria").fadeIn();
	   $("#info-carrera").hide();
	   $(".tit-competencias label").hide();
	   $(".tit-competencias select").hide();
	});
');
?>

<div class="info-perfiles">
	<div class="links-perfil">
        <a href="javascript:void(0)" id="btn-galeria" class="f-right"><img src="<?= Yii::getAlias('@web') ?>/img/ico-perfil.svg" alt="perfil"/><span>Galería</span></a>
    	<a href="javascript:void(0)" id="btn-resultado" class="f-right"><img src="<?= Yii::getAlias('@web') ?>/img/ico-galeria.svg" alt="perfil"/><span>Ver Resultado</span></a>
    </div>
    <div class="tit-competencias">
    	<span><?= $model->name ?></span>
    </div>
    <div id="info-carrera">
        <?= GridView::widget([
	        'dataProvider' => $dataProvider,
	        'filterModel' => $searchModel,
	        'export'=>false,
	        'pjax'=>true,
	        'bootstrap'=>false,
	        'floatHeader'=>true,
	        'layout'=>'{items}{summary}{pager}',
	        // 'showPageSummary' => true,
	        'columns' => [
	            [
				    'class'=>'kartik\grid\SerialColumn',
				    'headerOptions'=>['class'=>'table-header'],
	            	'contentOptions'=>['class'=>'table-info txt-c'],
				    'width'=>'36px',
				    'header'=>'',
				],
	            ['attribute'=>'position_general',
	            'headerOptions'=>['class'=>'table-header'],
	            'contentOptions'=>['class'=>'table-info txt-c'],],
	            [
		            'attribute'=>'user.name',
		            'value'=>function ($model, $key, $index, $widget){
		            	return $model->user->name.' '.$model->user->lastname;
		            },
		            'headerOptions'=>['class'=>'table-header'],
		            'contentOptions'=>['class'=>'table-info txt-c'],
		            /*'filterType'=>GridView::FILTER_SELECT2,
				    'filter'=>ArrayHelper::map(Author::find()->orderBy('name')->asArray()->all(), 'id', 'name'), 
				    'filterWidgetOptions'=>[
				        'pluginOptions'=>['allowClear'=>true],
				    ],
				    'filterInputOptions'=>['placeholder'=>'Any author'],*/
	            ],
	            [
		            'attribute'=>'category_id',
		            'value'=>'category.name',
		            'headerOptions'=>['class'=>'table-header'],
		            'contentOptions'=>['class'=>'table-info txt-c'],
		            'filterType'=>GridView::FILTER_SELECT2,
		            'filter'=>ArrayHelper::merge([''=>'Todas'],ArrayHelper::map($model->categories, 'id', 'name')),
	            ],
	            ['attribute'=>'time1',
	            'headerOptions'=>['class'=>'table-header'],
	            'contentOptions'=>['class'=>'table-info txt-c'],],
	        ],
	    ]); ?>
    	
    </div>
    <div id="info-galeria">
    	<div class="cont-galeria">
            <div class="fotorama" data-width="100%" data-loop="true">
            <?php foreach ($model->galleries as $gallery) { ?>
                <img src="<?= Yii::getAlias('@web') ?>/img/galeria/<?= $gallery->picture ?>" alt="imagen galeria"/>
            <?php } ?>
            </div>
        </div>
    </div>
</div>
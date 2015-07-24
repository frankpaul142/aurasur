<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Race */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Reportes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$script='
$("#imprimir").click(function(ev){
	ev.preventDefault();
	window.print();
})
';
foreach ($data as $c => $graph) {
	$script.='var data'.$c.'=[';
	foreach ($graph['data'] as $label => $val) {
		$script.='["'.$val.' -> '.$label.'",'.$val.'],';
	}
	$script.='];
	$.jqplot("chart'.$c.'",[data'.$c.'],
	{
		title: "'.$graph['title'].'",
		seriesDefaults:{
			renderer: jQuery.jqplot.PieRenderer,
			rendererOptions:{
				showDataLabels: true,
			}
		},
		legend:{
			show: true,
			location: "e",
		}
	});
	';
}

$this->registerJs($script);
?>
<div class="race-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
    	<?= date('Y-m-d H:i:s') ?>
    </div>
    <div class="row">
	    <?php foreach ($data as $c=>$graph) { ?>
	    <div class="col-md-6">
	        <div id="chart<?= $c ?>"></div>
	    </div>
	    <?php } ?>
    </div>
    <div class="row">
    	<button id="imprimir" class="btn btn-primary">Imprimir</button>
    </div>

</div>

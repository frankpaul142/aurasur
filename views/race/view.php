<?php
/* @var $this yii\web\View */
$this->title=$model->name;
?>

<div class="info-carrerasinternas back-black">
	<!-- INFO CARREARAS -->
	<h1 class="h1-running"><?= $model->name ?></h1>
	<div class="header-infcarreras">        
		<img src="<?= Yii::getAlias('@web') ?>/img/carrera/<?= $model->picture ?>" alt="imagen carrera"/>
	    <div class="txt-carrera">
	    	<strong>Lugar:</strong> <?= $model->place ?><br/><br/>
	        <strong>Fecha:</strong> <?= Yii::$app->formatter->asDate($model->date,"d 'de' MMMM 'de' y") ?><br/><br/>
	        <strong>Valor:</strong> <?= $model->cost ?> dólares
	    </div>
	</div>
	<div class="link-infcarreras">
		<?php if($model->attachment1){ ?>
			<a href="#" class="link-informacion"><img src="<?= Yii::getAlias('@web') ?>/img/ico-descargar.svg" alt="descargar"/> <span>Descargar Información</span></a>
		<?php } ?>
		<?php if($model->attachment1){ ?>
	    	<a href="#" class="link-informacion"><img src="<?= Yii::getAlias('@web') ?>/img/ico-descargar.svg" alt="descargar"/> <span>Terminos y Condiciones</span></a>
	    <?php } ?>
	    <?php if($model->status=='PENDING'){ ?>
        	<a href="#" class="ver-inscribirse">Inscribirse</a>
        <?php } elseif($model->status=='FINISHED') { ?>
        	<a href="#" class="ver-resultados">Ver Resultados</a>
        <?php } ?>
	</div>

	<div class="infor-carrera">
		<?= $model->description ?>
		<br />
		<span><strong>Auspiciantes:</strong></span>
		<img src="<?= Yii::getAlias('@web') ?>/img/carrera/auspiciante/<?= $model->picture ?>" alt="auspiciantes"/>
	</div>
	<!-- -->           
</div>

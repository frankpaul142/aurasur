<?php
/* @var $this yii\web\View */
$this->title=$model->name;

$this->registerJs('
$("#cont-carreras").owlCarousel();
var owl = $("#cont-carreras");

$(".next").click(function(){
	owl.trigger("owl.next");
});
$(".prev").click(function(){
owl.trigger("owl.prev");
});
');
?>

<div class="cont-carrerasinternas">
  	<a href="#" id="flechaL" class="prev"><img src="<?= Yii::getAlias('@web') ?>/img/ico-flechal.svg"/></a>
    <div id="cont-carreras" class="owl-carousel">
    <?php foreach ($model->races as $race) { ?>
    	<!-- contenedor carreras -->
        <div class="secc sep-compt">
        	<div class="back-black">
            	<div class="img-headerc">
            		<img src="<?= Yii::getAlias('@web') ?>/img/back-running.png"/>
                	<div class="l-diagonal"><?= $race->name ?></div>
                </div>
                <div class="img-carrera">
                	<img src="<?= Yii::getAlias('@web') ?>/img/carrera/<?= $race->picture ?>" alt="carrera"/>
                </div>
                <div class="inf-carrera">
                	<strong>Lugar: </strong><?= $race->place ?><br/><br/>
                    <strong>Fecha: </strong><?php setlocale(LC_TIME, "es_ES.UTF-8"); echo strftime('%d de %B de %Y',strtotime($race->date)); ?><br/><br/>
                    <strong>Valor: </strong><?= $race->cost ?> dólares
                </div>
                <a href="#" class="ver-resultados">Ver Resultados</a>
            </div>
        </div>
    <?php } ?>
    </div>
    <a href="#" id="flechaR" class="next"><img src="<?= Yii::getAlias('@web') ?>/img/ico-flechar.svg"/></a>
</div>
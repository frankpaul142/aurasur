<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title='Carreras | Aurasur';

$this->registerJs('
// $("#cont-carreras").owlCarousel();
$(".owl-carousel").owlCarousel();
/*var owl = $("#cont-carreras");

$(".next").click(function(){
	owl.trigger("owl.next");
});
$(".prev").click(function(){
	owl.trigger("owl.prev");
});*/
');
?>

<div class="cont-carrerasinternas">
    <!-- -->
        <h1>*Selecciona tu deporte.</h1>
        <ul class="menu-carreras">
            <!-- <li><a href="#" id="btn-aventura" class="deporte-selected">AVENTURA</a></li> -->
            <?php foreach ($sports as $i => $sport) { ?>
            <li><a href="#<?= $sport->name ?>" style="background-color:<?= $sport->color ?>"><?= $sport->name ?></a></li>
            <?php } ?>
        </ul>
    <!-- -->
    <?php foreach ($sports as $i => $sport) { ?>
        <!-- <a href="javascript:void(0)" id="flechaL" class="prev"><img src="<?= Yii::getAlias('@web') ?>/img/ico-flechal.svg"/></a> -->
        <div id="<?= $sport->name ?>" class="owl-carousel">
        <?php foreach ($sport->races as $race) { ?>
            <!-- contenedor carreras -->
            <div class="secc sep-compt">
                <div class="back-black">
                    <a href="<?= Url::to(['race/view','id'=>$race->id]) ?>">
                        <div class="img-headerc">
                            <img src="<?= Yii::getAlias('@web') ?>/img/back/<?= $sport->picture ?>"/>
                            <div class="l-diagonal"><?= $race->name ?></div>
                        </div>
                        <div class="img-carrera">
                            <img src="<?= Yii::getAlias('@web') ?>/img/carrera/<?= $race->picture ?>" alt="carrera"/>
                        </div>
                    </a>
                    <div class="inf-carrera">
                        <strong>Lugar: </strong><?= $race->place ?><br/><br/>
                        <strong>Fecha: </strong><?= Yii::$app->formatter->asDate($race->date,"d 'de' MMMM 'de' y") ?><br/><br/>
                        <strong>Valor: </strong><?= $race->cost ?> dólares
                    </div>
                    <?php if($race->status=='PENDING'){ ?>
                        <a href="#" class="ver-inscribirse">Inscribirse</a>
                    <?php } elseif($race->status=='FINISHED') { ?>
                        <a href="<?= Url::to(['race/results','id'=>$race->id]) ?>" class="ver-resultados">Ver Resultados</a>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
        </div>
        <!-- <a href="javascript:void(0)" id="flechaR" class="next"><img src="<?= Yii::getAlias('@web') ?>/img/ico-flechar.svg"/></a> -->
    <?php } ?>
</div>
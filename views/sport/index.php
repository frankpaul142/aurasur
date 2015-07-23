
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

// grab the initial top offset of the navigation 
var sticky_navigation_offset_top = $("#menu-carreras").offset().top;
 
// our function that decides weather the navigation bar should have "fixed" css position or not.
var sticky_navigation = function(){
    var scroll_top = $(window).scrollTop(); // our current vertical position from the top
    // if we"ve scrolled more than the navigation, change its position to fixed to stick to top,
    // otherwise change it back to relative
    if (scroll_top > sticky_navigation_offset_top) { 
        $("#menu-carreras").css({ "position": "fixed", "top":46, "left":"10%", "z-index":1000,"width":"91%","background-color":"#939393", });
    } else {
        $("#menu-carreras").css({ "position": "relative", "width":"100%", "top":0, "left":0,"background-color":"transparent" }); 
    }   
};
// run our function on load
sticky_navigation();
// and run it again every time you scroll
$(window).scroll(function() {
     sticky_navigation();
});

$(".sport").each(function(i) {
    var position = $(this).position();
    // console.log($(this).attr("id"));
    // console.log(position);
    // console.log("min: " + position.top + " / max: " + parseInt(position.top + $(this).height()));
    $(this).scrollspy({
        min: position.top+46,
        max: position.top+46 + $(this).height(),
        onEnter: function(element, position) {
            if(console) console.log("entering " +  element.id);
            //console.log(position);
            $("#b"+element.id).addClass("deporte-selected");
        },
        onLeave: function(element, position) {
            if(console) console.log("leaving " +  element.id);
            //console.log(position);
        	$("#b"+element.id).removeClass("deporte-selected");
        }
    });
});
');
?>

<div class="cont-carrerasinternas">
    <!-- -->
        <h1>*Selecciona tu deporte.</h1>
        <ul class="menu-carreras" id="menu-carreras">
            <!-- <li><a href="#" id="btn-aventura" class="deporte-selected">AVENTURA</a></li> -->
            <?php foreach ($sports as $i => $sport) { ?>
            <li><a id="b<?= $sport->name ?>" href="#<?= $sport->name ?>" style="background-color:<?= $sport->color ?>"><?= $sport->name ?></a></li>
            <?php } ?>
        </ul>
    <!-- -->
    <?php foreach ($sports as $i => $sport) { ?>
        <!-- <a href="javascript:void(0)" id="flechaL" class="prev"><img src="<?= Yii::getAlias('@web') ?>/img/ico-flechal.svg"/></a> -->
        <div id="<?= $sport->name ?>" class="owl-carousel sport">
	        <?php if(!isset($sport->races[0])){
	        	echo "No hay carreras de este deporte por el momento.";
	        }
	        else { ?>
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
		                        <a href="<?= Url::to(['race/view','id'=>$race->id]) ?>" class="ver-inscribirse">Ver Información</a>
		                    <?php } elseif($race->status=='FINISHED') { ?>
		                        <a href="<?= Url::to(['race/view','id'=>$race->id]) ?>" class="ver-resultados">Ver Información</a>
		                    <?php } ?>
		                </div>
		            </div>
		        <?php } ?>
	        <?php } ?>
        </div>
        <!-- <a href="javascript:void(0)" id="flechaR" class="next"><img src="<?= Yii::getAlias('@web') ?>/img/ico-flechar.svg"/></a> -->
    <?php } ?>
</div>       

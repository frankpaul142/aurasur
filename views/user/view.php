<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title=$model->name;
$this->registerJs('
$("#btn-miperfil").click(function(){
   $("#mi-perfil").fadeIn();
   $("#mis-inscripciones").hide();
   $("#historial-carreras").hide();
   }); 
$("#btn-inscripciones").click(function(){
   $("#mis-inscripciones").fadeIn();
   $("#mi-perfil").hide();
   $("#historial-carreras").hide();
   }); 
$("#btn-carreras").click(function(){
   $("#historial-carreras").fadeIn();
   $("#mi-perfil").hide();
   $("#mis-inscripciones").hide();	   
   });
');
?>

<div class="info-perfiles">
	<div class="links-perfil">
        <a href="javascript:void(0)" id="btn-miperfil"><img src="<?= Yii::getAlias('@web') ?>/img/ico-perfil.svg" alt="perfil"/><span>Mi Perfil</span></a>
        <a href="javascript:void(0)" id="btn-inscripciones"><img src="<?= Yii::getAlias('@web') ?>/img/ico-inscripciones.svg" alt="perfil"/><span>Mis Inscripciones</span></a>
        <a href="javascript:void(0)" id="btn-carreras"><img src="<?= Yii::getAlias('@web') ?>/img/ico-historial.svg" alt="perfil"/><span>Historial de Carreras</span></a>
    </div>
    <h1><?= $model->name.' '.$model->lastname ?></h1>
    <div id="mi-perfil">
    	<div class="campos">
        	<div class="infor-ma"><?= $model->getAttributeLabel('identity') ?></div>	
            <div class="infor-actual"><?= $model->identity ?></div>	
        </div>
    	<div class="campos">
        	<div class="infor-ma"><?= $model->getAttributeLabel('username') ?></div>	
            <div class="infor-actual"><?= $model->username ?></div>	
        </div>
        <div class="campos">
        	<div class="infor-ma"><?= $model->getAttributeLabel('cellphone') ?></div>	
            <div class="infor-actual"><?= $model->cellphone ?></div>	
            <div class="infor-cambiar"><input type="text"/></div>	
        </div>
        <div class="campos">
        	<div class="infor-ma"><?= $model->getAttributeLabel('address') ?></div>	
            <div class="infor-actual"><?= $model->address ?></div>	
            <div class="infor-cambiar"><input type="text"/></div>	
        </div>
        <div class="campos">
        	<div class="infor-ma"><?= $model->getAttributeLabel('size') ?></div>	
            <div class="infor-actual"><?= $model->size ?></div>	
            <div class="infor-cambiar">
            	<select>
                	<option>XS</option>
                    <option>S</option>
                    <option>M</option>
                    <option>L</option>
                    <option>XL</option>
                </select>
            </div>	
        </div>
        <div class="campos">
        	<div class="infor-ma">Contraseña:</div>	
            <div class="infor-actual">************</div>	
            <div class="infor-cambiar"><input type="text"/></div>	
        </div>
    </div>
    <div id="mis-inscripciones">
    	<table width="100%" cellpadding="0" cellspacing="0">
        	<tr>
            	<td class="table-header">Mis Competencias</td>
                <td class="table-header esc-tabla">Deporte</td>
                <td class="table-header esc-tabla">Categoría</td>
                <td class="table-header">Fecha</td>
                <td class="table-header">&nbsp;</td>
            </tr>
            <?php foreach ($model->racers as $racer) {
            	if($racer->race->status=='PENDING') { ?>
		            <tr>
		            	<td class="table-info"><?= $racer->race->name ?></td>
		                <td class="table-info txt-c esc-tabla"><?= $racer->race->sport->name ?></td>
		                <td class="table-info txt-c esc-tabla"><?= $racer->category->name ?></td>
		                <td class="table-info txt-c"><?= Yii::$app->formatter->asDate($racer->race->date,"dd/MM/y - HH:mm") ?></td>
		                <td class="table-info txt-c"><a href="<?= Url::to(['race/view','id'=>$racer->race_id]) ?>">Información</a></td>
		            </tr>
            	<?php }
            } ?>
        </table>
    </div>
    <!-- -->
    <div id="historial-carreras">
    	<table width="100%" cellpadding="0" cellspacing="0">
        	<tr>
            	<td class="table-header">Mis Competencias</td>
                <td class="table-header esc-tabla">Deporte</td>
                <td class="table-header esc-tabla">Categoría</td>
                <td class="table-header">Fecha</td>
                <td class="table-header">&nbsp;</td>
            </tr>
            <?php foreach ($model->racers as $racer) {
            	if($racer->race->status=='FINISHED') { ?>
		            <tr>
		            	<td class="table-info"><?= $racer->race->name ?></td>
		                <td class="table-info txt-c esc-tabla"><?= $racer->race->sport->name ?></td>
		                <td class="table-info txt-c esc-tabla"><?= $racer->category->name ?></td>
		                <td class="table-info txt-c"><?= Yii::$app->formatter->asDate($racer->race->date,"dd/MM/y - HH:mm") ?></td>
		                <td class="table-info txt-c"><a href="<?= Url::to(['race/view','id'=>$racer->race_id]) ?>">Resultados</a></td>
		            </tr>
		            <tr>
		            	<td colspan="5">
		                	<div class="resultado-com">
		                		<?= $racer->race->place ?>  /  <?= Yii::$app->formatter->asDate($racer->race->date,"EEEE d 'de' MMMM y") ?><br/>
		                    	Pos: <?= $racer->position_general ?>	Tiempo de Carrera:  <?= $racer->time1 ?>
		                    </div>
		                </td>
		            <tr/>
            	<?php }
            } ?>
        </table>
    </div>
    <!-- -->
    <a href="<?= Url::to(['site/logout']) ?>" data-method="post">Cerrar Sesión</a>
</div>

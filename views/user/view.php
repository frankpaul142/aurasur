<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

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
/*$("#btn-carreras").click(function(){
   $("#historial-carreras").fadeIn();
   $("#mi-perfil").hide();
   $("#mis-inscripciones").hide();	   
   });*/

var mas=false;
$("#div_mas_info").hide();
$("#mas_info").click(function(ev){
	ev.preventDefault();
	if(!mas){
		$("#div_mas_info").show();
		$(this).text("- Menos Información");
		mas=true;
	}
	else{
		$("#div_mas_info").hide();
		$(this).text("+ Más Información");
		mas=false;
	}
});
');
?>

<div class="info-perfiles">
	<div class="links-perfil">
        <a href="javascript:void(0)" id="btn-miperfil"><img src="<?= Yii::getAlias('@web') ?>/img/ico-perfil.svg" alt="perfil"/><span>Mi Perfil</span></a>
        <a href="javascript:void(0)" id="btn-inscripciones"><img src="<?= Yii::getAlias('@web') ?>/img/ico-inscripciones.svg" alt="perfil"/><span>Mis Inscripciones</span></a>
        <!-- <a href="javascript:void(0)" id="btn-carreras"><img src="<?= Yii::getAlias('@web') ?>/img/ico-historial.svg" alt="perfil"/><span>Historial de Carreras</span></a> -->
    </div>
    <h1><?= $model->name.' '.$model->lastname ?></h1>
    <div id="mi-perfil">
    <?php $form = ActiveForm::begin(); ?>
    	<div class="campos">
        	<div class="infor-ma"><?= $model->getAttributeLabel('identity') ?></div>	
            <div class="infor-actual"><?= $model->identity ?></div>	
        </div>
    	<div class="campos">
        	<div class="infor-ma"><?= $model->getAttributeLabel('username') ?></div>	
            <div class="infor-actual"><?= $model->username ?></div>
            <div class="infor-cambiar">Actualizar datos</div> 
        </div>
        <div class="campos">
        	<div class="infor-ma"><?= $model->getAttributeLabel('cellphone') ?></div>	
            <div class="infor-actual"><?= $model->cellphone ?></div>	
            <div class="infor-cambiar"><input type="text" name="User[cellphone]" /></div>	
        </div>
        <div class="campos">
        	<div class="infor-ma"><?= $model->getAttributeLabel('address') ?></div>	
            <div class="infor-actual"><?= $model->address ?></div>	
            <div class="infor-cambiar"><input type="text" name="User[address]" /></div>	
        </div>
        <div class="campos">
        	<div class="infor-ma"><?= $model->getAttributeLabel('size') ?></div>	
            <div class="infor-actual"><?= $model->size ?></div>	
            <div class="infor-cambiar">
            	<select name="User[size]">
            		<option value="">Selecciona una talla</option>
                	<option value="XS">XS</option>
                    <option value="S">S</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                </select>
            </div>	
        </div>
        <div class="campos">
            <div class="infor-actual"><button id="mas_info" class="btn btn-default">+ Más información</button></div>
        </div>
        <div id="div_mas_info">
        <div class="campos">
            <div class="infor-ma"><?= $model->getAttributeLabel('password') ?></div> 
            <div class="infor-actual">************</div>    
            <div class="infor-cambiar"><input type="password" name="User[password]" /></div>   
        </div>
        <div class="campos">
            <div class="infor-ma"><?= $model->getAttributeLabel('birthdate') ?></div> 
            <div class="infor-actual"><?= $model->birthdate ?></div>  
            <div class="infor-cambiar"><?= DatePicker::widget(['name'=>'User[birthdate]','removeButton'=>false, 'pluginOptions'=>['format'=>'yyyy-mm-dd','autoclose'=>true]]) ?></div>   
        </div>
        <div class="campos">
            <div class="infor-ma"><?= $model->getAttributeLabel('contact_name') ?></div> 
            <div class="infor-actual"><?= $model->contact_name ?></div>  
            <div class="infor-cambiar"><input type="text" name="User[contact_name]" /></div>   
        </div>
        <div class="campos">
            <div class="infor-ma"><?= $model->getAttributeLabel('contact_phone') ?></div> 
            <div class="infor-actual"><?= $model->contact_phone ?></div>  
            <div class="infor-cambiar"><input type="text" name="User[contact_phone]" /></div>   
        </div>
        <div class="campos">
            <div class="infor-ma"><?= $model->getAttributeLabel('insurance') ?></div> 
            <div class="infor-actual"><?= $model->insurance ?></div>  
            <div class="infor-cambiar"><input type="text" name="User[insurance]" /></div>   
        </div>
        <div class="campos">
            <div class="infor-ma"><?= $model->getAttributeLabel('policy') ?></div> 
            <div class="infor-actual"><?= $model->policy ?></div>  
            <div class="infor-cambiar"><input type="text" name="User[policy]" /></div>   
        </div>
        <div class="campos">
            <div class="infor-ma"><?= $model->getAttributeLabel('blood_type') ?></div> 
            <div class="infor-actual"><?= $model->blood_type ?></div>  
            <div class="infor-cambiar"><input type="text" name="User[blood_type]" /></div>   
        </div>
        <div class="campos">
            <div class="infor-ma"><?= $model->getAttributeLabel('medical_history') ?></div> 
            <div class="infor-actual"><?= $model->medical_history ?></div>  
            <div class="infor-cambiar"><input type="text" name="User[medical_history]" /></div>   
        </div>
        <div class="campos">
            <div class="infor-ma"><?= $model->getAttributeLabel('recent_injuries') ?></div> 
            <div class="infor-actual"><?= $model->recent_injuries ?></div>  
            <div class="infor-cambiar"><input type="text" name="User[recent_injuries]" /></div>   
        </div>
        <div class="campos">
            <div class="infor-ma"><?= $model->getAttributeLabel('surgeries') ?></div> 
            <div class="infor-actual"><?= $model->surgeries ?></div>  
            <div class="infor-cambiar"><input type="text" name="User[surgeries]" /></div>   
        </div>
        <div class="campos">
            <div class="infor-ma"><?= $model->getAttributeLabel('allergies') ?></div> 
            <div class="infor-actual"><?= $model->allergies ?></div>  
            <div class="infor-cambiar"><input type="text" name="User[allergies]" /></div>   
        </div>
        </div>
        <div class="campos">
            <div class="infor-ma">&nbsp;</div>
            <div class="infor-actual">&nbsp;</div>
            <div class="infor-cambiar"><button style="float:right" class="btn btn-success">Guardar</button></div>
        </div>
    <?php ActiveForm::end(); ?>
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
    <!-- <div id="historial-carreras">
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
    </div> -->
    <!-- -->
    <a href="<?= Url::to(['site/logout']) ?>" data-method="post">Cerrar Sesión</a>
</div>

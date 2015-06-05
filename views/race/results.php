<?php
/* @var $this yii\web\View */
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
        <label>Filtrar Categoría:</label>
        <select>
        	<option>General</option>
            <option>Hombres - Master B</option>
            <option>Mujeres - Master B</option>
            <option>Senior</option>
        </select>
    </div>
    <div id="info-carrera">
    	<table width="100%" cellpadding="0" cellspacing="0">
        	<tr>
            	<td class="table-header">Pos.</td>
                <td class="table-header">Deportista</td>
                <td class="table-header">Categoría</td>
                <td class="table-header">Tiempo en Carrera</td>
            </tr>
            <tr>
            	<td class="table-info txt-c">1</td>
                <td class="table-info txt-c">Pablo Martinez Espinosa</td>
                <td class="table-info txt-c">Hombres - Master B</td>
                <td class="table-info txt-c">00 : 03 : 45 : 27</td>
            </tr>
            <tr>
            	<td class="table-info txt-c">1</td>
                <td class="table-info txt-c">Pablo Martinez Espinosa</td>
                <td class="table-info txt-c">Hombres - Master B</td>
                <td class="table-info txt-c">00 : 03 : 45 : 27</td>
            </tr>
            <tr>
            	<td class="table-info txt-c">1</td>
                <td class="table-info txt-c">Pablo Martinez Espinosa</td>
                <td class="table-info txt-c">Hombres - Master B</td>
                <td class="table-info txt-c">00 : 03 : 45 : 27</td>
            </tr>
            <tr>
            	<td class="table-info txt-c">1</td>
                <td class="table-info txt-c">Pablo Martinez Espinosa</td>
                <td class="table-info txt-c">Hombres - Master B</td>
                <td class="table-info txt-c">00 : 03 : 45 : 27</td>
            </tr>
            <tr>
            	<td class="table-info txt-c">1</td>
                <td class="table-info txt-c">Pablo Martinez Espinosa</td>
                <td class="table-info txt-c">Hombres - Master B</td>
                <td class="table-info txt-c">00 : 03 : 45 : 27</td>
            </tr>
            <tr>
            	<td class="table-info txt-c">1</td>
                <td class="table-info txt-c">Pablo Martinez Espinosa</td>
                <td class="table-info txt-c">Hombres - Master B</td>
                <td class="table-info txt-c">00 : 03 : 45 : 27</td>
            </tr>
            <tr>
            	<td class="table-info txt-c">1</td>
                <td class="table-info txt-c">Pablo Martinez Espinosa</td>
                <td class="table-info txt-c">Hombres - Master B</td>
                <td class="table-info txt-c">00 : 03 : 45 : 27</td>
            </tr>
            <tr>
            	<td class="table-info txt-c">1</td>
                <td class="table-info txt-c">Pablo Martinez Espinosa</td>
                <td class="table-info txt-c">Hombres - Master B</td>
                <td class="table-info txt-c">00 : 03 : 45 : 27</td>
            </tr>
            <tr>
            	<td class="table-info txt-c">1</td>
                <td class="table-info txt-c">Pablo Martinez Espinosa</td>
                <td class="table-info txt-c">Hombres - Master B</td>
                <td class="table-info txt-c">00 : 03 : 45 : 27</td>
            </tr>
            <tr>
            	<td class="table-info txt-c">1</td>
                <td class="table-info txt-c">Pablo Martinez Espinosa</td>
                <td class="table-info txt-c">Hombres - Master B</td>
                <td class="table-info txt-c">00 : 03 : 45 : 27</td>
            </tr>
            <tr>
            	<td class="table-info txt-c">1</td>
                <td class="table-info txt-c">Pablo Martinez Espinosa</td>
                <td class="table-info txt-c">Hombres - Master B</td>
                <td class="table-info txt-c">00 : 03 : 45 : 27</td>
            </tr>
            <tr>
            	<td class="table-info txt-c">1</td>
                <td class="table-info txt-c">Pablo Martinez Espinosa</td>
                <td class="table-info txt-c">Hombres - Master B</td>
                <td class="table-info txt-c">00 : 03 : 45 : 27</td>
            </tr>
            <tr>
            	<td class="table-info txt-c">1</td>
                <td class="table-info txt-c">Pablo Martinez Espinosa</td>
                <td class="table-info txt-c">Hombres - Master B</td>
                <td class="table-info txt-c">00 : 03 : 45 : 27</td>
            </tr>
            <tr>
            	<td class="table-info txt-c">1</td>
                <td class="table-info txt-c">Pablo Martinez Espinosa</td>
                <td class="table-info txt-c">Hombres - Master B</td>
                <td class="table-info txt-c">00 : 03 : 45 : 27</td>
            </tr>
            <tr>
            	<td class="table-info txt-c">1</td>
                <td class="table-info txt-c">Pablo Martinez Espinosa</td>
                <td class="table-info txt-c">Hombres - Master B</td>
                <td class="table-info txt-c">00 : 03 : 45 : 27</td>
            </tr>
            <tr>
            	<td class="table-info txt-c">1</td>
                <td class="table-info txt-c">Pablo Martinez Espinosa</td>
                <td class="table-info txt-c">Hombres - Master B</td>
                <td class="table-info txt-c">00 : 03 : 45 : 27</td>
            </tr>
            <tr>
            	<td class="table-info txt-c">1</td>
                <td class="table-info txt-c">Pablo Martinez Espinosa</td>
                <td class="table-info txt-c">Hombres - Master B</td>
                <td class="table-info txt-c">00 : 03 : 45 : 27</td>
            </tr>
            <tr>
            	<td class="table-info txt-c">1</td>
                <td class="table-info txt-c">Pablo Martinez Espinosa</td>
                <td class="table-info txt-c">Hombres - Master B</td>
                <td class="table-info txt-c">00 : 03 : 45 : 27</td>
            </tr>
            <tr>
            	<td class="table-info txt-c">1</td>
                <td class="table-info txt-c">Pablo Martinez Espinosa</td>
                <td class="table-info txt-c">Hombres - Master B</td>
                <td class="table-info txt-c">00 : 03 : 45 : 27</td>
            </tr>
        </table>
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
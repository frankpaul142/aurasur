<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use app\models\Racer;
use app\models\User;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->title=$model->name;
?>

<div class="info-carrerasinternas back-black">
	<!-- INFO CARREARAS -->
	<h1 class="h1-running"><?= $model->name ?></h1>
	<div class="header-infcarreras">        
		<img src="<?= Yii::getAlias('@web') ?>/img/carrera/<?= $model->picture ?>" alt="imagen carrera"/>
	    <div class="txt-carrera">
	    	<?php if(Yii::$app->user->isGuest) { ?>
	    		<strong>Inicia sesión para inscribirte</strong><br/>
	    	<?php } else {
	    		$user=User::findOne(Yii::$app->user->id) ?>
		    	<h1>DATOS DEL COMPETIDOR</h1>
	            <strong>Nombre:</strong> <?= $user->name.' '.$user->lastname ?><br/>
	            <strong>Cédula:</strong> <?= $user->identity ?><br/>
	            <strong>Email:</strong> <?= $user->username ?><br/>
	            <strong>Celular:</strong> <?= $user->cellphone ?><br/>
	            <strong>Talla de Camiseta:</strong> <?= $user->size ?><br/>
	        <?php } ?>
	    </div>
	</div>
	<div class="link-infcarreras">
	    <?php if($model->status=='PENDING'){
	    	if(!Yii::$app->user->isGuest){ 
	    		if(Racer::find()->where('user_id='.Yii::$app->user->id.' AND race_id='.$model->id)->one()) { ?>
		        	<a class="ver-inscribirse">Inscrito</a>
		        <?php } else {
		        	$form = ActiveForm::begin(); ?>
		        	<?= $form->field($racer,'user_id')->hiddenInput(['value'=>Yii::$app->user->id]) ?>
		        	<?= $form->field($racer,'category_id')->dropDownList(ArrayHelper::map($model->categories,'id','name'),['prompt'=>'Escoge una categoría']) ?>
		        	<?= Html::submitButton('Inscribirse', ['class' => 'ver-inscribirse']) ?>
		        	<?php ActiveForm::end();
	        	}
	        } else { ?>
	        	<a href="<?= Url::to(['site/login']) ?>" class="ver-inscribirse">Iniciar Sesión</a>
	        <?php }
        } elseif($model->status=='FINISHED') { ?>
        	<a href="#" class="ver-resultados">Ver Resultados</a>
        <?php } ?>
	</div>

	<div class="infor-carrera">
		<div class="txt-carrera">
        	<strong>Lugar:</strong> <?= $model->place ?><br/><br/>
	        <strong>Fecha:</strong> <?= Yii::$app->formatter->asDate($model->date,"d 'de' MMMM 'de' y") ?><br/><br/>
	        <strong>Valor:</strong> <?= $model->cost ?> dólares
    	</div>
    	<div class="link-infcarreras2">
	    	<?php if($model->attachment1 && $model->attachment1!=''){ ?>
				<a href="<?= Yii::getAlias('@web') ?>/img/carrera/adjunto/<?= $model->attachment1 ?>" class="link-informacion" download>
					<img src="<?= Yii::getAlias('@web') ?>/img/ico-descargar.svg" alt="descargar"/> <span>Descargar Información</span>
				</a>
			<?php } ?>
			<?php if($model->attachment2 && $model->attachment2!=''){ ?>
		    	<a href="<?= Yii::getAlias('@web') ?>/img/carrera/adjunto/<?= $model->attachment2 ?>" class="link-informacion" download>
					<img src="<?= Yii::getAlias('@web') ?>/img/ico-descargar.svg" alt="descargar"/> <span>Descargar Información</span>
				</a>
		    <?php } ?>
    	</div>
		<span>
        <br/>
        <br/>
		<h1>INFORMACIÓN DE LA CARRERA</h1>
		<?= $model->description ?>
		</span>
		<br />
		<br />
		<span><strong>Auspiciantes:</strong></span>
		<img src="<?= Yii::getAlias('@web') ?>/img/carrera/auspiciante/<?= $model->picture ?>" alt="auspiciantes"/>
	</div>
	<!-- -->           
</div>

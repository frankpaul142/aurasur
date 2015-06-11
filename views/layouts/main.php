<?php
use yii\helpers\Html;
use app\assets\AppAsset;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="description" content="Aurasur, competencias, deporte y aventura">
	<meta name="keywords" content="Aurasur, competencias, deporte y aventura">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
<div class="home-cont">
	<div class="home-cont-left">
		<div class="view-prof" id="btn-compromiso">
			<?php if(!Yii::$app->user->isGuest){ ?>
			<a href="<?= Url::to(['user/view','id'=>Yii::$app->user->id]) ?>">
			        <div class="prof-img"><img src="<?= Yii::getAlias('@web') ?>/img/img-22.png"></div>
			        <div class="prof-txt">Ver tu Perfil</div>
		    </a>
		    <?php } ?>
		</div>
	    <div class="prof-cont">
	    	<a href="<?= Yii::getAlias('@web') ?>">
	    		<img src="<?= Yii::getAlias('@web') ?>/img/logotipo.png" alt="logotipo aurasur"/>
	    	</a>
	        <span>
	        Aurasur, empresa organizadora de eventos y  competencias deportivas.
			<br/><br/>
	        Únete y accede a tu perfil, para poder inscribirte y participar.
	        <br/><br/>
	        ¡Ponte a Prueba!
	        </span>
	        <?php if(Yii::$app->user->isGuest){ ?>
		        <a href="<?= Url::to(['user/create']) ?>" class="bnt-memb">Membresía</a>
		        <a href="<?= Url::to(['site/login']) ?>" class="btn-iseccion">Inicia sesión</a>
	        <?php } else { ?>
	        	<a href="<?= Url::to(['user/view','id'=>Yii::$app->user->id]) ?>" class="bnt-memb">Ver tu perfil</a>
		        <a href="<?= Url::to(['site/logout']) ?>" data-method="post" class="btn-iseccion">Cerrar sesión</a>
	        <?php } ?>
	        <ul>
	        	<li><a href="#"><img src="<?= Yii::getAlias('@web') ?>/img/ico-face.svg" class="logo facebook"/></a></li>
	            <li><a href="#"><img src="<?= Yii::getAlias('@web') ?>/img/ico-twitter.svg" class="logo twitter"/></a></li>
	        </ul>
	        <div class="cierre-inf">
	        ® 2015 aurasur. Todos los Derechos Reservados. Desarrollado por  SHARE DITAL AGENCY.</div>
	    </div>
	</div>

	<?= $content ?>

</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

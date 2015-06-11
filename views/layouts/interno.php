<?php
use yii\helpers\Html;
use app\assets\AppAssetI;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

AppAssetI::register($this);
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
<div class="home-cont" id="f-atletismo">
  	<header class="cont-header">
  		<a href="<?= Yii::getAlias('@web') ?>">
  			<div class="logo-int"><img src="<?= Yii::getAlias('@web') ?>/img/logo.jpg" alt="logotipo"/></div>
  		</a>
  		<a href="javascript:goBack()">
	    	<div class="btn-volverm">
	    		<img src="<?= Yii::getAlias('@web') ?>/img/f-volver.svg"/>
	        	<span>Volver</span>
	    	</div>
    	</a>
    	<div class="ico-up">
	    	<a href="#"><img src="<?= Yii::getAlias('@web') ?>/img/ico-contacto.svg" alt="contacto"/></a>
	        <a href="#"><img src="<?= Yii::getAlias('@web') ?>/img/ico-ayuda.svg" alt="ayuda"/></a>
	        <a href="<?= Yii::$app->user->isGuest ? Url::to(['site/login']) : Url::to(['user/view','id'=>Yii::$app->user->id]) ?>"><img src="<?= Yii::getAlias('@web') ?>/img/ico-perfil.svg" alt="perfil"/></a>
    	</div>
  	</header>

	<?= $content ?>

	<div class="footer-int">
      	® 2015 aurasur.   Todos los Derechos Reservados.    Desarrollado por SHARE DITAL AGENCY
    </div>
</div>
<script type="text/javascript">
function goBack () {
	if(document.referrer==""){
		window.location="<?= Yii::getAlias('@web') ?>";
	}
	else{
		window.history.back();
	}
}
</script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

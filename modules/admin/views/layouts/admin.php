<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AdminAsset;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'Aurasur',
                'brandUrl' => Yii::$app->homeUrl.'admin',
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            if(!Yii::$app->user->isGuest){
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => [
                        ['label'=>'Categorias', 'url'=>['/admin/category']],
                        ['label'=>'Noticias', 'url'=>['/admin/news']],
                        ['label'=>'Tests', 'url'=>['/admin/test']],
                        ['label'=>'Preguntas EVA', 'url'=>['/admin/ask']],
                        ['label'=>'Horoscopo', 'url'=>['/admin/week']],
                        ['label'=>'Banners', 'url'=>['/admin/banner']],
                        ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/admin/default/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                    ],
                ]);
            }
            else{
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => [
                        ['label' => 'Login', 'url' => ['/admin/default/login']],
                    ],
                ]);
            }
            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; Aurasur <?= date('Y') ?></p>
            <p class="pull-right">Powered by <a href="http://share.com.ec">Share Ecuador</a></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = 'Aurasur';
?>
<div class="home-cont-right">
<?php foreach ($sports as $sport) { ?>
    <div class="secc">
        <div class="top-txt"><a href='<?= Yii::getAlias('@web').'/sport#'.$sport->name ?>'><img src='<?= Yii::getAlias('@web').'/img/titulo/'.$sport->picture ?>'></a></div>
        <div class="top-img">
            <a href='<?= Yii::getAlias('@web').'/sport#'.$sport->name ?>'>
                <img src='<?= Yii::getAlias('@web').'/img/'.$sport->picture ?>'>
                <img src='<?= Yii::getAlias('@web').'/img/bn/'.$sport->picture ?>' class="img-bn"/>
            </a>
        </div>
    </div>
<?php } ?>
</div>

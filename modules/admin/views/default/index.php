<?php

use yii\helpers\BaseUrl;

?>
<div class="admin-default-index">
    <h1>Aministración Aurasur</h1>
    <?php if(!Yii::$app->user->isGuest){ ?>
        <ul>
            <li><a href="<?= BaseUrl::home() ?>admin/category">Categorias</a></li>
            <li><a href="<?= BaseUrl::home() ?>admin/news">Noticias</a>
                <ul>
                    <li><a href="<?= BaseUrl::home() ?>admin/tag">Tags</a></li>
                </ul>
            </li>
            <li><a href="<?= BaseUrl::home() ?>admin/test">Tests</a>
                <ul>
                    <li><a href="<?= BaseUrl::home() ?>admin/question">Preguntas</a></li>
                    <li><a href="<?= BaseUrl::home() ?>admin/answer">Respuestas</a></li>
                    <li><a href="<?= BaseUrl::home() ?>admin/final-answer">Resultados</a></li>
                </ul>
            </li>
            <li><a href="<?= BaseUrl::home() ?>admin/ask">Preguntale a EVA</a>
                <ul>
                    <li><a href="<?= BaseUrl::home() ?>admin/askcategory">Categorias Preguntas</a></li>
                </ul>
            </li>
            <li><a href="<?= BaseUrl::home() ?>admin/week">Horoscopo</a></li>
            <li><a href="<?= BaseUrl::home() ?>admin/banner">Banners</a></li>
        </ul>
    <?php } else { ?>
        <a href="<?= BaseUrl::home() ?>admin/default/login">Login</a>
    <?php } ?>
</div>
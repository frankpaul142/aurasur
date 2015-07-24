<?php

use yii\helpers\BaseUrl;

?>
<div class="admin-default-index">
    <h1>Aministración Aurasur</h1>
    <?php if(!Yii::$app->user->isGuest){
        if(Yii::$app->user->identity->isAdmin){ ?>
        <ul>
            <li><a href="<?= BaseUrl::home() ?>admin/report">Reportes</a></li>
            <li><a href="<?= BaseUrl::home() ?>admin/sport">Deportes</a></li>
            <li><a href="<?= BaseUrl::home() ?>admin/race">Carreras</a></li>
			<li><a href="<?= BaseUrl::home() ?>admin/user">Usuarios</a></li>
			<li><a href="<?= BaseUrl::home() ?>admin/category">Categorias</a></li>
        </ul>
        <?php } else { ?>
        <ul>
            <li><a href="<?= BaseUrl::home() ?>admin/user/create">Crear usuario</a></li>
        </ul>
    <?php }
    } else { ?>
        <a href="<?= BaseUrl::home() ?>admin/default/login">Login</a>
    <?php } ?>
</div>
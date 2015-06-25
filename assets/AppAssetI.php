<?php

namespace app\assets;

use yii\web\AssetBundle;

class AppAssetI extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.css',
        'css/queries-aura.css',
        'css/owl.carousel.css',
        'css/owl.theme.css',
        'css/owl.transitions.css',
        'css/fotorama.css',
    ];
    public $js = [
        // 'js/jquery-1.11.2.min.js',
        'js/owl.carousel.js',
        'js/fotorama.js',
        'js/jquery-scrollspy.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}

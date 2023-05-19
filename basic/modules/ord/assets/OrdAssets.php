<?php

namespace app\modules\ord\assets;

use yii\web\AssetBundle;

class OrdAssets extends AssetBundle
{
    public $sourcePath = '@app/modules/ord/assets';
    public $css = [
        'bootstrap.min.css',
        'custom.css'
    ];
    public $js = [
        'bootstrap.min.js',
        'jquery.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
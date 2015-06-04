<?php

namespace app\controllers;

use app\models\Race;

class RaceController extends \yii\web\Controller
{
	public $layout='interno';

    public function actionView($id)
    {
        $model=Race::findOne($id);
    	if(isset($model)){
    		return $this->render('view',[
    			'model'=>$model,
    		]);
    	}
    	else{
    		throw new NotFoundHttpException('The requested page does not exist.');
    	}
    }

}

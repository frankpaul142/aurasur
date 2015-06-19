<?php

namespace app\controllers;

use app\models\Sport;

class SportController extends \yii\web\Controller
{
	public $layout='interno';

    public function actionView($id)
    {
    	$model=Sport::findOne($id);
    	if(isset($model)){
    		return $this->render('view',[
    			'model'=>$model,
    		]);
    	}
    	else{
    		throw new NotFoundHttpException('The requested page does not exist.');
    	}
    }

    public function actionIndex()
    {
        $sports=Sport::findAll(['status'=>'ACTIVE']);
        return $this->render('index',[
            'sports'=>$sports,
        ]);
    }

}

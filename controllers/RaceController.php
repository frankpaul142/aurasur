<?php

namespace app\controllers;

use Yii;
use app\models\Race;
use app\models\RacerSearch;
use yii\web\NotFoundHttpException;

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

    public function actionResults($id)
    {
        $model=Race::findOne($id);
    	if(isset($model)){
	        $searchModel = new RacerSearch();
	        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    		return $this->render('results',[
    			'model'=>$model,
    			'searchModel'=>$searchModel,
    			'dataProvider'=>$dataProvider,
    		]);
    	}
    	else{
    		throw new NotFoundHttpException('The requested page does not exist.');
    	}
    }

}

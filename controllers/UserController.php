<?php

namespace app\controllers;

use Yii;
use app\models\User;

class UserController extends \yii\web\Controller
{
    public function actionCreate()
    {
        $model=new User(['scenario'=>'register']);
        if ($model->load(Yii::$app->request->post())){
        	$model->password=$model->hashPassword($model->password);
        	$model->confirmPassword=$model->hashPassword($model->confirmPassword);
        	$model->creation_date=date('Y-m-d H:i:s');
        	$model->status='CONFIRMING';
        	if ($model->save()) {
        		return $this->redirect('create2?id='.$model->id);
        	}
        	else{
    			Yii::$app->session->setFlash('errorRegistro',array_values($model->getFirstErrors())[0]);
        		return $this->refresh();
        	}
        }
        else{
            return $this->render('create',['model'=>$model]);
        }
    }

    public function actionCreate2($id)
    {
        $model=User::findOne($id);
        if (isset($model)){
            if($model->load(Yii::$app->request->post())) {
                if($model->save()){
	        		Yii::$app->session->setFlash('registrado');
	        		return $this->redirect(Yii::getAlias('@web').'/site/login');
	            }
	        	else{
	    			Yii::$app->session->setFlash('errorRegistro',array_values($model->getFirstErrors())[0]);
	        		return $this->refresh();
	        	}
        	}
        	return $this->render('create2',['model'=>$model]);
        }
        else{
            return $this->redirect('create');
        }
    }

    public function actionView($id)
    {
    	$this->layout='interno';
    	$model=User::findOne($id);
    	if(isset($model)){
        	return $this->render('view',[
        		'model'=>$model,
        	]);
        }
        else{
        	return $this->goHome();
        }
    }

}

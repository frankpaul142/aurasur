<?php

namespace app\controllers;

use Yii;
use app\models\User;

class UserController extends \yii\web\Controller
{

	public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['view'],
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    // everything else is denied
                ],
            ],
        ];
    }

    public function actionCreate()
    {
        $model=new User(['scenario'=>'register']);
        if ($model->load(Yii::$app->request->post())){
        	$model->password=$model->hashPassword($model->password);
        	$model->confirmPassword=$model->hashPassword($model->confirmPassword);
        	$model->creation_date=date('Y-m-d H:i:s');
        	$model->status='ACTIVE';
            $model->type='RACER';
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
	        		// Yii::$app->session->setFlash('registrado');
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
            if(isset($_POST['User'])){
                if($_POST['User']['password']!=''){
                    $model->password=$model->hashPassword($_POST['User']['password']);
                }
                if($_POST['User']['cellphone']!=''){
                    $model->cellphone=$_POST['User']['cellphone'];
                }
                if($_POST['User']['address']!=''){
                    $model->address=$_POST['User']['address'];
                }
                if($_POST['User']['size']!=''){
                    $model->size=$_POST['User']['size'];
                }
                if($_POST['User']['birthdate']!=''){
                    $model->birthdate=$_POST['User']['birthdate'];
                }
                if($_POST['User']['contact_name']!=''){
                    $model->contact_name=$_POST['User']['contact_name'];
                }
                if($_POST['User']['contact_phone']!=''){
                    $model->contact_phone=$_POST['User']['contact_phone'];
                }
                if($_POST['User']['insurance']!=''){
                    $model->insurance=$_POST['User']['insurance'];
                }
                if($_POST['User']['policy']!=''){
                    $model->policy=$_POST['User']['policy'];
                }
                if($_POST['User']['blood_type']!=''){
                    $model->blood_type=$_POST['User']['blood_type'];
                }
                if($_POST['User']['medical_history']!=''){
                    $model->medical_history=$_POST['User']['medical_history'];
                }
                if($_POST['User']['recent_injuries']!=''){
                    $model->recent_injuries=$_POST['User']['recent_injuries'];
                }
                if($_POST['User']['surgeries']!=''){
                    $model->surgeries=$_POST['User']['surgeries'];
                }
                if($_POST['User']['allergies']!=''){
                    $model->allergies=$_POST['User']['allergies'];
                }
                $model->save();
            }
        	return $this->render('view',[
        		'model'=>$model,
        	]);
        }
        else{
        	return $this->goHome();
        }
    }

}

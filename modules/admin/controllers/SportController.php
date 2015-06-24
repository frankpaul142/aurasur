<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Sport;
use app\models\SportSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * SportController implements the CRUD actions for Sport model.
 */
class SportController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                // 'only' => ['index','view','create','update','delete'],
                'rules' => [
                    // allow authenticated users
                    [
                        'actions' => ['index','create','update','delete','view'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->isAdmin;
                        }
                    ],
                    // everything else is denied
                ],
            ],
        ];
    }

    /**
     * Lists all Sport models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SportSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sport model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Sport model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sport(['scenario'=>'create']);
        $picture=UploadedFile::getInstance($model,'picture');
        $bn=UploadedFile::getInstance($model,'bn');
        $title=UploadedFile::getInstance($model,'title');
        if ($model->load(Yii::$app->request->post())){
            if($picture!=NULL){
                $name=date('Y_m_d_H_i_s_'). $picture->baseName .'.' . $picture->extension;
                $model->picture=$name;
                if($bn!=NULL){
                    $model->bn=$name;
                }
                if($title!=NULL){
                    $model->title=$name;
                }
            }
            if($model->save()) {
            	if($picture!=NULL){
	                $picture->saveAs('img/'.$name);
	                if($bn!=NULL){
		                $bn->saveAs('img/bn/'.$name);
		            }
	                if($title!=NULL){
		                $bn->saveAs('img/titulo/'.$name);
		            }
	            }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Sport model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $picture=UploadedFile::getInstance($model,'picture');
        $bn=UploadedFile::getInstance($model,'bn');
        $title=UploadedFile::getInstance($model,'title');
        $last_picture=$model->picture;
        if ($model->load(Yii::$app->request->post())){
        	if($_POST['pictureChanged']=='true'){
            	// unlink('images/'.$last_picture);
	        	if($picture!=NULL){
	            	$name=date('Y_m_d_H_i_s_'). $picture->baseName .'.' . $picture->extension;
	            	$model->picture=$name;
	        	}
	        }
        	else{
        		$model->picture=$last_picture;
        	}
        	if($_POST['bnChanged']=='true'){
	        	if($bn!=NULL){
	            	if($picture!=NULL){
		            	$model->bn=$name;
		        	}
		        	else{
		            	$model->bn=$last_picture;
		        	}
	        	}
	        }
        	else{
        		$model->bn=$last_picture;
        	}
        	if($_POST['titleChanged']=='true'){
	        	if($title!=NULL){
	            	if($picture!=NULL){
		            	$model->title=$name;
		        	}
		        	else{
		            	$model->title=$last_picture;
		        	}
	        	}
	        }
        	else{
        		$model->title=$last_picture;
        	}
        	if($model->save()) {
        		if($picture!=NULL){
	                $picture->saveAs('img/'.$name);
	            }
        		if($bn!=NULL){
        			if($picture!=NULL){
	                	$bn->saveAs('img/bn/'.$name);
	                }
	                else{
	                	$bn->saveAs('img/bn/'.$last_picture);
	                }
	            }
        		if($title!=NULL){
        			if($picture!=NULL){
	                	$title->saveAs('img/titulo/'.$name);
	                }
	                else{
	                	$title->saveAs('img/titulo/'.$last_picture);
	                }
	            }
	            return $this->redirect(['view', 'id' => $model->id]);
	        }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Sport model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Sport model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sport the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sport::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Race;
use app\models\RaceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Sport;
use yii\web\UploadedFile;

/**
 * RaceController implements the CRUD actions for Race model.
 */
class RaceController extends Controller
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
        ];
    }

    /**
     * Lists all Race models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RaceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Race model.
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
     * Creates a new Race model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Race();
		$sports=Sport::findAll(['status'=>'ACTIVE']);
        $picture=UploadedFile::getInstance($model,'picture');
        $sponsor=UploadedFile::getInstance($model,'sponsor');
        if ($model->load(Yii::$app->request->post())){
            if($picture!=NULL){
                $name=date('Y_m_d_H_i_s_'). $picture->baseName .'.' . $picture->extension;
                $model->picture=$name;
                if($sponsor!=NULL){
	                $model->sponsor=$name;
	            }
            }
            $model->creation_date=date('Y-m-d H:i:s');
            if($model->save()) {
            	if($picture!=NULL){
	                $picture->saveAs('img/carrera/'.$name);
	                if($sponsor!=NULL){
		                $sponsor->saveAs('img/carrera/auspiciante/'.$name);
		            }
	            }
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else{
            	print_r($model->getErrors());
            	die();
            }
        } else {
            return $this->render('create', [
				'model' => $model,
				'sports'=>$sports,
            ]);
        }
    }

    /**
     * Updates an existing Race model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$sports=Sport::findAll(['status'=>'ACTIVE']);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
				'sports'=>$sports,
            ]);
        }
    }

    /**
     * Deletes an existing Race model.
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
     * Finds the Race model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Race the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Race::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

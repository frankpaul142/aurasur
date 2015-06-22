<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Race;
use app\models\RaceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Sport;
use app\models\Category;
use app\models\Categories;
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
    	$model=$this->findModel($id);
    	$categories=$model->categories;
    	$c='';
    	foreach ($categories as $category) {
    		$c.=$category->name.' , ';
    	}
        return $this->render('view', [
            'model' => $model,
            'categories'=>$c,
        ]);
    }

    /**
     * Creates a new Race model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Race(['scenario'=>'create']);
		$sports=Sport::findAll(['status'=>'ACTIVE']);
		$categories=Category::find()->all();
        $c=[];
        foreach ($categories as $category) {
        	$c[$category->id]=$category->name;
		}
        $picture=UploadedFile::getInstance($model,'picture');
        $sponsor=UploadedFile::getInstance($model,'sponsor');
        $attachment1=UploadedFile::getInstance($model,'attachment1');
        $attachment2=UploadedFile::getInstance($model,'attachment2');
        if ($model->load(Yii::$app->request->post())){
            if($picture!=NULL){
                $name=date('Y_m_d_H_i_s_'). $picture->baseName .'.' . $picture->extension;
                $model->picture=$name;
                if($sponsor!=NULL){
	                $model->sponsor=$name;
	            }
            }
            if($attachment1!=NULL){
                $name1=date('Y_m_d_H_i_s_'). $attachment1->baseName .'.' . $attachment1->extension;
                $model->attachment1=$name1;
            }
            if($attachment2!=NULL){
                $name2=date('Y_m_d_H_i_s_'). $attachment2->baseName .'.' . $attachment2->extension;
                $model->attachment2=$name2;
            }
            $model->creation_date=date('Y-m-d H:i:s');
            if($model->save()) {
            	if($picture!=NULL){
	                $picture->saveAs('img/carrera/'.$name);
	                if($sponsor!=NULL){
		                $sponsor->saveAs('img/carrera/auspiciante/'.$name);
		            }
	            }
	            if($attachment1!=NULL){
	                $attachment1->saveAs('img/carrera/adjunto/'.$name1);
	            }
	            if($attachment2!=NULL){
	                $attachment2->saveAs('img/carrera/adjunto/'.$name2);
	            }
	            if($_POST['Race']['categories']!=''){
		            foreach ($_POST['Race']['categories'] as $i => $category) {
		            	$nt=Category::findOne($category);
		            	$model->link('categories',$nt);
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
				'categories'=>$c,
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
		$categories=Category::find()->all();
        $c=[];
        foreach ($categories as $category) {
        	$c[$category->id]=$category->name;
		}
		$picture=UploadedFile::getInstance($model,'picture');
        $sponsor=UploadedFile::getInstance($model,'sponsor');
        $attachment1=UploadedFile::getInstance($model,'attachment1');
        $attachment2=UploadedFile::getInstance($model,'attachment2');
		$last_picture=$model->picture;
		$last_attachment1=$model->attachment1;
		$last_attachment2=$model->attachment2;
        if ($model->load(Yii::$app->request->post())){
        	if($_POST['pictureChanged']=='true'){
            	// unlink('images/'.$last_picture);
	        	if($picture!=NULL){
	            	$name=date('Y_m_d_H_i_s_'). $picture->baseName .'.' . $picture->extension;
	            	$model->picture=$name;
	            	if($sponsor!=NULL){
		            	$name=date('Y_m_d_H_i_s_'). $sponsor->baseName .'.' . $sponsor->extension;
		            	$model->sponsor=$name;
		        	}
	        	}
	        }
        	else{
        		$model->picture=$last_picture;
        	}
        	if($_POST['sponsorChanged']=='true'){
	        	if($sponsor!=NULL){
	            	if($picture!=NULL){
		            	$model->sponsor=$name;
		        	}
		        	else{
		            	$model->sponsor=$last_picture;
		        	}
	        	}
	        }
        	else{
        		$model->sponsor=$last_picture;
        	}
        	if($_POST['attachment1Changed']=='true'){
	        	if($attachment1!=NULL){
	            	$name1=date('Y_m_d_H_i_s_'). $attachment1->baseName .'.' . $attachment1->extension;
	            	$model->attachment1=$name1;
	        	}
	        }
        	else{
        		$model->attachment1=$last_attachment1;
        	}
        	if($_POST['attachment2Changed']=='true'){
	        	if($attachment2!=NULL){
	            	$name2=date('Y_m_d_H_i_s_'). $attachment2->baseName .'.' . $attachment2->extension;
	            	$model->attachment2=$name2;
	        	}
	        }
        	else{
        		$model->attachment2=$last_attachment2;
        	}
        	if($_POST['Race']['categories']!=''){
        		foreach ($model->categories as $i => $category) {
        			if (!array_search($category->id, $_POST['Race']['categories'])) {
        				$nt=Category::findOne($category->id);
        				$model->unlink('categories',$nt,true);
        			}
        		}
	            foreach ($_POST['Race']['categories'] as $i => $category) {
	            	if(!Categories::findOne(['race_id'=>$model->id, 'category_id'=>$category])){
		            	$nt=Category::findOne($category);
		            	$model->link('categories',$nt);
		            }
	            }
	        }
	        else{
	        	$model->unlinkAll('categories',true);
	        }
        	if($model->save()) {
        		if($picture!=NULL){
	                $picture->saveAs('img/carrera/'.$name);
	            }
        		if($sponsor!=NULL){
        			if($picture!=NULL){
	                	$sponsor->saveAs('img/carrera/auspiciante/'.$name);
	                }
	                else{
	                	$sponsor->saveAs('img/carrera/auspiciante/'.$last_picture);
	                }
	            }
	            if($attachment1!=NULL){
	                $attachment1->saveAs('img/carrera/adjunto/'.$name1);
	            }
	            if($attachment2!=NULL){
	                $attachment2->saveAs('img/carrera/adjunto/'.$name2);
	            }
            	return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
				'sports'=>$sports,
				'categories'=>$c,
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

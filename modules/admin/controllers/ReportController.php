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

/**
 * RaceController implements the CRUD actions for Race model.
 */
class ReportController extends Controller
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
                    	'actions' => ['index','view'],
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
        $data=[];
        $data[0]['title']='Género';
        $data[0]['data']['Hombres']=0;
        $data[0]['data']['Mujeres']=0;
        $data[1]['title']='Categoría';
        foreach ($model->categories as $category) {
            $data[1]['data'][$category->name]=0;
        }
        $data[2]['title']='Edad';
        $data[2]['data']['-20']=0;
        $data[2]['data']['21-30']=0;
        $data[2]['data']['31-40']=0;
        $data[2]['data']['41-50']=0;
        $data[2]['data']['51-60']=0;
        $data[2]['data']['61+']=0;
        $data[3]['title']='Lugar de inscripción';
        $data[4]['title']='Forma de pago';
        foreach ($model->racers as $racer) {
            if($racer->user->sex=='MALE'){
                $data[0]['data']['Hombres']++;
            }
            else{
                $data[0]['data']['Mujeres']++;
            }
            $data[1]['data'][$racer->category->name]++;
            $age=date_diff(date_create($racer->user->birthdate),date_create('today'))->y;
            if($age<=20){
                $data[2]['data']['-20']++;
            }
            elseif($age<=30){
                $data[2]['data']['21-30']++;
            }
            elseif($age<=40){
                $data[2]['data']['31-40']++;
            }
            elseif($age<=50){
                $data[2]['data']['41-50']++;
            }
            elseif($age<=60){
                $data[2]['data']['51-60']++;
            }
            else{
                $data[2]['data']['61+']++;
            }
            if(isset($data[3]['data'][$racer->place])){
                $data[3]['data'][$racer->place]++;
            }
            else{
                $data[3]['data'][$racer->place]=1;
            }
            if(isset($data[4]['data'][$racer->payment])){
                $data[4]['data'][$racer->payment]++;
            }
            else{
                $data[4]['data'][$racer->payment]=1;
            }
        }
        return $this->render('view', [
            'model' => $model,
            'data'=>$data,
        ]);
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

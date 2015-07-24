<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Racer;
use app\models\Race;
use app\models\Categories;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
                        'actions' => ['index','create','update','delete','view','racer','categories'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->isAdmin;
                        }
                    ],
                    [
                        'actions' => ['racer','categories'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->isSale;
                        }
                    ],
                    // everything else is denied
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post())){
            $model->password=hash('sha256',$model->identity);
            $model->creation_date=date('Y-m-d H:i:s');
            if($model->save()) {
            	Yii::$app->session->setFlash('userCreated');
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else{
            	Yii::$app->session->setFlash('errorUser',array_values($model->getFirstErrors())[0]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionRacer()
    {
        $user = new User();
        $racer = new Racer();
        $races=Race::findAll(['status'=>'PENDING']);

        if ($user->load(Yii::$app->request->post()) && $racer->load(Yii::$app->request->post())){
            $user->type='RACER';
            $user->status='ACTIVE';
            $user->password=hash('sha256',$user->identity);
            $user->creation_date=date('Y-m-d H:i:s');
            if($user->save()) {
            	$racer->place=strtoupper($racer->place);
                $racer->user_id=$user->id;
                $racer->creation_date=date('Y-m-d H:i:s');
                if($racer->save()){
	                Yii::$app->session->setFlash('racerCreated');
	                return $this->redirect(['racer']);
	            }
	            else{
	            	Yii::$app->session->setFlash('errorRacer',array_values($racer->getFirstErrors())[0]);
	            }
            }
            else{
                Yii::$app->session->setFlash('errorRacer',array_values($user->getFirstErrors())[0]);
            }
        }
        return $this->render('racer', [
            'user' => $user,
            'racer'=>$racer,
            'races'=>$races,
        ]);
    }

    public function actionCategories($id)
    {
        $categories = Categories::findAll(['race_id' => $id]);
        echo "<option>Selecciona una categoría</option>";
        if($categories){
         	foreach($categories as $category){
				echo "<option value='".$category->category_id."'>".$category->category->name."</option>";
         	}
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

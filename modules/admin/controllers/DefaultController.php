<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\LoginForm;

class DefaultController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                // 'only' => ['index','view','create','update','delete'],
                'rules' => [
                    // allow authenticated users
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->isAdmin || Yii::$app->user->identity->isSale;
                        }
                    ],
                    // everything else is denied
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        /*if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }*/

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(Yii::getAlias('@web').'/admin');
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
}

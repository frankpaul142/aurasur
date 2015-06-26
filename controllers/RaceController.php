<?php

namespace app\controllers;

use Yii;
use app\models\Race;
use app\models\Racer;
use app\models\RacerSearch;
use app\models\User;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

class RaceController extends \yii\web\Controller
{
	public $layout='interno';

    public function actionView($id)
    {
        $model=Race::findOne($id);
    	if(isset($model)){
            $racer=new Racer();
    		return $this->render('view',[
    			'model'=>$model,
                'racer'=>$racer,
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

    public function actionPay($id)
    {
        $return=[];
        $total=0;
        if(isset(Yii::$app->user->id)){
            $user=User::findOne(Yii::$app->user->id);
            $race=Race::findOne($id);
            if($user && $race){

                /* paypal */

                $clientId = 'AYSq3RDGsmBLJE-otTkBtM-jBRd1TCQwFf9RGfwddNXWz0uFU9ztymylOhRS';
                $clientSecret = 'EGnHDxD_qRPdaLdZz8iCr8N7_MzF-YHPTkjs6NKYQvQSBngp4PTTVWkPZRbL';

                $apiContext = $this->getApiContext($clientId, $clientSecret);

                $payer = new Payer();
                $payer->setPaymentMethod("paypal");

                $total=$race->cost;

                $item1 = new Item();
                $item1->setName('Inscripción '.$race->name)
                    ->setCurrency('USD')
                    ->setQuantity(1)
                    ->setPrice($total);
                /*$item1 = new Item();
                $item1->setName('Ground Coffee 40 oz')
                    ->setCurrency('USD')
                    ->setQuantity(1)
                    ->setPrice(7.5);
                $item2 = new Item();
                $item2->setName('Granola bars')
                    ->setCurrency('USD')
                    ->setQuantity(5)
                    ->setPrice(2);*/

                $itemList = new ItemList();
                $itemList->setItems(array($item1));

                $details = new Details();
                /*$details->setShipping(5)
                    // ->setTax(1.3)
                    ->setSubtotal($total);*/
                $details->setSubtotal($total);

                $amount = new Amount();
                $amount->setCurrency("USD")
                    ->setTotal($total)
                    ->setDetails($details);
 
                $transaction = new Transaction();
                $transaction->setAmount($amount)
                    ->setItemList($itemList)
                    ->setDescription("Inscripción en Aurasur")
                    ->setInvoiceNumber('1234567890');

                $baseUrl = Url::base(true);
                $redirectUrls = new RedirectUrls();
                $redirectUrls->setReturnUrl($baseUrl."/user/view?id=".$user->id."&r=ins")
                    ->setCancelUrl($baseUrl."/race/pay?success=false&id".$id);

                $payment = new Payment();
                $payment->setIntent("sale")
                    ->setPayer($payer)
                    ->setRedirectUrls($redirectUrls)
                    ->setTransactions(array($transaction));

                try {
                    $payment->create($apiContext);
                } catch (Exception $ex) {
                    print_r($ex);
                    exit(1);
				}

                $approvalUrl = $payment->getApprovalLink();
                /* --- */
            }
        }
        else{
            return $this->redirect(Yii::getAlias('@web').'/site/login?ins='.$id);
        }

        
        return $this->render('pay',['race'=>$race,'aurl'=>$approvalUrl]);
    }

    private function getApiContext($clientId, $clientSecret)
    {
        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                $clientId,
                $clientSecret
            )
        );

        $apiContext->setConfig(
            array(
                'mode' => 'sandbox',
                'log.LogEnabled' => true,
                'log.FileName' => '../PayPal.log',
                'log.LogLevel' => 'DEBUG', // PLEASE USE `FINE` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
                'validation.level' => 'log',
                'cache.enabled' => true,
                // 'http.CURLOPT_CONNECTTIMEOUT' => 30
                // 'http.headers.PayPal-Partner-Attribution-Id' => '123123123'
            )
        );
        return $apiContext;
    }

}

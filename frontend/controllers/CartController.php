<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Product;
use frontend\models\ProductSearch;
use frontend\models\Cart;
use frontend\models\CartSearch;
use frontend\models\CartItems;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\base\ErrorException;


class CartController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'add', 'delete', 'clear'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['checkout', 'history', 'history-view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
   

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $session = Yii::$app->session;
        return $this->render('index', [
            'carts' => $session->get('cart')
        ]);
    }
    
    public function actionAdd($id)
    {
        $session = Yii::$app->session;
        $model = $this->findModel($id);
        // unset($session['cart']);
        
        $cart = $session->get('cart');
        if(!$cart)
        {
            echo 'No session';
            $cart[$model->id] = [
                'amount' => 1
            ];
        }else{
            if(isset($model->id)){
                $cart[$model->id]['amount']++;
            }else{
                $cart[$model->id] = [
                    'amount' => 1
                ];
            }
        }
        
        $session->set('cart', $cart);
        
        $this->redirect(['index']);
    }
    
    public function actionDelete($id)
    {
        $session = Yii::$app->session;
        $cart = $session->get('cart');
        
        unset($cart[$id]);
        
        $session->set('cart', $cart);
        
        $this->redirect(['index']);
    }
    
    public function actionClear()
    {
       $session = Yii::$app->session;
        unset($session['cart']); 
        
        $this->redirect(['/site']);
    }
    
    public function actionCheckout()
    {
        $model = new Cart;
        $session = Yii::$app->session;
        $carts = $session->get('cart');
        
        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->save();
                foreach($carts as $id => $cart) {
                    $modelItem = new CartItems();
                    $product = Product::findOne($id);
                    $dataItem[$modelItem->formName()] = [
                        'cart_id' => $model->id,
                        'product_id' => $id,
                        'amount' => $cart['amount'],
                        'price' => $product->price
                    ];
                    $modelItem->load($dataItem);
                    $modelItem->save();
                }
                    
                $transaction->commit();
                
                $session->setFlash('alert',[
                    'body'=>'การสั่งซื้อเสร็จเรียบร้อย! เจ้าหน้าที่จะติดต่อกลับไปเร็วที่สุด..',
                    'options'=>['class'=>'alert-success']
                ]);
                
                unset($session['cart']); 
                
                return $this->redirect(['site/index']);
            } catch (ErrorException $e) {
                $transaction->rollback();
                Yii::warning("Division by zero.");
            }
            //return $this->redirect(['site/index']);
        } else {
            return $this->render('checkout', [
                'carts' => $session->get('cart'),
                'model' => $model
            ]);
        }
    }
    
    public function actionHistory()
    {
        $searchModel = new CartSearch(['user_id' => Yii::$app->user->id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('history', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionHistoryView($id)
    {
        $model = Cart::findOne($id);
        return $this->render('history-view', [
            'model' => $model
        ]);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

<?php

namespace frontend\controllers;

use common\models\Order;
use Yii;
use common\models\Product;
use common\models\Category;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class ProductController extends \yii\web\Controller
{
//    public function actionIndex()
//    {
//        $query = Article::find()->where(['is_published' => '1'])->orderBy('created DESC');
//
//        $dataProvider = new ActiveDataProvider([
//            'query' => $query,
//            'pagination' => [
//                'pageSize' => 6,
//            ],
//        ]);
//
//        return $this->render('index', [
//            'dataProvider' => $dataProvider,
//        ]);
//    }

//    public function actionIndex($slug = '')
//    {
//        $query = Product::find()->where(['is_published' => '1'])->orderBy('created DESC');
//
//        if($slug){
//            $category = $this->findCategory($slug);
//            $query->andWhere(['category_id' => $category->id]);
//        }
//
//        $dataProvider = new ActiveDataProvider([
//            'query' => $query,
//            'pagination' => [
//                'pageSize' => 6,
//            ],
//        ]);
//
//        $categories = Category::find()->where(['model_name' => 'article'])->all();
//
//        return $this->render('index', [
//            'dataProvider' => $dataProvider,
//            'categories' => $categories,
//        ]);
//    }
    
    public function actionView($slug){

        $model = $this->findProduct($slug);
        $category = Category::find()->where(['id' => $model->category_id])->one();
        $similarProducts = Product::find()->where(['is_published' => '1', 'category_id' => $category->id])->andWhere(['NOT IN', 'id', [$model->id]])->limit(8)->all();

        $order = new Order();
        if ($order->load(Yii::$app->request->post()) && $order->save()) {
            if ($order->save()){
                Yii::$app->session->setFlash('success', 'Спасибо. Ваш заказ успешно оформлена. Наш менеджер свяжется с вами.');
            } else {
                Yii::$app->session->setFlash('error', 'Произошла ошибка.');
            }
            return $this->refresh();
        } else {
            return $this->render('view', [
                'model' => $model,
                'order' => $order,
                'similarProducts' => $similarProducts
            ]);
        }
    }

    protected function findProduct($slug)
    {
        if (($model = Product::find()->where(['slug' => $slug])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findCategory($slug)
    {
        if (($model = Category::find()->where(['slug' => $slug])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }}

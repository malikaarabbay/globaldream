<?php

namespace frontend\controllers;

use common\models\Product;
use common\models\Category;
use frontend\models\Search;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class CatalogController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $query = Product::find()->where(['is_published' => '1'])->orderBy('created DESC');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 9,
            ],
        ]);

//        $parentCategories = Category::find()->where(['is_published' => '1', 'parent_id' => null])->all();
//        $categories = Category::find()->where(['is_published' => '1'])->all();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
//            'parentCategories' => $parentCategories,
//            'categories' => $categories
        ]);
    }

    public function actionView($slug){

        $model = $this->findCategory($slug);
        $query = Product::find()->where(['is_published' => '1', 'category_id' => $model->id])->orderBy('created DESC');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 9,
            ],
        ]);

        return $this->render('view', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSearch() {

        $searchModel = new Search();

        $productModel = new Product();

        $query = $productModel::find()->where(['is_published' => '1'])->limit(30)->orderBy('created DESC');

        if ($searchModel->load(Yii::$app->request->get()) ){

            $keyword = strip_tags($searchModel->query);
            $query = $productModel::find()->where(['is_published' => '1'])->andFilterWhere(['like', 'title', $keyword])->orFilterWhere(['like', 'description', $keyword]);

        }

        $productDataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 9,
            ],
        ]);

        return $this->render('search', [
            'productDataProvider' => $productDataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    protected function findCategory($slug)
    {
        if (($model = Category::find()->where(['slug' => $slug])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }}

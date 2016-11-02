<?php

namespace backend\controllers;

use common\models\ProductParam;
use common\models\Param;
use Yii;
use yii\helpers\ArrayHelper;
use common\models\Image;
use common\models\Category;
use common\models\Product;
use yii\filters\AccessControl;
use common\models\search\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use vova07\fileapi\actions\UploadAction as FileAPIUpload;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'fileapi-upload' => [
                'class' => FileAPIUpload::className(),
                'path' => '@frontend/web/images/',
                'unique' => true,
            ]
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
//    public function actionCreate($image_tab = false)
//    {
//        $model = new Product();
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            $model->saveImages();
//            return $this->redirect(['view', 'id' => $model->id]);
//        } else {
//            return $this->render('create', [
//                'model' => $model,
//                'image_tab' => $image_tab
//            ]);
//        }
//    }

    public function actionCreate($category_id, $image_tab = false)
    {
        $model = new Product();
        $category = Category::findOne($category_id);
        $productParamModel = new ProductParam();
        $productParamModel = [];
        foreach ($category->params as $productParam) {
            $productParamModel[$productParam->id] = new ProductParam();
        }

        $post = Yii::$app->request->post();

        if ($model->load($post)) {
            $model->category_id = $category_id;
            $model->saveImages();
            $model->save();
            if (isset($post['ProductParam'])) {
                foreach ($post['ProductParam'] as $index => $productParam) {
                    $param = Param::findOne($index);
                    $value = $param->type_id == (Param::TYPE_CHECKBOXLIST && is_array($productParam['value'])) ? implode(',', $productParam['value']) : $productParam['value'];
                    $model->link('params', $param, ['value' => $value]);
                }
            }

            $model->saveImages();

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'productParamModel' => $productParamModel,
                'category' => $category,
                'image_tab' => $image_tab
            ]);
        }
    }

    public function actionSelectCategory()
    {
        $categories = Category::find()->all();

        return $this->render('selectCategory', [
            'categories' => $categories,
        ]);

    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    
//    public function actionUpdate($id, $image_tab = false)
//    {
//        $model = $this->findModel($id);
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            $model->saveImages();
//            return $this->redirect(['view', 'id' => $model->id]);
//        } else {
//            return $this->render('update', [
//                'model' => $model,
//                'image_tab' => $image_tab
//            ]);
//        }
//    }

    public function actionUpdate($id, $image_tab = false)
    {
        $model = $this->findModel($id);
        $productParams = ProductParam::find()->where(['product_id' => $id])->all();
        $productParamsIndex = ArrayHelper::index($productParams, 'param_id');
        $category = Category::findOne($model->category_id);
        $productParamModel = [];
        foreach ($category->params as $productParam) {
            if (isset($productParamsIndex[$productParam->id])) {
                $productParamModel[$productParam->id] = $productParamsIndex[$productParam->id];
            } else {
                $productParamModel[$productParam->id] = new ProductParam();
            }
        }

        $post = Yii::$app->request->post();

        if ($model->load($post)) {
            $model->saveImages();
            $model->save();

            $model->unlinkAll('params', true);

            if (isset($post['ProductParam'])) {
                foreach ($post['ProductParam'] as $index => $productParam) {
                    $param = Param::findOne($index);
                    $value = $param->type_id == (Param::TYPE_CHECKBOXLIST && is_array($productParam['value'])) ? implode(',', $productParam['value']) : $productParam['value'];
                    $model->link('params', $param, ['value' => $value]);
                }
            }

            $model->saveImages();


            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'category' => $model->category,
                'productParamModel' => $productParamModel,
                'image_tab' => $image_tab
            ]);
        }
    }
    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionUpdateImageTitle($image_id) {

        $imageModel = Image::findOne($image_id);
        $item_id = Product::findOne($imageModel->item_id)->id;

        if ($imageModel->load(Yii::$app->request->post()) && $imageModel->save() ) {
            return $this->redirect(['update',
                'id' => $item_id,
                'image_tab' => true
            ]);
        } else {
            return $this->renderAjax('_imageUpdate', [
                'imageModel' => $imageModel,
                'news_id' => $item_id,
            ]);
        }
    }

    public function actionImageDelete($id){
        $imageModel = Image::findOne($id);

        $itemId = $imageModel->item_id;

        $imageModel->delete();
        return $this->redirect(['update',
            'id' => $itemId,
            'image_tab' => true
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

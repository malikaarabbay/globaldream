<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Product;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Orders');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Order'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute' => 'photo',
                'format' => 'html',
                'value' => function($data) {
                    return Html::img($data->product->image,['width'=>150]);
                },
            ],
            [
                'attribute' => 'product_id',
                'class' => 'yii\grid\DataColumn',
                'label' => 'Продукт',
                'value' => function ($data) {
                    return ($data->product) ? $data->product->title : '-';
                },
                'filter' => ArrayHelper::map(Product::find()->all(), 'id', 'title')
            ],
            'fio',
            'email:email',
            'phone',
            // 'created',
            // 'updated',
            // 'admin_comment:ntext',

            [
                'header' => 'Действия',
                'class' => 'yii\grid\ActionColumn'
            ],
        ],
    ]); ?>
</div>

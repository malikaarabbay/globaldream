<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Param;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ParamValueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Param Values');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="param-value-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Param Value'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'value',
            [
                'attribute' => 'photo',
                'format' => 'html',
                'value' => function($data) {
                    return Html::img($data->image,['width'=>50]);
                },
            ],
            [
                'attribute' => 'param_id',
                'class' => 'yii\grid\DataColumn',
                'label' => 'Параметр',
                'value' => function ($data) {
                    return ($data->param) ? $data->param->title : '-';
                },
                'filter' => ArrayHelper::map(Param::find()->all(), 'id', 'title')
            ],
            [
                'header' => 'Действия',
                'class' => 'yii\grid\ActionColumn'
            ],
        ],
    ]); ?>
</div>

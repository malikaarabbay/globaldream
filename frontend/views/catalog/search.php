<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use himiklab\thumbnail\EasyThumbnailImage;
use common\models\Category;
use frontend\models\Search;
use yii\widgets\ListView;
use frontend\widgets\CatalogWidget;

/* @var $this yii\web\View */
$this->title = 'Каталог';

$this->registerLinkTag(['rel'=> 'canonical', 'href' =>  Url::toRoute(['/catalog/search'])]);
?>

<div class="catalog">
    <div class="catalog__inner">
        <div class="h-heading h-heading--black">
            <h6>Каталог</h6>
        </div>
        <div class="filter-part">
            <?= CatalogWidget::widget(); ?>

            <div class="filter-section">
                <div class="filter-section__heading">
                    Поиск
                </div>
                <div class="search-wr">
                    
                <?php $form = ActiveForm::begin(
                    [
                        'id' => 'search-form',
                        'action' => Url::toRoute('/catalog/search'),
                        'method' => 'get',
                    ]
                ); ?>
                
                    <?= $form->field($searchModel, 'query',['inputOptions' => ['class' => 'search-wr__input']])->textInput(['placeholder' => '','maxlength' => 75])->label(false) ?>

                <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
        <div class="catalog-part">
            <ul class="filter-carousel">
                <?= ListView::widget([
                    'dataProvider' => $productDataProvider,
                    'itemView' => '/catalog/_item',
                    'layout' => "{items}\n<div class='clearfix'></div>{pager}",
                ]) ?>
            </ul>
        </div>
    </div>
</div>
<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use frontend\models\Search;
use yii\bootstrap\ActiveForm;
use yii\widgets\ListView;
use \yii\widgets\Breadcrumbs;
use himiklab\thumbnail\EasyThumbnailImage;
//use common\models\Lang;

/* @var $this yii\web\View */
$this->title = 'Поиск';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="catalog">
    <div class="catalog__inner">
        <div class="h-heading h-heading--black">
            <h6>Поиск</h6>
        </div>
        <?php if($query == ''){?>
            <h1 class="query-message"><?= Yii::t('app', 'Enter the search query')?></h1>
        <?php }?>
        <div class="service">
            <div class="search-form-block">

                <?php $form = ActiveForm::begin(
                    [
                        'id' => 'search-form',
                        'action' => Url::toRoute('/search/index'),
                        'method' => 'get',
                    ]
                ); ?>

                <div class="bigsearch_part">
                    <div class="bigsearch_input">
                        <?= $form->field($model, 'query',['inputOptions' => ['class' => 'form-control search-text']])->textInput(['placeholder' => Yii::t('app', 'Search request'),'maxlength' => 75])->label(false) ?>
                    </div>
                    <div class="bigsearch_submit">
                        <?= Html::submitButton(Yii::t('app', 'Search'), ['name' => 'search-button','class' => 'big-search-button button ']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>

            <?php if((!$query == '') && !$queryWithTags){?>
                <?php if($resulCount != 0){?>
                    <h4 class="query-message result-message"><?= Yii::t('app', 'Results for:')?> <span class="result-query"><?=$query ?></span></h4>
                <?php } else {?>
                    <h4 class="query-message result-message"><?= Yii::t('app', 'On request')?> <span class="result-query"><?=$query ?></span></h4>

                    <h4 class="query-message result-message"><?= Yii::t('app', 'Nothing found')?> </h4>
                <?php }?>
            <?php } else {?>
                <h4 class="query-message result-message"><?= Yii::t('app', 'Incorrect request')?></h4>
            <?php } ?>

            <div>

                <?php if($productList){?>
                    <div class="result-item-title">Продукция</div>

                    <ul class="filter-carousel">
                        <?php foreach($productList as $product){?>
                            <li class="filter-carousel__li">
                                <div class="f-furniture">
                                    <?=
                                    EasyThumbnailImage::thumbnailImg(
                                        $product->imagePath,
                                        275,
                                        375,
                                        EasyThumbnailImage::THUMBNAIL_OUTBOUND,
                                        [
                                            'alt' => '',
                                            'class' => ''
                                        ]
                                    );
                                    ?>
                                    <div class="furniture-des">
                                        <a class="furniture-des__heading" href="<?= Url::toRoute(['/product/view', 'slug' => $product->slug]) ?>">
                                            <?= $product->title ?>
                                        </a>
                                        <span class="furniture-des__id">ID:<?= $product->id ?></span>
                                        <span class="furniture-des__price"><?= (number_format($product->new_price,0,' ',' ')) ? number_format($product->new_price,0,' ',' ') : number_format($product->price,0,' ',' ') ?>тг</span>
                                        <a class="furniture-des__more" href="<?= Url::toRoute(['/product/view', 'slug' => $product->slug]) ?>">Подробнее</a>
                                    </div>
                                </div>
                            </li>
                        <?php }?>
                    </ul>
                <?php }?>
            </div>
        </div>
    </div>
</div>
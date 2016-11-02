<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = $model->title;

$this->registerMetaTag(['name'=> 'keywords', 'content' =>  $model->meta_keywords]);
$this->registerMetaTag(['name'=> 'description', 'content' => $model->meta_description]);
$new_price = number_format($model->new_price,0,' ',' ');
$price = number_format($model->price,0,' ',' ');

?>

<div class="product">
    <div class="product__inner">
        <div class="product-image">
            <?php
            echo \himiklab\thumbnail\EasyThumbnailImage::thumbnailImg(
                $model->imagePath, 600, 410, \himiklab\thumbnail\EasyThumbnailImage::THUMBNAIL_OUTBOUND,
                [
                    'class' => ''
                ]
            );
            ?>
        </div>
        <div class="product__right">
            <div class="product-info">
                <div class="product-heading">
                    <h1 class="product-heading__text"><?= $model->title ?></h1>
                    <span class="product-heading__id">Id:<?= $model->id ?></span>
                </div>
                <p class="product-info__des">
                    <?= $model->announce ?>
                </p>
                <div class="product-heading">
                    <h1 class="product-heading__text">Характеристики</h1>
                </div>
                <ul class="character-ul">
                    <li class="character-ul__li">
                        <span>Материал:</span>МВД
                    </li>
                    <li class="character-ul__li">
                        <span>Размер:</span>МВД
                    </li>
                    <li class="character-ul__li">
                        <span>Ниша под ТВ:</span>МВД
                    </li>
                </ul>
                <?php if($model->description) { ?>
						<span class="product-info__razdel">
							Дополнительное описание:
						</span>
                <?= $model->description ?>
                <?php } ?>

                <ul class="product-type">
                    <?php foreach ($model->productParams as $productParam) { ?>
                    <?php if ($productParam->valueText) { ?>
                    <li class="product-type__item">
                        <?php $photos = explode(",", $productParam->valuePhoto);?>
                        <?php foreach ($photos as $photo) { ?>
                            <img width="40" src="/images/<?= $photo ?>" alt="">
                        <?php } ?>
                    </li>
                        <?php } ?>
                    <?php } ?>
                </ul>
                <div class="order-type">
                    <a href="#zakaz" class="fancybox order-type__button">
                        Заказать
                    </a>
                    <div class="popup" id="zakaz" style="width:400px;display: none;">
                        <span class="popup__heading">Заказать</span>
                        <?php $form = ActiveForm::begin(['id' => 'review-form', 'layout' => 'horizontal']); ?>
                        <?= $form->field($order, 'product_id')->hiddenInput(['value'=> $model->id])->label(false); ?>
                        <?= $form->field($order, 'fio', ['inputOptions' => ['class' => 'popup__input']])->textInput()->input('name', ['placeholder' => 'ФИО'])->label(false); ?>
                        <?= $form->field($order, 'email', ['inputOptions' => ['class' => 'popup__input']])->textInput()->input('name', ['placeholder' => 'Почта'])->label(false); ?>
                        <?= $form->field($order, 'phone', ['inputOptions' => ['class' => 'popup__input']])->textInput()->input('name', ['placeholder' => 'Номер'])->label(false); ?>
                        <?= Html::submitButton('Отправить', ['class' => 'popup__submit', 'name' => 'review-button']) ?>
                        <?php ActiveForm::end(); ?>
                    </div>
                    <?php if($new_price) { ?><del class="order-type__del"><?= $price ?>тг</del><?php } ?>
                    <span class="order-type__price"><?= $new_price ?>тг</span>
                </div>
                <ul class="delivery">
                    <li class="delivery__item">
                        <div class="delivery-show delivery-show--payment">Оплата</div>
                    </li>
                    <li class="delivery__item">
                        <div class="delivery-show delivery-show--sborka">Доставка и собрака</div>
                    </li>
                    <li class="delivery__item">
                        <div class="delivery-show delivery-show--sales">Хочу скидку</div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php if($similarProducts) { ?>
<div class="similar-products">
    <div class="similar-products__inner">
        <div class="similar-up">
            <h2 class="similar-up__heading">Похожие товары</h2>
        </div>
        <div class="hot-carousel">
            <?php foreach ($similarProducts as $product) { ?>
                <div class="hot-item">
                    <a class="hot-item__figure" href="<?= Url::toRoute(['/product/view', 'slug' => $product->slug]) ?>">
                        <?php
                        echo \himiklab\thumbnail\EasyThumbnailImage::thumbnailImg(
                            $product->imagePath, 270, 355, \himiklab\thumbnail\EasyThumbnailImage::THUMBNAIL_OUTBOUND,
                            [
                                'class' => ''
                            ]
                        );
                        ?>
                        <div class="hot-hover">
                            <span class="hot-hover__text"><?php $anounce = strip_tags($product->announce, '<a>'); echo mb_substr($anounce,0, 70, 'UTF-8').' ...'; ?></span>
                            <div class="hot-hover__more">Подробнее</div>
                        </div>
                    </a>
                    <div class="hot-des">
                        <a href="<?= Url::toRoute(['/product/view', 'slug' => $product->slug]) ?>" class="hot-des__heading">
                            <?= $product->title ?>
                        </a>
							<span class="hot-des__id">
								ID:<?= $product->id ?>
							</span>
							<span class="hot-des__price">
                                <?= (number_format($product->new_price,0,' ',' ')) ? number_format($product->new_price,0,' ',' ') : number_format($product->price,0,' ',' ') ?>тг
							</span>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php } ?>
<div class="add-info">
    <div class="add-info__inner">
        <ul class="add-ul">
            <li class="add-ul__li">
                <div class="add-item add-item--service">
									<span class="add-item__heading">
										Собственная служба доставки
									</span>
                    <p class="add-item__text">
                        Доставляем,поднимаем,собираем в Астане
                    </p>
                </div>
            </li>
            <li class="add-ul__li">
                <div class="add-item add-item--garrancy">
									<span class="add-item__heading">
										Гарантия 1.5 года
									</span>
                    <p class="add-item__text">
                        Собственный контроль качества и гарантия от производителя
                    </p>
                </div>
            </li>
            <li class="add-ul__li">
                <div class="add-item add-item--giveback">
									<span class="add-item__heading">
										Возврат и обмен
									</span>
                    <p class="add-item__text">
                        В полном соответствии с законом о Защите прав потребителя
                    </p>
                </div>
            </li>
        </ul>
    </div>
</div>
<?php
use yii\helpers\Html;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use frontend\widgets\SliderWidget;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>

        <?= $this->render('/common/_header')?>

        <?= SliderWidget::widget(); ?>

    <?= Alert::widget() ?>
        <?= $content?>


    <?= $this->render('/common/_footer')?>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use common\models\Text;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

$this->title = 'Контакты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contacts-section">
    <div class="contacts-section__inner">
        <div class="h-heading h-heading--black">
            <h6>Контакты</h6>
        </div>
        <div class="contact-info">
            <div class="contact-info__text">
                <div class="contact-data">
                    <p><?= Text::find()->where(['key' => 'contact_text'])->one()->value; ?></p>
                </div>
            </div>
            <div class="contact-form">
                <?php $form = ActiveForm::begin(['id' => 'contact-form', 'layout' => 'horizontal']); ?>
                <?= $form->field($model, 'name', ['inputOptions' => ['class' => 'contact-form__input']])->textInput()->input('name', ['placeholder' => 'Имя'])->label(false); ?>
                <?= $form->field($model, 'email', ['inputOptions' => ['class' => 'contact-form__input']])->textInput()->input('name', ['placeholder' => 'E-mail'])->label(false); ?>
                <?= $form->field($model, 'phone', ['inputOptions' => ['class' => 'contact-form__input']])->textInput()->input('phone', ['placeholder' => 'Номер'])->label(false); ?>
                <?= $form->field($model, 'body',['inputOptions' => ['class' => 'contact-form__input contact-form__input--textarea', 'placeholder' => 'Сообщение'],])->textarea(['cols' => 10, 'rows' => 20])->label(false) ?>

                <div class="form-group text-center">
                    <?= Html::submitButton('Отправить', ['class' => 'contact-form__submit', 'name' => 'contact-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
                
            </div>
        </div>
    </div>
    <div class="big-map">
        <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=El8kKq_I2kiOvVTKlhgZFbC-cTZIED9o&amp;width=100%&amp;height=400&amp;lang=ru_RU&amp;sourceType=constructor&amp;scroll=true"></script>
    </div>
</div>


<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use vova07\fileapi\behaviors\UploadBehavior;

/**
 * This is the model class for table "{{%review}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $model_id
 * @property integer $is_published
 * @property string $review
 * @property integer $created
 * @property integer $updated
 * @property integer $deleted
 */
class Review extends \yii\db\ActiveRecord
{
    public $file;
    
    public static function tableName()
    {
        return '{{%review}}';
    }

    public function rules()
    {
        return [
            [['user_id', 'model_id', 'is_published', 'created', 'updated'], 'integer'],
            [['review', 'model_name'], 'string'],
            [['firstname', 'lastname', 'photo', 'email'], 'string', 'max' => 255],
            ['review', 'required'],
            ['rating', 'double'],
            [['file'], 'file']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'firstname' => Yii::t('app', 'Firstname'),
            'lastname' => Yii::t('app', 'Lastname'),
            'photo' => Yii::t('app', 'Photo'),
            'email' => Yii::t('app', 'Email'),
            'model_id' => Yii::t('app', 'Model ID'),
            'model_name' => Yii::t('app', 'Model Name'),
            'is_published' => Yii::t('app', 'Is Published'),
            'review' => Yii::t('app', 'Review'),
            'rating' => Yii::t('app', 'Rating'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
            'file' => Yii::t('app', 'File'),
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created', 'updated'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated'],
                ],
            ],
            'uploadBehavior' => [
                'class' => UploadBehavior::className(),
                'attributes' => [
                    'photo' => [
                        'path' => '@frontend/web/images',
                        'tempPath' => '@frontend/web/images',
                        'url' => Yii::getAlias('@frontendWebroot/images')
                    ],
                ]
            ],
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getImage()
    {
        $image =  ($this->photo) ? $this->photo : 'placeholder.png';
        return Yii::getAlias('@frontendWebroot/images').'/'.$image;
    }

    public function getImagePath()
    {
        $image =  ($this->photo) ? $this->photo : 'placeholder.jpg';
        return '@frontend/web/images/'.$image;
    }

    public function saveFile()
    {
        $this->file = UploadedFile::getInstance($this, 'file');
//        var_dump($this->file);die();
        if ($this->file && $this->validate()) {
            $filename = uniqid() . '.' . $this->file->extension;
            $this->file->saveAs(Yii::getAlias('@frontend/web/images/'. $filename));
            $this->photo = $filename;
            $this->save();
            //}
        }
    }


//    public function saveProductRating(){
//        $product = Product::findOne($this->model_id);
//
//        $reviews = Review::find()->where(['model' => 'product', 'model_id' => $this->model_id])->all();
//        $ratings = ArrayHelper::getColumn($reviews, 'rating');
//
//        $result = 0;
//        foreach($ratings as $rating){
//            $result += $rating;
//        }
//        if(count($ratings) > 0) {
//            $product->rating = ($result/count($ratings));
//            $product->save();
//        }
//    }

}

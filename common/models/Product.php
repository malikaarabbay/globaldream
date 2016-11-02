<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use Yii\db\ActiveRecord;
use vova07\fileapi\behaviors\UploadBehavior;
use yii\behaviors\SluggableBehavior;
use yii\web\UploadedFile;
use himiklab\sortablegrid\SortableGridBehavior;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $title
 * @property string $announce
 * @property string $description
 * @property string $photo
 * @property integer $price
 * @property integer $new_price
 * @property integer $attribute_id
 * @property string $material
 * @property string $size
 * @property integer $created
 * @property integer $updated
 * @property integer $is_published
 */
class Product extends \yii\db\ActiveRecord
{
    public $file;
    const IMAGE_DIR = 'product';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'price', 'new_price', 'attribute_id', 'created', 'updated', 'is_published', 'is_main'], 'integer'],
            [['description', 'announce'], 'string'],
            [['title', 'photo', 'material', 'size', 'meta_title', 'meta_keywords', 'meta_description', 'slug'], 'string', 'max' => 255],
            [['file'], 'file', 'maxFiles' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'title' => Yii::t('app', 'Title'),
            'announce' => Yii::t('app', 'Announce'),
            'description' => Yii::t('app', 'Description'),
            'photo' => Yii::t('app', 'Photo'),
            'price' => Yii::t('app', 'Price'),
            'new_price' => Yii::t('app', 'New Price'),
            'attribute_id' => Yii::t('app', 'Attribute ID'),
            'material' => Yii::t('app', 'Material'),
            'size' => Yii::t('app', 'Size'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
            'is_published' => Yii::t('app', 'Is Published'), 
            'is_main' => Yii::t('app', 'Is Main'), 
            'file' => Yii::t('app', 'File'),
            'slug' => Yii::t('app', 'Slug'),
            'meta_keywords' => Yii::t('app', 'Meta Keywords'),
            'meta_description' => Yii::t('app', 'Meta Description'),
        ];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getParent() {
        return $this->hasOne(Category::className(), ['parent_id' => 'id']);
    }

    public function getImage()
    {
        $image =  ($this->photo) ? $this->photo : 'placeholder.png';
        return Yii::getAlias('@frontendWebroot/images').'/'.$image;
    }

    public function getImages()
    {
        return Image::find()->where(['model_name' => $this::IMAGE_DIR, 'item_id' => $this->id])->all();
    }

    public function getImagePath()
    {
        $image =  ($this->photo) ? $this->photo : 'placeholder.jpg';
        return '@frontend/web/images/'.$image;
    }

    public function getParams()
    {
        return $this->hasMany(Param::className(), ['id' => 'param_id'])->viaTable('{{%product_param}}', ['product_id' => 'id']);
    }

    public function getProductParams()
    {
        return $this->hasMany(ProductParam::className(), ['product_id' => 'id']);
    }

    public function saveImages(){

        $this->file = UploadedFile::getInstances($this, 'file');

        if ($this->file && $this->validate()) {
            foreach ($this->file as $file) {
                $filename = uniqid() . '.' . $file->extension;

                $file->saveAs(Yii::getAlias('@frontend/web/images/'. $filename));

                $image = new Image;
                $image->filename = $filename;
                $image->model_name = 'product';
                $image->item_id = $this->id;
                $image->save();
            }
        }
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
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
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'slugAttribute' => 'slug'
            ],
        ];

    }
}

<?php

use yii\db\Schema;
use yii\db\Migration;

class m160109_190626_create_category_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer()->defaultValue(0),
            'model_name' => $this->string(),
            'title' => $this->string(),
            'description' => $this->text(),
            'icon' => $this->string(),
            'photo' => $this->string(),

            'lang_id' => $this->smallInteger(),
            'is_published' => $this->smallInteger()->defaultValue(0),
            'sort_index' => $this->integer(),

            'created' => $this->integer(),
            'updated' => $this->integer(),
            'created_user_id' => $this->integer(),
            'updated_user_id' => $this->integer(),

            'slug' => $this->string(),
            'meta_title' => $this->string(),
            'meta_keywords' => $this->string(),
            'meta_description' => $this->string(),

        ], $tableOptions);

        $this->batchInsert('{{%category}}',
            ['parent_id', 'model_name', 'title', 'description', 'created', 'updated', 'slug','is_published'],
            [
                [0, 'article', 'Категория 1', 'Описание контента', time(), time(), 'category-1', 1],
                [0, 'article', 'Категория 2', 'Описание контента', time(), time(), 'category-2', 1],
                [1, 'article', 'Категория 3', 'Описание контента', time(), time(), 'category-3', 1],
                [1, 'article', 'Категория 4', 'Описание контента', time(), time(), 'category-4', 1],
                [1, 'article', 'Категория 5', 'Описание контента', time(), time(), 'category-5', 1],
                [1, 'news', 'Категория 6', 'Описание контента', time(), time(), 'category-6', 1],
                [2, 'news', 'Категория 7', 'Описание контента', time(), time(), 'category-7', 1],
                [2, 'news', 'Категория 8', 'Описание контента', time(), time(), 'category-8', 1],
                [2, 'news', 'Категория 9', 'Описание контента', time(), time(), 'category-9', 1],
            ]
        );
    }

    public function down()
    {
        $this->dropTable('{{%category}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}

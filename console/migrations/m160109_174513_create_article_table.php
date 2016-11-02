<?php

use yii\db\Schema;
use yii\db\Migration;

class m160109_174513_create_article_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%article}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->defaultValue(0),
            'title' => $this->string(),
            'anounce' => $this->text(),
            'description' => $this->text(),
            'photo' => $this->string(),

            'views' => $this->integer()->defaultValue(0),
            'lang_id' => $this->integer(),
            'is_published' => $this->integer()->defaultValue(0),
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

        $this->batchInsert('{{%article}}',
            ['title', 'category_id', 'anounce', 'description', 'photo','created', 'updated', 'slug','is_published'],
            [
                ['Статья 1', 1, 'Анонс контента' , 'Описание контента' , 'article.jpg', time(), time(), 'article-1', 1],
                ['Статья 2', 2, 'Анонс контента' , 'Описание контента' , 'article.jpg', time(), time(), 'article-2', 1],
                ['Статья 3', 3, 'Анонс контента' , 'Описание контента' , 'article.jpg', time(), time(), 'article-3', 1],
                ['Статья 4', 4, 'Анонс контента' , 'Описание контента' , 'article.jpg', time(), time(), 'article-4', 1],
                ['Статья 5', 5, 'Анонс контента' , 'Описание контента' , 'article.jpg', time(), time(), 'article-5', 1],
                ['Статья 6', 1, 'Анонс контента' , 'Описание контента' , 'article.jpg', time(), time(), 'article-6', 1],
                ['Статья 7', 2, 'Анонс контента' , 'Описание контента' , 'article.jpg', time(), time(), 'article-7', 1],
                ['Статья 8', 3, 'Анонс контента' , 'Описание контента' , 'article.jpg', time(), time(), 'article-8', 1],
                ['Статья 9', 4, 'Анонс контента' , 'Описание контента' , 'article.jpg', time(), time(), 'article-9', 1],
            ]
        );


    }

    public function down()
    {
        $this->dropTable('{{%article}}');
    }

}

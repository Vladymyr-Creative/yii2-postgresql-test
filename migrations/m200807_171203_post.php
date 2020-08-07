<?php

use yii\db\Migration;

/**
 * Class m200807_171203_post
 */
class m200807_171203_post extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%post}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(),
            'title' => $this->string()->notNull(),
            'excerpt' => $this->text(),
            'content' => $this->text(),
            'img' => $this->text(),
            'created_at' => $this->dateTime(),
            'keywords' => $this->string(),
            'description' => $this->text(),
        ]);

        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-post-category_id',
            'post',
            'category_id',
            'category',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-post-category_id',
            'post');
        $this->dropTable('{{%post}}');
    }

}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m200706_095006_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'link' => $this->text()->notNull()->unique(),
            'title' => $this->string()->notNull(),
            'gtin' => $this->string()->notNull(),
            'sku' => $this->string()->notNull(),
            'stock' => $this->string(),
            'price' => $this->string(),
            'currency' => $this->string(),
            'size' => $this->string(),
            'color' => $this->string(),
            'img' => $this->text(),
            'desc' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%page}}`.
 */
class m200706_090458_create_page_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%page}}', [
            'id' => $this->primaryKey(),
            'link' => $this->text()->notNull()->unique(),
            'status' => $this->string()->notNull()->defaultValue("waiting"),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%page}}');
    }
}

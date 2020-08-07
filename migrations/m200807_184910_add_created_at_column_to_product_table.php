<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%product}}`.
 */
class m200807_184910_add_created_at_column_to_product_table extends Migration
{

    public function safeUp()
    {
        $this->addColumn('product', 'created_at', $this->dateTime());
    }

    public function safeDown()
    {
        $this->dropColumn('product', 'created_at');
    }
}

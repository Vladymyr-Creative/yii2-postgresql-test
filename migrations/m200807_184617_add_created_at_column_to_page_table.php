<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%page}}`.
 */
class m200807_184617_add_created_at_column_to_page_table extends Migration
{

    public function safeUp()
    {
        $this->addColumn('page', 'created_at',  $this->dateTime()->defaultExpression('NOW()'));
    }

    public function safeDown()
    {
        $this->dropColumn('page', 'created_at');
    }
}

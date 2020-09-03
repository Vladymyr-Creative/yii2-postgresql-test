<?php

use yii\db\Migration;
use Kartavik\Yii2\Database\Pgsql;

/**
 * Class m200903_131153_user
 */
class m200903_131153_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'email' => $this->text(),
            'username' => $this->text(),
            'name' => $this->text(),
            'surname' => $this->text(),
            'age' => $this->integer(),
            'avatar' => $this->text(),
            'about' => $this->text(),
            'tags' => $this->text(),
            'country' => $this->text(),
            'city' => $this->text(),
            'created_at' => $this->dateTime()->defaultExpression('NOW()'),
            'updated_at' => $this->dateTime()->defaultExpression('NOW()'),
            'auth_key' => $this->text(),
            'password_hash' => $this->text(),
            'password_reset_token' => $this->text(),
        ]);

        $this->execute('CREATE TYPE sex_type AS ENUM (\'male\', \'female\')');
        $this->execute('ALTER TABLE {{%user}} ADD COLUMN sex sex_type DEFAULT \'male\'');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
        $this->execute('DROP TYPE IF EXISTS sex_type');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200903_131153_user cannot be reverted.\n";

        return false;
    }
    */
}

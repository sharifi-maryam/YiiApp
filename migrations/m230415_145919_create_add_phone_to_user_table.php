<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%add_phone_to_user}}`.
 */
class m230415_145919_create_add_phone_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'phone', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'phone');
    }
}

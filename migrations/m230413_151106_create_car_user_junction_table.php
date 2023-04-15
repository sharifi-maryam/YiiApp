<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%car_user_junction}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%car}}`
 * - `{{%user}}`
 */
class m230413_151106_create_car_user_junction_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%car_user_junction}}', [
            'id' => $this->primaryKey(),
            'car_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),


        ]);

        // creates index for column `car_id`
        $this->createIndex(
            '{{%idx-car_user_junction-car_id}}',
            '{{%car_user_junction}}',
            'car_id'
        );

        // add foreign key for table `{{%car}}`
        $this->addForeignKey(
            '{{%fk-car_user_junction-car_id}}',
            '{{%car_user_junction}}',
            'car_id',
            '{{%car}}',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-car_user_junction-user_id}}',
            '{{%car_user_junction}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-car_user_junction-user_id}}',
            '{{%car_user_junction}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            '{{%idx-unique-car_user_junction-car_id-user_id}}',
            '{{%car_user_junction}}',
            ['car_id', 'user_id'],
            true
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%car}}`
        $this->dropForeignKey(
            '{{%fk-car_user_junction-car_id}}',
            '{{%car_user_junction}}'
        );

        // drops index for column `car_id`
        $this->dropIndex(
            '{{%idx-car_user_junction-car_id}}',
            '{{%car_user_junction}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-car_user_junction-user_id}}',
            '{{%car_user_junction}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-car_user_junction-user_id}}',
            '{{%car_user_junction}}'
        );

        $this->dropTable('{{%car_user_junction}}');
    }
}

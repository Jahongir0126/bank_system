<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%profile}}`.
 */
class m240320_000002_create_profile_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%profile}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'type' => $this->integer()->notNull(),
            'first_name' => $this->string(255),
            'last_name' => $this->string(255),
            'middle_name' => $this->string(255),
            'phone' => $this->string(20),
            'address' => $this->string(1000),
            'birth_date' => $this->date(),
            'passport_number' => $this->string(50),
            'passport_series' => $this->string(50),
            'inn' => $this->string(12),
            'snils' => $this->string(11),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-profile-user_id',
            '{{%profile}}',
            'user_id'
        );

        $this->addForeignKey(
            'fk-profile-user_id',
            '{{%profile}}',
            'user_id',
            '{{%user}}',
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
            'fk-profile-user_id',
            '{{%profile}}'
        );

        $this->dropIndex(
            'idx-profile-user_id',
            '{{%profile}}'
        );

        $this->dropTable('{{%profile}}');
    }
} 
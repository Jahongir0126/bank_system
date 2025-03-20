<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%client}}`.
 */
class m240320_000005_create_client_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%client}}', [
            'id' => $this->primaryKey(),
            'profile_id' => $this->integer()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'credit_rating' => $this->integer()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-client-profile_id',
            '{{%client}}',
            'profile_id'
        );

        $this->addForeignKey(
            'fk-client-profile_id',
            '{{%client}}',
            'profile_id',
            '{{%profile}}',
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
            'fk-client-profile_id',
            '{{%client}}'
        );

        $this->dropIndex(
            'idx-client-profile_id',
            '{{%client}}'
        );

        $this->dropTable('{{%client}}');
    }
} 
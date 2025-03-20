<?php

use yii\db\Migration;

/**
 * Handles the creation of tables `{{%position}}` and `{{%department}}`.
 */
class m240320_000003_create_position_and_department_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%position}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'code' => $this->string(50)->notNull()->unique(),
            'description' => $this->text(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createTable('{{%department}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'code' => $this->string(50)->notNull()->unique(),
            'description' => $this->text(),
            'parent_id' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-department-parent_id',
            '{{%department}}',
            'parent_id'
        );

        $this->addForeignKey(
            'fk-department-parent_id',
            '{{%department}}',
            'parent_id',
            '{{%department}}',
            'id',
            'SET NULL'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-department-parent_id',
            '{{%department}}'
        );

        $this->dropIndex(
            'idx-department-parent_id',
            '{{%department}}'
        );

        $this->dropTable('{{%department}}');
        $this->dropTable('{{%position}}');
    }
} 
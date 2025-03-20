<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%employee}}`.
 */
class m240320_000004_create_employee_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%employee}}', [
            'id' => $this->primaryKey(),
            'profile_id' => $this->integer()->notNull(),
            'position_id' => $this->integer()->notNull(),
            'department_id' => $this->integer()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'hire_date' => $this->date()->notNull(),
            'salary' => $this->decimal(10, 2)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-employee-profile_id',
            '{{%employee}}',
            'profile_id'
        );

        $this->createIndex(
            'idx-employee-position_id',
            '{{%employee}}',
            'position_id'
        );

        $this->createIndex(
            'idx-employee-department_id',
            '{{%employee}}',
            'department_id'
        );

        $this->addForeignKey(
            'fk-employee-profile_id',
            '{{%employee}}',
            'profile_id',
            '{{%profile}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-employee-position_id',
            '{{%employee}}',
            'position_id',
            '{{%position}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-employee-department_id',
            '{{%employee}}',
            'department_id',
            '{{%department}}',
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
            'fk-employee-department_id',
            '{{%employee}}'
        );

        $this->dropForeignKey(
            'fk-employee-position_id',
            '{{%employee}}'
        );

        $this->dropForeignKey(
            'fk-employee-profile_id',
            '{{%employee}}'
        );

        $this->dropIndex(
            'idx-employee-department_id',
            '{{%employee}}'
        );

        $this->dropIndex(
            'idx-employee-position_id',
            '{{%employee}}'
        );

        $this->dropIndex(
            'idx-employee-profile_id',
            '{{%employee}}'
        );

        $this->dropTable('{{%employee}}');
    }
} 
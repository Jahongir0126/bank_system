<?php

use yii\db\Migration;

/**
 * Handles the creation of RBAC tables.
 */
class m240320_000006_create_rbac_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%auth_rule}}', [
            'name' => $this->string(64)->notNull(),
            'data' => $this->binary(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'PRIMARY KEY (name)',
        ]);

        $this->createTable('{{%auth_item}}', [
            'name' => $this->string(64)->notNull(),
            'type' => $this->smallInteger()->notNull(),
            'description' => $this->text(),
            'rule_name' => $this->string(64),
            'data' => $this->binary(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'PRIMARY KEY (name)',
        ]);

        $this->createIndex(
            'idx-auth_item-type',
            '{{%auth_item}}',
            'type'
        );

        $this->createIndex(
            'idx-auth_item-rule_name',
            '{{%auth_item}}',
            'rule_name'
        );

        $this->addForeignKey(
            'fk-auth_item-rule_name',
            '{{%auth_item}}',
            'rule_name',
            '{{%auth_rule}}',
            'name',
            'SET NULL'
        );

        $this->createTable('{{%auth_item_child}}', [
            'parent' => $this->string(64)->notNull(),
            'child' => $this->string(64)->notNull(),
            'PRIMARY KEY (parent, child)',
        ]);

        $this->addForeignKey(
            'fk-auth_item_child-parent',
            '{{%auth_item_child}}',
            'parent',
            '{{%auth_item}}',
            'name',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-auth_item_child-child',
            '{{%auth_item_child}}',
            'child',
            '{{%auth_item}}',
            'name',
            'CASCADE'
        );

        $this->createTable('{{%auth_assignment}}', [
            'item_name' => $this->string(64)->notNull(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'PRIMARY KEY (item_name, user_id)',
        ]);

        $this->addForeignKey(
            'fk-auth_assignment-item_name',
            '{{%auth_assignment}}',
            'item_name',
            '{{%auth_item}}',
            'name',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-auth_assignment-user_id',
            '{{%auth_assignment}}',
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
            'fk-auth_assignment-user_id',
            '{{%auth_assignment}}'
        );

        $this->dropForeignKey(
            'fk-auth_assignment-item_name',
            '{{%auth_assignment}}'
        );

        $this->dropTable('{{%auth_assignment}}');

        $this->dropForeignKey(
            'fk-auth_item_child-child',
            '{{%auth_item_child}}'
        );

        $this->dropForeignKey(
            'fk-auth_item_child-parent',
            '{{%auth_item_child}}'
        );

        $this->dropTable('{{%auth_item_child}}');

        $this->dropForeignKey(
            'fk-auth_item-rule_name',
            '{{%auth_item}}'
        );

        $this->dropIndex(
            'idx-auth_item-rule_name',
            '{{%auth_item}}'
        );

        $this->dropIndex(
            'idx-auth_item-type',
            '{{%auth_item}}'
        );

        $this->dropTable('{{%auth_item}}');

        $this->dropTable('{{%auth_rule}}');
    }
} 
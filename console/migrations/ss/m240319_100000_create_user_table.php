<?php


use yii\db\Migration;

class m240319_100000_create_user_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'role' => $this->string(50)->defaultValue('client'),
            'status' => $this->integer()->defaultValue(1), // 1 - активен, 0 - заблокирован
            'balance' => $this->decimal(10, 2)->defaultValue(0),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'deleted_at' => $this->timestamp()->null(),
            'created_by' => $this->integer()->null(),
            'updated_by' => $this->integer()->null(),
        ]);
        $this->execute("
            CREATE FUNCTION update_timestamp_column()
            RETURNS TRIGGER AS $$
            BEGIN
            NEW.updated_at = NOW();
            RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;
        ");

        $this->execute("
            CREATE TRIGGER trigger_update_timestamp
          BEFORE UPDATE ON users
          FOR EACH ROW
          EXECUTE FUNCTION update_timestamp_column();
        ");


        // Внешние ключи для created_by и updated_by
        $this->addForeignKey('fk-user-created_by', 'users', 'created_by', 'users', 'id', 'SET NULL');
        $this->addForeignKey('fk-user-updated_by', 'users', 'updated_by', 'users', 'id', 'SET NULL');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-user-created_by', 'users');
        $this->dropForeignKey('fk-user-updated_by', 'users');
        $this->dropTable('users');
        $this->execute("DROP TRIGGER IF EXISTS trigger_update_timestamp ON users;");
        $this->execute("DROP FUNCTION IF EXISTS update_timestamp_column;");

    }
}

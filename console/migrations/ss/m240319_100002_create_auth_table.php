<?php


use yii\db\Migration;

class m240319_100002_create_auth_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('auth', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->unique(),
            'password_hash' => $this->string()->notNull(),
            'auth_token' => $this->string(512)->unique(),
            'reset_token' => $this->string(512)->unique(),
            'last_login_at' => $this->timestamp()->null(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'deleted_at' => $this->timestamp()->null(),
            'created_by' => $this->integer()->null(),
            'updated_by' => $this->integer()->null(),
        ]);
        $this->execute("
    CREATE FUNCTION update_auth_timestamp()
    RETURNS TRIGGER AS $$
    BEGIN
        NEW.updated_at = NOW();
        RETURN NEW;
    END;
    $$ LANGUAGE plpgsql;
");

        $this->execute("
    CREATE TRIGGER trigger_update_auth_timestamp
    BEFORE UPDATE ON auth
    FOR EACH ROW
    EXECUTE FUNCTION update_auth_timestamp();
");


        $this->addForeignKey('fk-auth-user_id', 'auth', 'user_id', 'users', 'id', 'CASCADE');
        $this->addForeignKey('fk-auth-created_by', 'auth', 'created_by', 'users', 'id', 'SET NULL');
        $this->addForeignKey('fk-auth-updated_by', 'auth', 'updated_by', 'users', 'id', 'SET NULL');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-auth-user_id', 'auth');
        $this->dropForeignKey('fk-auth-created_by', 'auth');
        $this->dropForeignKey('fk-auth-updated_by', 'auth');
        $this->dropTable('auth');
        $this->execute("DROP TRIGGER IF EXISTS trigger_update_auth_timestamp ON auth;");
        $this->execute("DROP FUNCTION IF EXISTS update_auth_timestamp;");

    }
}

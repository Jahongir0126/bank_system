<?php


use yii\db\Migration;

class m240319_100001_create_profile_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('profile', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->unique(),
            'firstname' => $this->string(255)->notNull(),
            'lastname' => $this->string(255)->notNull(),
            'phone' => $this->string(20)->unique(),
            'address' => $this->text(),
            'date_of_birth' => $this->date(),
            'passport_number' => $this->string(20)->unique(),
            'gender' => $this->string(50),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'deleted_at' => $this->timestamp()->null(),
            'created_by' => $this->integer()->null(),
            'updated_by' => $this->integer()->null(),
        ]);
        $this->execute("
    CREATE FUNCTION update_profile_timestamp()
    RETURNS TRIGGER AS $$
    BEGIN
        NEW.updated_at = NOW();
        RETURN NEW;
    END;
    $$ LANGUAGE plpgsql;
");

        $this->execute("
    CREATE TRIGGER trigger_update_profile_timestamp
    BEFORE UPDATE ON profile
    FOR EACH ROW
    EXECUTE FUNCTION update_profile_timestamp();
");

        $this->addForeignKey('fk-profile-user_id', 'profile', 'user_id', 'users', 'id', 'CASCADE');
        $this->addForeignKey('fk-profile-created_by', 'profile', 'created_by', 'users', 'id', 'SET NULL');
        $this->addForeignKey('fk-profile-updated_by', 'profile', 'updated_by', 'users', 'id', 'SET NULL');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-profile-user_id', 'profile');
        $this->dropForeignKey('fk-profile-created_by', 'profile');
        $this->dropForeignKey('fk-profile-updated_by', 'profile');
        $this->dropTable('profile');
        $this->execute("DROP TRIGGER IF EXISTS trigger_update_profile_timestamp ON profile;");
        $this->execute("DROP FUNCTION IF EXISTS update_profile_timestamp;");

    }
}

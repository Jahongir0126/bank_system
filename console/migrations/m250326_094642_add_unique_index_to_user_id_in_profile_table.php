<?php

class m250326_094642_add_unique_index_to_user_id_in_profile_table extends \yii\db\Migration

{
    public function safeUp()
    {
        // Удаляем старый индекс (не уникальный)
        $this->dropIndex('idx-profile-user_id', '{{%profile}}');

        // Создаем новый уникальный индекс
        $this->createIndex(
            'idx-profile-user_id-unique',
            '{{%profile}}',
            'user_id',
            true // Параметр true делает индекс уникальным
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Удаляем уникальный индекс
        $this->dropIndex('idx-profile-user_id-unique', '{{%profile}}');

        // Восстанавливаем обычный индекс
        $this->createIndex(
            'idx-profile-user_id',
            '{{%profile}}',
            'user_id'
        );
    }

}
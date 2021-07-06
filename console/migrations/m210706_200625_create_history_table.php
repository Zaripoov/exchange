<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%history}}`.
 */
class m210706_200625_create_history_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%history}}', [
            'id' => $this->primaryKey(),
            'balance' => $this->integer(11)->notNull(),
            'to_user_id' => $this->integer(11)->notNull(),
            'whom_user_id' => $this->integer(11)->notNull(),
            'created_at' => $this->integer(55)->notNull(),
        ]);

        // Добавляем foreign key
        $this->addForeignKey(
            'to_user', // это "условное имя" ключа
            'history', // это название текущей таблицы
            'to_user_id', // это имя поля в текущей таблице, которое будет ключом
            'user', // это имя таблицы, с которой хотим связаться
            'id', // это поле таблицы, с которым хотим связаться
            'CASCADE'

        );

        // Добавляем foreign key
        $this->addForeignKey(
            'whom_user', // это "условное имя" ключа
            'history', // это название текущей таблицы
            'whom_user_id', // это имя поля в текущей таблице, которое будет ключом
            'user', // это имя таблицы, с которой хотим связаться
            'id', // это поле таблицы, с которым хотим связаться
            'CASCADE'

        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%history}}');
    }
}

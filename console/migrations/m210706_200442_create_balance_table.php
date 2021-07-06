<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%balance}}`.
 */
class m210706_200442_create_balance_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%balance}}', [
            'id' => $this->primaryKey(),
            'balance' => $this->integer(11)->notNull(),
            'user_id' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        // Добавляем foreign key
        $this->addForeignKey(
            'user_balance', // это "условное имя" ключа
            'balance', // это название текущей таблицы
            'user_id', // это имя поля в текущей таблице, которое будет ключом
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
        $this->dropTable('{{%balance}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_item}}`.
 */
class m210706_200002_create_user_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_item}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'surname' => $this->string(255)->notNull(),
            'middle_name' => $this->string(255)->notNull(),
            'user_id' => $this->integer(11)->notNull(),

        ]);

        // Добавляем foreign key
        $this->addForeignKey(
            'user', // это "условное имя" ключа
            'user_item', // это название текущей таблицы
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
        $this->dropTable('{{%user_item}}');
    }
}

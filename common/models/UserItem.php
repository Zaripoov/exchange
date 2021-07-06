<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_item".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $middle_name
 * @property int $user_id
 */
class UserItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'middle_name', 'user_id'], 'required'],
            [['user_id'], 'integer'],
            [['name', 'surname', 'middle_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'surname' => 'Surname',
            'middle_name' => 'Middle Name',
            'user_id' => 'User ID',
        ];
    }
}

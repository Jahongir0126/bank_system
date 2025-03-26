<?php

namespace backend\modules\profile\models;

use Yii;
use yii\db\ActiveRecord;
use backend\modules\user\models\User;

class Profile extends ActiveRecord
{
    const TYPE_CLIENT = 1;
    const TYPE_EMPLOYEE = 2;

    public function behaviors()
    {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => time(),
            ],
        ];
    }
    public static function tableName()
    {
        return '{{%profile}}';
    }


    public function rules()
    {
        return [
            [['user_id', 'type'], 'required'],
            [['user_id'], 'integer'],
            [['user_id'], 'unique', 'message' => 'Профиль для данного пользователя уже существует'],
            [['type'], 'integer'],
            [['type'], 'in', 'range' => [self::TYPE_CLIENT, self::TYPE_EMPLOYEE]],
            [['first_name', 'last_name', 'middle_name'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 20],
            [['address'], 'string', 'max' => 1000],
            [['birth_date'], 'date', 'format' => 'php:Y-m-d'],
            [['passport_number', 'passport_series'], 'string', 'max' => 50],
            [['inn'], 'string', 'max' => 12],
            [['snils'], 'string', 'max' => 11],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Пользователь',
            'type' => 'Тип профиля',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'middle_name' => 'Отчество',
            'phone' => 'Телефон',
            'address' => 'Адрес',
            'birth_date' => 'Дата рождения',
            'passport_number' => 'Номер паспорта',
            'passport_series' => 'Серия паспорта',
            'inn' => 'ИНН',
            'snils' => 'СНИЛС',
            'created_at' => 'Создан',
            'updated_at' => 'Обновлен',
        ];
    }


    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }



    public function getFullName()
    {
        return trim($this->last_name . ' ' . $this->first_name . ' ' . $this->middle_name);
    }
} 
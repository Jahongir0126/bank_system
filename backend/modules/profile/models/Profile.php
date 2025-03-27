<?php

namespace backend\modules\profile\models;

use Yii;
use yii\db\ActiveRecord;
use backend\modules\user\models\User;

class Profile extends ActiveRecord
{
    const TYPE_CLIENT = 1;
    const TYPE_EMPLOYEE = 2;
    const TYPE_VIPCLIENT = 3;
    const TYPE_MANAGER = 4;

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
            [['user_id'], 'integer'],
            [['user_id'], 'unique', 'message' => 'Профиль для данного пользователя уже существует'],
            [['type'], 'integer'],
            [['type'], 'in', 'range' => [self::TYPE_CLIENT, self::TYPE_EMPLOYEE, self::TYPE_VIPCLIENT, self::TYPE_MANAGER]],
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
            'user_id' => 'User',
            'type' => 'Profile Type',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'middle_name' => 'Middle Name',
            'phone' => 'Phone',
            'address' => 'Address',
            'birth_date' => 'Birth Date',
            'passport_number' => 'Passport Number',
            'passport_series' => 'Passport Series',
            'inn' => 'INN',
            'snils' => 'SNILS',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
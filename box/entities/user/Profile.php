<?php

namespace box\entities\user;

use box\entities\user\Profile\AddressPhone;
use box\entities\user\Profile\Passport;
use yii\db\ActiveRecord;
use yii\helpers\Html;

/**
 * This is the model class for table "profiles".
 *
 * @property int $id
 * @property int $user_id
 * @property string $surname
 * @property string $given_name
 * @property string $father_name
 * @property string $nationality
 * @property int $date_of_birth
 * @property int $date_of_expiry
 * @property int $date_of_issue
 * @property string $place_of_birth
 * @property string $passport_number
 * @property int $sex
 * @property string $phone_first
 * @property string $phone_second
 * @property string $address_first
 * @property string $address_second
 *
 * @property string $fullName
 * @property string $gender
 *
 * @property User $user
 */
class Profile extends ActiveRecord
{
    const SEX_MALE = 10;
    const SEX_FEMALE = 20;

    public $fullName;
    public $gender;

    public static function create(Passport $passport, AddressPhone $addressPhone): self
    {
        $profile = new static();
        $profile->setPassport($passport);
        $profile->setAddressPhone($addressPhone);
        return $profile;
    }

    public function edit(Passport $passport, AddressPhone $addressPhone)
    {
        $this->setPassport($passport);
        $this->setAddressPhone($addressPhone);
    }

    private function setAddressPhone(AddressPhone $addressPhone)
    {
        $this->phone_first = $addressPhone->phone_first;
        $this->phone_second = $addressPhone->phone_second;
        $this->address_first = $addressPhone->address_first;
        $this->address_second = $addressPhone->address_second;
    }

    private function setPassport(Passport $passport)
    {
        $this->surname = $passport->surname;
        $this->given_name = $passport->given_name;
        $this->father_name = $passport->father_name;
        $this->nationality = $passport->nationality;
        $this->date_of_birth = $passport->date_of_birth;
        $this->date_of_expiry = $passport->date_of_expiry;
        $this->date_of_issue = $passport->date_of_issue;
        $this->place_of_birth = $passport->place_of_birth;
        $this->passport_number = $passport->passport_number;
        $this->sex = $passport->sex;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%profiles}}';
    }


    public function getFullName()
    {
        return $this->given_name . ' ' . $this->surname;
    }

    public function afterFind()
    {
        $this->fullName = $this->surname . ' ' . $this->given_name . ' ' . $this->father_name;
        $this->gender = $this->sex == self::SEX_MALE ? 'Мужской' : 'Женский';
        parent::afterFind();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function attributeLabels()
    {
        return [
            'surname' => 'Фамилия',
            'given_name' => 'Имя',
            'father_name' => 'Отчество',
            'nationality' => 'Национальность',
            'date_of_birth' => 'Дата рождения',
            'date_of_expiry' => 'Дата окончания',
            'date_of_issue' => 'Дата выдачи',
            'place_of_birth' => 'Место рождения',
            'passport_number' => 'Номер паспорта',
            'sex' => 'Пол',
            'gender' => 'Пол',
            'fullName' => 'Полное имя',
            'phone_first' => 'Телефон №1',
            'phone_second' => 'Телефон №2',
            'address_first' => 'Адрес №1',
            'address_second' => 'Адрес №2',
        ];
    }
}

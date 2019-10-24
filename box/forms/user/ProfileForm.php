<?php
/**
 * Created by Madetec-Solution.
 * Developer: Mirkhanov Z.S.
 */

namespace box\forms\user;

use box\entities\user\Profile;
use yii\base\Model;

/**
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
 * @property string $phone_first;
 * @property string $phone_second;
 * @property string $address_first;
 * @property string $address_second;
 */
class ProfileForm extends Model
{
    public $surname;
    public $given_name;
    public $father_name;
    public $nationality;
    public $date_of_birth;
    public $date_of_expiry;
    public $date_of_issue;
    public $place_of_birth;
    public $passport_number;
    public $sex;

    public $phone_first;
    public $phone_second;
    public $address_first;
    public $address_second;

    public $_profile;

    public function __construct(Profile $profile = null, array $config = [])
    {
        if ($profile) {
            $this->surname = $profile->surname;
            $this->given_name = $profile->given_name;
            $this->father_name = $profile->father_name;
            $this->nationality = $profile->nationality;
            $this->date_of_birth = date('d-m-Y', $profile->date_of_birth);
            $this->date_of_expiry = date('d-m-Y', $profile->date_of_expiry);
            $this->date_of_issue = date('d-m-Y', $profile->date_of_issue);
            $this->place_of_birth = $profile->place_of_birth;
            $this->passport_number = $profile->passport_number;
            $this->sex = $profile->sex;
            $this->phone_first = $profile->phone_first;
            $this->phone_second = $profile->phone_second;
            $this->address_first = $profile->address_first;
            $this->address_second = $profile->address_second;
            $this->_profile = $profile;
        }
        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['surname', 'given_name', 'father_name', 'date_of_birth', 'phone_first', 'address_first'], 'required'],
            [['date_of_birth', 'date_of_expiry', 'date_of_issue'], 'date', 'format' => 'php:d-m-Y'],
            [['sex'], 'integer'],
            [['sex'], 'default', 'value' => 10],
            [['surname', 'given_name', 'father_name', 'nationality', 'place_of_birth','address_first','address_second'], 'string', 'max' => 255],
            [['passport_number'], 'string', 'max' => 15],
            [['phone_first','phone_second'], 'string', 'max' => 13],
            [
                ['surname', 'given_name', 'father_name', 'date_of_birth'],
                'unique',
                'targetClass' => Profile::class,
                'targetAttribute' => ['surname', 'given_name', 'father_name', 'date_of_birth'],
                'filter' => $this->_profile ? ['<>', 'id', $this->_profile->id] : null
            ],
        ];
    }

    public function getSexList()
    {
        return [
            Profile::SEX_MALE => 'Мужской',
            Profile::SEX_FEMALE => 'Женский',
        ];
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
            'address_first' => 'Адрес №1',
            'address_second' => 'Адрес №2',
            'phone_first' => 'Телефон №1',
            'phone_second' => 'Телефон №2',
            'sex' => 'Пол',
        ];
    }
}

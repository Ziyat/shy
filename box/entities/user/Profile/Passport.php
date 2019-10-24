<?php


namespace box\entities\user\Profile;


class Passport
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

    public function __construct(
        $surname,
        $given_name,
        $father_name,
        $nationality,
        $date_of_birth,
        $date_of_expiry,
        $date_of_issue,
        $place_of_birth,
        $passport_number,
        $sex
    )
    {
        $this->surname = $surname;
        $this->given_name = $given_name;
        $this->father_name = $father_name;
        $this->nationality = $nationality;
        $this->date_of_birth = $date_of_birth;
        $this->date_of_expiry = $date_of_expiry;
        $this->date_of_issue = $date_of_issue;
        $this->place_of_birth = $place_of_birth;
        $this->passport_number = $passport_number;
        $this->sex = $sex;
    }
}

<?php


namespace box\entities\user\Profile;


class AddressPhone
{
    public $phone_first;
    public $phone_second;
    public $address_first;
    public $address_second;

    public function __construct($phone_first, $phone_second, $address_first, $address_second)
    {
        $this->phone_first = $phone_first;
        $this->phone_second = $phone_second;
        $this->address_first = $address_first;
        $this->address_second = $address_second;
    }
}

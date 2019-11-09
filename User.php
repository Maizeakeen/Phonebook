<?php


class User
{
    private $login;
    private $password;
    private $name;
    private $lastname;
    private $city;
    private $country;
    private $street;
    private $id;
    private $phone;
    private $email;

    public function __get($property)
    {
        switch ($property) {
            case 'login':
                return  $this->login;
                break;
            case 'password':
                return  $this->password;
                break;
            case 'name':
                return    $this->name;
                break;
            case 'lastname':
                return    $this->lastname;
                break;
            case 'city':
                return    $this->city;
                break;
            case 'country':
                return    $this->country;
                break;
            case 'street':
                return    $this->street;
                break;
            case 'id':
                return   $this->id;
                break;
            case 'phone':
                return   $this->phone;
                break;
            case 'email':
                return   $this->email;
                break;
        }
    }

    public function __set($property, $value)
    {
        switch ($property) {
            case 'login':
                $this->login = $value;
                break;
            case 'password':
                $this->password = $value;
                break;
            case 'name':
                $this->name = $value;
                break;
            case 'lastname':
                $this->lastname = $value;
                break;
            case 'city':
                $this->city = $value;
                break;
            case 'country':
                $this->country = $value;
                break;
            case 'street':
                $this->street = $value;
                break;
            case 'id':
                $this->id = $value;
                break;
            case 'phone':
                $this->phone=$value;
                break;
            case 'email':
                $this->email=$value;
                break;
        }
    }
}


<?php

namespace App\User;

use App\Core\AbstractModel;


class UserModel extends AbstractModel
{
    // Attribute deklariert
    public $id;
    public $name;
    public $surname;
    public $email;
    public $password;  // optionales Passwort
    public $role_ID;
    public $position;
    public $team;
    public $phone;
    public $avatar;

    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}


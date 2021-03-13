<?php


namespace App\Models;


use App\Model;

/**
 * Class User
 * @package App\Models
 */
class User extends Model
{
    const TABLE = 'users';

    public $email;
    public $name;
}

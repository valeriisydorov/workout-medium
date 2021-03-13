<?php


namespace App\Models;

/**
 * Class Author
 * @package App\Models
 */
use App\Model;

class Author extends Model
{
    const TABLE = 'authors';
    /**
     * @var $name
     */
    public $name;
}

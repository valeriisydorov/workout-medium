<?php


namespace App\Models;


use App\Model;

/**
 * Class Article
 * @package App\Models
 */
class Article extends Model
{
    const TABLE = 'news';
    const RECENT = 2;

    public $title;
    public $content;
    public $author_id;
    private $data = [];

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value): void
    {
        $this->data[$name] = $value;
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function __get($name)
    {
        if ($name === 'author' && $this->author_id !== null) {
            $this->$name = Author::findById($this->author_id);
        }
        return $this->data[$name] ?? null;
    }

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name): bool
    {
        return isset($this->data[$name]);
    }

    /**
     * @param int $qty
     * @return array
     */
    public static function recent(int $qty = 1): array
    {
        return array_reverse(array_slice(self::findAll(), -1 * $qty, $qty, true));
    }
}

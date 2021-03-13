<?php


namespace App;

use App\Exceptions\MultiException;

/**
 * Class Model
 * @package App
 */
abstract class Model
{
    public $id;

    /**
     * @return array
     */
    public static function findAll(): array
    {
        $db = new Db();
        $sql = 'SELECT * FROM ' . static::TABLE;
        return $db->query($sql, static::class);
    }

    /**
     * @return iterable
     * @throws Exceptions\DbException
     */
    public static function quickFindAll(): iterable
    {
        $db = new Db();
        $sql = 'SELECT * FROM ' . static::TABLE;
        return $db->quickQuery($sql, static::class);
    }

    /**
     * @param $id
     * @return false|mixed
     */
    public static function findById(int $id): ?Model
    {
        $db = new Db();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE id = :id';
        return $db->query($sql, static::class, [':id' => $id])[0] ?? false;
    }

    public function insert(): void
    {
        $fields = get_object_vars($this);

        $columns = [];
        $data = [];

        foreach ($fields as $name => $value) {
            if ($name === 'id') {
                continue;
            }
            $columns[] = $name;
            $data[':' . $name] = $value;
        }

        $sql = 'INSERT INTO ' . static::TABLE . ' (' . implode(', ', $columns) . ') VALUES (' . implode(', ', array_keys($data)) . ')';

        $db = new Db();
        $db->execute($sql, $data);

        $this->id = $db->getLastId();
    }

    public function update(): void
    {
        $fields = get_object_vars($this);

        $columns = [];
        $data = [];

        foreach ($fields as $name => $value) {
            $data[':' . $name] = $value;
            if ($name === 'id') {
                continue;
            }
            $columns[] = $name . ' = :' . $name;
        }

        $sql = 'UPDATE ' . static::TABLE . ' SET ' . implode(', ', $columns) . ' WHERE id = :id';

        $db = new Db();
        $db->execute($sql, $data);
    }

    public function save(): void
    {
        if (is_null($this->id)) {
            $this->insert();
        } else {
            $this->update();
        }
    }

    public function delete(): void
    {
        $sql = 'DELETE FROM ' . static::TABLE . ' WHERE id = :id';

        $db = new Db();
        $db->execute($sql, ['id' => get_object_vars($this)['id']]);
    }

    /**
     * @param array $data
     * @throws MultiException
     */
    public function fill(array $data): void
    {
        $errors = new MultiException();
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            } else {
                $errors->add(new \Exception("Property $key is not defined"));
            }
        }
        if (!$errors->isEmpty()) {
            throw $errors;
        }
    }
}
